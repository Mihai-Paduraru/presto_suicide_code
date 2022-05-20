<x-layout>
    
    <div class="container p-3">
        <div class="row justify-content-center align-items-center  border shadow p-3 angle-round">
            <div class="col-12 text-center">
                <h2 class=" text-center">{{__('ui.paginaDegliAnnunci')}}</h2>
                {{-- <img src="/media/logo_orz.svg" class="logo_register_login img-fluid" alt="Logo del sito"> --}}                
            </div> 

            <div class="col-12 py-5">
                <div class="categoryWrapper text-center">
                    <p class="text-center py-2">{{__('ui.vaiAdUnaCategoriaSpecifica')}}</p>
                    <a class="text-decoration-none text-acol m-5" href="{{route('ad.index')}}"> <i class="fas fa-star mx-2"></i>{{__('ui.tuttiGliAnnunci')}}</a>
                    @foreach($categories as $category)
                    <a class="text-decoration-none text-acol py-2 m-2" href="{{route('ad.index', ['category'=>$category])}}">{{__('ui.' . ucfirst($category->name))}}</a>
                    @endforeach

                    
                </div>
            </div>
            
            
            <div class="col-12 col-md-4 my-4">
                <form class="d-flex" action="{{route('ad.search')}}" method="GET">
                    @csrf
                    <input class="form-control me-2" type="search" name="q" placeholder="{{__('ui.cerca')}}" aria-label="Search">
                    <button class="btn btn-custom" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                <p class="m-0 me-3">{{__('ui.inserisciAnnuncio')}}</p>
                <button class="btn btn-custom" type="submit"><a class="text-decoration-none text-white" aria-current="page" href="{{route('ad.create')}}">{{__('ui.inizia')}}</a></button>
            </div>


        </div>
    </div>
    
    {{-- Card index --}}
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            
            
            
            @foreach($ads as $ad)
            <div class="col-12 col-md-6 col-lg-4  d-flex flex-column align-items-center justify-content-evenly my-5">
                <div class=" card ">
                    <div class="d-flex align-items-center">
                        @if($ad->images->count() > 0)
                        <img src="{{$ad->images[0]->getUrl(300, 300)}}" class="img-fluid card-img" alt="Immagine per annuncio {{$ad->title}}">
                        @else
                        <img src="https://via.placeholder.com/300" class="img-fluid card-img" alt="Placeholder">
                        @endif
                    </div>
                    <div class="card-info d-flex flex-column justify-content-center">
                        <h3 class="text-title text-center">{{$ad->title}}</h3>
                        <p class="text-body text-center mb-o"><a class="text-decoration-none text-white" href="{{route('ad.index', ['category'=>$ad->category])}}">{{__('ui.' . ucfirst($ad->category->name))}}</a></p>
                        <p class="card-text text-center card-info-index">{{__('ui.inseritoDa')}} {{$ad->user->name}}</p>
                        <p class="card-text mx-auto fs-3 ">{{$ad->price}}€</p>
                        <a href="{{route('ad.show', compact('ad'))}}" class="btn btn-custom card-button mx-auto my-3">{{__('ui.scopriDiPiù')}}</a>
                    </div>
                </div>
            </div>
                @endforeach
        </div>
    </div>
    
    
</x-layout>

