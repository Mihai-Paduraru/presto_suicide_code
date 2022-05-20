<?php

namespace App\Models;

use App\Models\Ad_Image;
use App\Models\Category;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory;
    use Searchable;

    public function toSearchableArray()
    {
        $array = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
        ];

        return $array;
    }

    protected $fillable=[
        'title',
        'description',
        'price',
        'image',
        'category_id',
        'user_id'
    ];

    public function category (){
        return $this->belongsTo(Category::class);
    }
    public function user (){
        return $this->belongsTo(User::class);
    }
    public function images(){
        return $this->hasMany(Ad_Image::class);
    }

    static public function adCount(){
        return Ad::where('is_accepted', null)->count();
    }
}
