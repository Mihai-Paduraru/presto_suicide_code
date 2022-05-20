<x-layout>

    
    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="">{{__('ui.titleshow')}}</h2>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-between">
            <div class="col-12 col-md-5 d-flex flex-column flex-lg-row justify-content-center align-items-center my-3">
                <div class="swiper mySwiper2 my-3">
                    <div class="swiper-wrapper">
                        @if($ad->images->count() > 0)
                        @foreach($ad->images as $image)
                        <div class="swiper-slide">
                            <img src="{{$image->getUrl(300, 300)}}" class="img-fluid" alt="{{__('ui.altimage')}}">
                        </div>
                        @endforeach
                        @else
                        <div class="swiper-slide">
                            <img src="https://via.placeholder.com/300" class="img-fluid" alt="Placeholder">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-center order-lg-first my-3">
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @if($ad->images->count() > 0)
                            @foreach($ad->images as $image)
                            <div class="swiper-slide">
                                <img src="{{$image->getUrl(100, 100)}}" class="img-fluid" alt="{{__('ui.altimage')}}">
                            </div>
                            @endforeach
                            @else
                            <div class="swiper-slide">
                                <img src="https://via.placeholder.com/100" class="" alt="Placeholder">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5 d-flex justify-content-between flex-column my-3 shadow p-5 angle-round">
                <h3 class="text-start">{{$ad->title}}</h3>
                <p class="fst-italic">{{__('ui.insertby')}} {{$ad->user->name}} {{__('ui.when')}} {{$ad->created_at->format('d-m-Y')}}</p>
                <p>{{__('ui.prezzo')}} <strong>{{$ad->price}}€</strong></p>
                <p class="fw-bold">{{__('ui.descrizioneProdotto')}}</p>
                <p class="fst-italic">{{$ad->description}}</p>
                @auth <p class="fst-italic">Email: {{$ad->user->email}}</p>@endauth
                <a href="{{route('ad.index')}}" class="btn btn-custom align-self-end">{{__('ui.back')}}</a>
            </div>
        </div>
    </div>
</x-layout>