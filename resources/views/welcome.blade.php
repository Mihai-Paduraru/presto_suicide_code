<x-layout>
    
    
    <header class="container-fluid vh-100 m-0 header d-flex flex-column justify-content-center">
        @if(session('flash'))
        <div class="alert header-alert align-self-center bg-dcol text-white my-4">
            <div>{{session('flash')}}!</div>
        </div>
        @endif
        <div class="row align-items-center @desktop position-absolute ms-5 ps-5 pe-0 @enddesktop title-wrapper">
            <div class="col-12 ">
                <div class="d-flex">
                    <h1 class="@desktop display-2 @else display-3 @enddesktop"><span class="d-inline fw-bold text-white">{{__('ui.inserisci')}}</span><span class="display-2 fw-bold text-acol ms-3 text-uppercase d-inline">pre</span><span class="display-2 fw-bold text-dcol text-uppercase d-inline">sto</span></h1>
                </div>
                <h4 class='text-white fw-normal'>{{__('ui.subtitle')}}</h4>
                <a href="{{route('ad.create')}}" class="btn btn-custom my-3">{{__('ui.inizia')}}</a>
            </div>
        </div>
    </header>


    <div class="container my-5 py-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center my-5">
                <h2 class="">{{__('ui.scopri')}}</h2>
            </div>

            <div class="col-12 col-md-10">
                <div class="swiper swiperHomepage">
                    <div class="swiper-wrapper">
                        @foreach($ads as $ad)
                                <div class="swiper-slide pb-5">
                                    <div class="card">
                                        @if($ad->images->count() > 0)
                                            <img src="{{$ad->images[0]->getUrl(300, 300)}}" class="card-img" alt="...">
                                        @else
                                            <img src="https://via.placeholder.com/300" class="card-img" alt="...">
                                        @endif
                                    <div class="card-info d-flex flex-column justify-content-center">
                                        <h3 class="text-title text-center">{{$ad->title}}</h3>
                                        <p class="text-body text-center mb-0"><a class="text-decoration-none text-white" href="{{route('ad.index', ['category'=>$ad->category])}}">{{__('ui.' . ucfirst($ad->category->name))}}</a></p>
                                        <a href="{{route('ad.show', compact('ad'))}}" class="btn btn-custom card-button mx-auto my-3">{{__('ui.scopriDiPiù')}}</a>
                                    </div>
                                    </div>

                                </div>
                        @endforeach
                    </div>
                    <div class="swiper-scrollbar"></div>
                  </div>
            </div>

        </div>
    </div>

    <div class="container p-5">
        <div class="row">
          <div class="col-12 col-md-3 info-contact">
            <img src="/media/info/Sign in-bro.png" class="img-fluid " alt="">
            <h2>{{__('ui.registratiInfo')}}</h2>
            <p>{{__('ui.registratiDec')}} </p>
          </div>
          <div class="col-12 col-md-3 info-contact2">
            <img src="/media/info/Attached files-bro.png" class="img-fluid" alt="">
            <h2>{{__('ui.inserisciInfo')}}</h2>
            <p>{{__('ui.inserisciDoc')}} </p>
          </div>
          <div class="col-12 col-md-3 info-contact">
            <img src="/media/info/Load more-amico.png" class="img-fluid" alt="">
            <h2>{{__('ui.compraArticoli')}}</h2>
            <p>{{__('ui.compraArticoliDoc')}}</p>
          </div>
          <div class="col-12 col-md-3 info-contact">
            <img src="/media/info/Projections-bro.png" class="img-fluid" alt="">
            <h2>{{__('ui.guadagniaSuPRESTO')}}</h2>
            <p>{{__('ui.guadagniaSuPRESTOdoc')}}</p>
          </div>
        </div> 
      </div>
    
</x-layout>