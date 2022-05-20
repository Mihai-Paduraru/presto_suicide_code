<x-layout>

    <div class="container pt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">{{__('ui.lavoraConNoi')}}</h1>
            </div>
        </div>
    </div>


    <div class="container py-5">
      <div class="row justify-content-center align-items-center shadow">
        <div class="col-12 col-md-6 p-3">
          <p class="text-center">{{__('ui.richiestaLavoraConNoi')}} </p>
          <form method="POST" action="{{route('profile.sendMail', ['user_info' => Auth::user()])}}">
              @csrf
              <button type="submit" class="btn btn-custom d-block mx-auto">{{__('ui.invia')}} </button>
            </form>
        </div>
      </div>
    </div>

    <div class="container p-5">
      <div class="row">
        <div class="col-12 col-md-6 info-contact">
          <img src="/media/info/Publish article-bro.png" class="img-fluid info-img" alt="">
        </div>
        <div class="col-12 col-md-6 info-contact2">
          <p><i class="fa-solid fa-1 fa-2x p-2 my-4"></i>{{__('ui.infoUnoLavora')}} </p>
          <div>
            <p><i class="fa-solid fa-2 fa-2x p-2 my-3"></i>{{__('ui.infoDueLavora')}}</p>
          </div>
          <div>
            <p><i class="fa-solid fa-3 fa-2x p-2 my-3"></i>{{__('ui.infoTreLavora')}}</p>
          </div>
          <div>
            <p><i class="fa-solid fa-4 fa-2x p-2 my-3"></i>{{__('ui.infoQuatroLavora')}}</p>
          </div>
          <div>
            <p><i class="fa-solid fa-5 fa-2x p-2 my-3"></i>{{__('ui.infoCinqueLavora')}}</p>
          </div>
          <div>
            <p><i class="fa-solid fa-6 fa-2x p-2 my-3"></i>{{__('ui.infoSeiLavora')}}</p>
          </div>
        </div>
      </div> 
    </div>

  </x-layout>