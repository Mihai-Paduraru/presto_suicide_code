  <x-layout>
    <div class="container p-5 shadow">
      <div class="row">
        <div class="col-12 text-center">
          <h2>{{__('ui.benvenuto')}} {{Auth::user()->name}}</h2>
        </div>
      </div>
      <div class="row justify-content-center align-items-center">
        <div class="col-md-12 p-3">
          @if($users->count() > 0)
          <div class="row">
            <div class="col-12 py-5">
              <h3>Richieste revisor</h3>
            </div>
            @if($users[0]->where('is_revisor', null)->count() == 0)
            <p>Nessuna richiesta in attesa</p>
            @else
            @foreach($users as $user)
              @if($user->request_revisor && $user->is_revisor === null)
              <div class="col-5">
                <h4 class="text-start">Nome utente: {{$user->name}}</h4>
                <p class="fst-italic">Nostro utente da: {{$user->created_at->format('d-m-Y')}}</p>
                <p class="fst-italic">Numero annunci pubblicati: {{$user->ads->where('is_accepted', true)->count()}}</p>
                <div class="d-flex">
                  <form action="{{route('admin.reject', ['id' => $user->id])}}" class="p-3" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger align-self-end">Rifiuta</button>
                  </form>
                  <form action="{{route('admin.accept', ['id' => $user->id])}}" class="p-3" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success align-self-end">Accetta</button>
                  </form>
                </div>
              </div>
              @endif
            @endforeach
            @endif
          </div>
          @endif
        </div>
      </div>
      <div class="row justify-content-center align-items-center">
        <div class="col-md-12 p-3">
          @if($users->count() > 0)
          <div class="row">
            <div class="col-12 py-5">
              <h3>Lista utenti revisor</h3>
            </div>
            @if($users[0]->where('is_revisor', true)->count() == 0)
            <p>Nessun utente è revisor</p>
            @else
            @foreach($users as $user)
              @if($user->request_revisor && $user->is_revisor == true)
              <div class="col-5">
                <h4 class="text-start">Nome utente: {{$user->name}}</h4>
                <p class="fst-italic">Nostro utente da: {{$user->created_at->format('d-m-Y')}}</p>
                <p class="fst-italic">Numero annunci pubblicati: {{$user->ads->where('is_accepted', true)->count()}}</p>
                <div class="d-flex">
                  <form action="{{route('admin.reject', ['id' => $user->id])}}" class="p-3" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger align-self-end">Rimuovi da revisor</button>
                  </form>
                </div>
              </div>
              @endif
            @endforeach
            @endif
          </div>
          @endif
        </div>
      </div>
      <div class="row justify-content-center align-items-center">
        <div class="col-md-12 p-3">
          @if($users->count() > 0)
          <div class="row">
            <div class="col-12 py-5">
              <h3>Lista utenti rifiutati</h3>
            </div>
            @if($users[0]->where('is_revisor', false)->count() == 0)
            <p>Nessun utente è stato rifiutato</p>
            @else
            @foreach($users as $user)
              @if($user->request_revisor && $user->is_revisor === 0)
              <div class="col-5">
                <h4 class="text-start">Nome utente: {{$user->name}}</h4>
                <p class="fst-italic">Nostro utente da: {{$user->created_at->format('d-m-Y')}}</p>
                <p class="fst-italic">Numero annunci pubblicati: {{$user->ads->where('is_accepted', true)->count()}}</p>
                <div class="d-flex">
                  <form action="{{route('admin.undo', ['id' => $user->id])}}" class="p-3" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning align-self-end">Annulla</button>
                  </form>
                </div>
              </div>
                
              @endif
            @endforeach
            @endif
          </div>
          @endif
        </div>
      </div>
    </div>
  

  </x-layout>