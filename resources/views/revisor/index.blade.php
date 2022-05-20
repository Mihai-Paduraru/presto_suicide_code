  <x-layout>

    <div class="container py-5">
      <div class="row">
        <div class="col-12 text-center">
          <h2>Home Revisor</h2>
          <h3>Benvenuto, {{Auth::user()->name}}</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <h3>Annuncio da revisionare:</h3>
        </div>
      </div>
      <div class="row justify-content-center align-items-center shadow">
        <div class="col-12 p-3">
          @if($ad)
              <h3 class="text-start">{{$ad->title}}</h3>
              <p class="fst-italic">{{__('ui.utente')}} {{$ad->user->name}}</p>
              <p class="fw-bold">{{__('ui.descrizioneProdotto')}} </p>
              <p class="fst-italic">{{$ad->description}}</p>
              <p>{{__('ui.prezzo')}}<strong>{{$ad->price}}€</strong></p>
              <p>{{__('ui.immagini')}} </p>
              <div class="d-flex justify-content-center my-2">
                <div class="row">
                  @if($ad->images->count() > 0)
                  @foreach($ad->images as $image)
                  
                  <div class="col-6 my-3 d-flex justify-content-center"><img src="{{$image->getUrl(300, 300)}}" alt="Immagine per annuncio {{$ad->title}}" class="img-fluid mx-2"></div>
                  <div class="col-6 my-3">
                    <div class="row">
                      <div class="col-10">
                        <h4>Rischio di contenuto sensibile:</h4>
                        <ul class="d-flex justify-content-around list-unstyled">
                          <li>Adulto: <i class="fa-solid @if($image->adult > 2)fa-square-check @else fa-square @endif"></i></li>
                          <li>Parodia: <i class="fa-solid @if($image->spoof > 2)fa-square-check @else fa-square @endif"></i></li>
                          <li>Medico: <i class="fa-solid @if($image->medical > 2)fa-square-check @else fa-square @endif"></i></li>
                          <li>Violento: <i class="fa-solid @if($image->violence > 2)fa-square-check @else fa-square @endif"></i></li>
                          <li>Razziale: <i class="fa-solid @if($image->racy > 2)fa-square-check @else fa-square @endif"></i></li>
                        </ul>
                      </div>
                    </div>
                    <div class="row my-3">
                      <div class="col-10">
                        <h4>Etichette riconosciute tramite Google Vision:</h4>
                        <ul class="d-flex list-unstyled flex-column justify-content-center flex-wrap h-25">
                          @if ($image->labels)
                          @foreach($image->labels as $label)
                          <li>{{$label}}</li>
                          @endforeach
                          @endif
                        </ul>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @else
                  <p>{{__('ui.noimages')}}</p>
                  @endif
                </div>

              </div>
              <div class="row border-top justify-content-center">
                <div class="col-12 col-md-6 d-flex justify-content-around">
                  <form action="{{route('revisor.accept', ['id' => $ad->id])}}" class="p-3" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success align-self-end">{{__('ui.accetta')}} </button>
                  </form>
                  <form action="{{route('revisor.reject', ['id' => $ad->id])}}" class="p-3" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger align-self-end">{{__('ui.rifiuta')}} </button>
                  </form>
                </div>
              </div>

              @if($lastad)
              <div class="row">
                <div class="col-12 col-md-6">
                  <h3>Ultima operazione eseguita:</h3>
                  <h4 class="text-start">{{$lastad->title}}</h4>
                  <p class="fst-italic">{{__('ui.utente')}} {{$lastad->user->name}}</p>
                  <p>{{__('ui.descrizioneProdotto')}} </p>
                  <p>{{$lastad->description}}</p>
                  <p>{{__('ui.prezzo')}}<strong>{{$lastad->price}}€</strong></p>
                  <p>Valutazione: @if($lastad->is_accepted > 0) Approvato @else Rifiutato @endif</p>
                  <form action="{{route('revisor.undo', ['id' => $lastad->id])}}" class="p-3" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning align-self-end">{{__('ui.annullaUltimaOperazione')}} </button>
                  </form>
                </div>
              </div>
              @endif
          @else
              <p>{{__('ui.nonCiSonoAnnunci')}}</p>
              @if ($lastad)
              <div class="row">
                <div class="col-12 col-md-6">
                  <h3>Ultima operazione eseguita:</h3>
                  <h4 class="text-start">{{$lastad->title}}</h4>
                  <p class="fst-italic">{{__('ui.utente')}} {{$lastad->user->name}}</p>
                  <p class="fw-bold">{{__('ui.descrizioneProdotto')}} </p>
                  <p class="fst-italic">{{$lastad->description}}</p>
                  <p>{{__('ui.prezzo')}}<strong>{{$lastad->price}}€</strong></p>
                  <p><strong>Valutazione:</strong> @if($lastad->is_accepted > 0) Approvato @else Rifiutato @endif</p>
                  <form action="{{route('revisor.undo', ['id' => $lastad->id])}}" class="p-3" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning align-self-end">{{__('ui.annullaUltimaOperazione')}} </button>
                  </form>
                </div>
              </div>
              @endif
              @endif
        </div>
      </div>
    </div>
  
    <div class="container p-5">
      <div class="row">
        <div class="col-12 col-md-4 info-contact">
          <img src="/media/info/Upvote-bro.png" class="img-fluid " alt="">
          <h2>{{__('ui.AccetaInfo')}}</h2>
          <p>{{__('ui.AccetaInfoDoc')}}</p>
        </div>
        <div class="col-12 col-md-4 info-contact2">
          <img src="/media/info/torna-indietro.png" class="img-fluid" alt="">
          <h2>{{__('ui.AnnullaInfo')}}</h2>
          <p>{{__('ui.AnnullaInfoDoc')}} </p>
        </div>
        <div class="col-12 col-md-4 info-contact">
          <img src="/media/info/rifiuta.png" class="img-fluid" alt="">
          <h2>{{__('ui.RifiutaInfo')}}</h2>
          <p>{{__('ui.RifiutaInfoDoc')}} </p>
        </div>
      </div> 
    </div>

  </x-layout>