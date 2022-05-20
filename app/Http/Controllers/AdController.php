<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Ad_Image;
use App\Models\Category;
use App\Jobs\ResizeImage;
use App\Jobs\WatermarkImage;
use Illuminate\Http\Request;
use App\Http\Requests\AdRequest;
use App\Jobs\GoogleVisionLabelImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use App\Jobs\GoogleVisionRemoveFaces;
use Illuminate\Support\Facades\Storage;
use App\Jobs\GoogleVisionSafeSearchImage;

class AdController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category = null)
    {
        if($category){
            $ads= Ad::where('category_id', $category->id)->where('is_accepted', true)->get();
            return view('ad.index', compact('ads', 'category'));
        }else{
            $ads= Ad::where('is_accepted', true)->orderBy('created_at', 'DESC')->get();
            return view('ad.index', compact('ads'));
        }
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $ads= Ad::search($q)->where('is_accepted', true)->orderBy('updated_at', 'DESC')->get();
        return view('ad.search', compact('ads', 'q'));
       
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $uniqueSecret = $request->old('uniqueSecret', base_convert(sha1(uniqid(rand())), 16, 36));
        return view('ad.create', compact('uniqueSecret'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        if($request->image){
            $ad = Ad::create([
                'title'=> $request->title,
                'description'=> $request->description,
                'price' => $request->price,
                'image' => $request->file('image')->store('/public/image'),
                'category_id' => $request->category,
                'user_id' => Auth::user()->id
            ]);
        }else{
            $ad = Ad::create([
                'title'=> $request->title,
                'description'=> $request->description,
                'price' => $request->price,
                'category_id' => $request->category,
                'user_id' => Auth::user()->id
            ]);
        }
        
        $uniqueSecret = $request->input('uniqueSecret');
        $images = session()->get("images.{$uniqueSecret}", []); 
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
        $images = array_diff($images, $removedImages);

        foreach ($images as $image){
            $i = new Ad_Image();
            $fileName = basename($image);
            $newFileName = "public/ads/{$ad->id}/{$fileName}";
            Storage::move($image, $newFileName);

            $i->file = $newFileName;
            $i->ad_id = $ad->id;
            $i->save();

            dispatch(new GoogleVisionSafeSearchImage($i->id));
            dispatch(new GoogleVisionLabelImage($i->id));
            GoogleVisionSafeSearchImage::withChain([
                new GoogleVisionLabelImage($i->id),
                new GoogleVisionRemoveFaces($i->id),
                new ResizeImage($i->file, 300, 300),
                new ResizeImage($i->file, 100, 100),
            ])->dispatch($i->id);
            
        }

        File::deleteDirectory(storage_path("app/public/temp/{$uniqueSecret}"));


        return redirect(route('homepage'))->with('flash', 'Hai inserito un articolo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        return view('ad.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        //
    }

    public function uploadImages(Request $request){

        $uniqueSecret = $request->input('uniqueSecret');
        $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}");

        dispatch(new ResizeImage(
            $fileName,
            120,
            120
        ));

        session()->push("images.{$uniqueSecret}", $fileName);

        return response()->json(['id' => $fileName]);
    }

    public function removeImages(Request $request){
        $uniqueSecret = $request->input('uniqueSecret');
        $fileName = $request->input('id');
        session()->push("removedimages.{$uniqueSecret}", $fileName);
        Storage::delete($fileName);
        return response()->json('ok');
    }
    
    public function getImages(Request $request){
        $uniqueSecret = $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}", []); 
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
        $images = array_diff($images, $removedImages);

        $data = [];

        foreach ($images as $image){
            $data[] = [
                'id' => $image,
                'src' => Ad_Image::getUrlByFilePath($image, 120, 120)
            ];
        }

        return response()->json($data);
    }
}
