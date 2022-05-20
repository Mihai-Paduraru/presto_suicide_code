@if(!Browser::isMobile())
<div class="d-flex sidebar flex-column">
    <a class="sidebar-brand" href="{{route('homepage')}}"></a>
  <ul class="nav nav-pills d-flex flex-column justify-content-between">
    <li>
      <a href="{{route('homepage')}}" class="nav-link text-white d-flex align-items-center @if(Route::currentRouteName() == 'homepage') nav-link-current @endif">
          <i class="fas fa-home sidebar-icons fa-2x me-5"></i>
          <p class="m-0 ms-5">Homepage</p>
      </a>
    </li>
    <li>
      <a href="{{route('ad.index')}}" class="nav-link text-white d-flex align-items-center @if(str_contains(Route::currentRouteName(),'ad') && !str_contains(Route::currentRouteName(), 'search') && !str_contains(Route::currentRouteName(), 'create')) nav-link-current @endif">
          <i class="fas fa-star sidebar-icons fa-2x me-5"></i>
          <p class="m-0 ms-5">{{__('ui.annunci')}}</p>
      </a>
    </li>
    <li>
      <a href="{{route('ad.create')}}" class="nav-link text-white d-flex align-items-center @if(str_contains(Route::currentRouteName(),'create')) nav-link-current @endif">
        <i class="fa-solid fa-square-plus fa-2x me-5"></i>
          <p class="m-0 ms-5">{{__('ui.inserisciAnnuncio')}}</p>
      </a>
    </li>
    <li>
      <a href="{{route('register')}}" class="nav-link text-white d-flex align-items-center">  
               <i class="fas fa-user sidebar-icons fa-2x me-5"></i>
          @guest
          <p class="m-0 ms-5">Register</p>
          @else
          <p class="m-0 ms-5">{{__('ui.benvenuto')}} {{Auth::user()->name}}!</p> 
          @endguest
      </a>
    </li>
    @auth
    @if (Auth::user()->is_admin)
      <li>
        <a class="nav-link text-white d-flex align-items-center @if(str_contains(Route::currentRouteName(),'admin')) nav-link-current @endif" href="{{route('admin.index')}}">
          <i class="fa-solid fa-house-lock fa-2x me-5"></i>
          <p class="m-0 ms-5">Home admin</p>
        </a>
      </li>
    @endif
    @if (Auth::user()->is_revisor)
      <li>
          <a class="nav-link text-white d-flex align-items-center @if(str_contains(Route::currentRouteName(),'revisor')) nav-link-current @endif" href="{{route('revisor.index')}}">
            @if (Auth::user()->is_revisor && \App\Models\Ad::adCount()>0)
               <i class="fas fa-house-circle-exclamation sidebar-icons fa-2x me-5 position-relative">
                <span class="position-absolute translate-middle badge rounded-pill revisor-badge bg-danger d-flex justify-content-center align-items-center">
                  {{\App\Models\Ad::adCount()}}
                  </span>
               </i>
                    @else
                    <i class="fas fa-house-circle-exclamation sidebar-icons fa-2x me-5 position-relative"></i>
                @endif
            <p class="m-0 ms-5">Home revisor</p>
          </a>
      </li>
    @endif
    @if (!Auth::user()->is_revisor && !Auth::user()->is_admin)
    <li>
      <a class="nav-link text-white d-flex align-items-center @if(str_contains(Route::currentRouteName(),'profile')) nav-link-current @endif" href="{{route('profile.workWithUs')}}">
        <i class="fa-solid fa-briefcase fa-2x me-5"></i>
        <p class="m-0 ms-5">{{__('ui.lavoraConNoi')}}</p>
      </a>
    </li>
    @endif
    @endauth
    <li>
      <div class="nav-link text-white d-flex align-items-center @if(Route::currentRouteName() == 'ad.search') nav-link-current @endif">
          <i class="fas fa-magnifying-glass sidebar-icons fa-2x me-5"></i>
          <form class="sidebar-search-form" action="{{route('ad.search')}}" method="GET">
            @csrf
            <input class="sidebar-search-input d-inline me-2" placeholder="{{__('ui.cerca')}}" type="search" name="q">
            <button class="btn btn-custom sidebar-search-button" type="submit"><i class="fas fa-arrow-right"></i></button>
          </form>
      </div>
    </li>
    <li>
      <a href="" class="nav-link text-white d-flex align-items-center">
          <i class="fas fa-language sidebar-icons fa-2x me-5"></i>
          {{-- <p class="m-0 ms-5">{{__('ui.lingue')}} </p> --}}
          <div class="lang-wrapper">
            <x-langflag lang="it" nation="it"/>
            <x-langflag lang="en" nation="gb"/>
            <x-langflag lang="ro" nation="ro"/>
          </div>
      </a>
    </li>

    <li>
      @guest
      <a href="{{route('login')}}" class="nav-link text-white d-flex align-items-center">
        <i class="fa-solid fa-user-check fa-2x me-5"></i>
        <p class="m-0 ms-5">Login</p>
      </a>
      @else
      <a href="" onclick="event.preventDefault(); document.querySelector('#form-logout').submit();" class="nav-link text-white d-flex align-items-center">
        <i class="fa-solid fa-user-xmark fa-2x me-5"></i>
          <form method="POST" action="{{route('logout')}}" id="form-logout">@csrf</form>
          <p class="m-0 ms-5">Logout</p>
      </a>
      @endif
    </li>
  </ul>
</div>
@endif




@mobile
<nav id="navbar" class="navbar navbar-mobile navbar-expand-lg navbar-light">
  <div class="container-fluid d-flex justify-content-between h-100 position-relative">
    <ul class="d-flex flex-row navbarWrapper justify-content-center align-items-center navbar-nav m-auto">
      <li class="nav-item link-container  @if(str_contains(Route::currentRouteName(),'profile') || str_contains(Route::currentRouteName(),'revisor') || str_contains(Route::currentRouteName(),'admin')) current @endif" title="Profilo">
        @guest
        <i class="main-icon fas fa-user"></i>
        @else
        @if (Auth::user()->is_revisor && \App\Models\Ad::adCount()>0)
               <i class="main-icon fas fa-user-check position-relative">
                <span class="position-absolute translate-middle badge rounded-pill revisor-badge bg-danger d-flex justify-content-center align-items-center">
                  {{\App\Models\Ad::adCount()}}
                  </span>
               </i>
                    @else
                    <i class="main-icon fas fa-user-check position-relative"></i>
                @endif
            @endguest
            <div class="invisible inner-container">
              @guest
              <p class="container-title">{{__('ui.benvenutoguest')}}</p>
              <a class="hidden-link" href="{{route('login')}}">Login</a>
              <a class="hidden-link" href="{{route('register')}}">Register</a>
              @else
              <p class="container-title">{{__('ui.benvenuto')}} {{Auth::user()->name}}!</p>
              @if (Auth::user()->is_revisor)
              <a class="hidden-link" href="{{route('revisor.index')}}">Home revisor</a>
              @else
              <a class="hidden-link" href="{{route('profile.workWithUs')}}">{{__('ui.lavoraConNoi')}}</a>
              @endif
              @if (Auth::user()->is_admin)
              <a class="hidden-link" href="{{route('revisor.index')}}">Home admin</a>
              @endif
              <a class="hidden-link" href="" onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">Logout</a>
              <form method="POST" action="{{route('logout')}}" id="form-logout">@csrf</form>
              @endguest
            </div>
      </li>
      <li class="nav-item link-container @if(str_contains(Route::currentRouteName(),'ad') && !str_contains(Route::currentRouteName(), 'search')) current @endif" title="Annunci">
        <i class="main-icon fas fa-star"></i>
        <div class="inner-container invisible">
          <p class="container-title">{{__('ui.annunci')}}</p>
          <a class="hidden-link" aria-current="page" href="{{route('ad.create')}}">{{__('ui.inserisciAnnuncio')}}</a>
          <a class="hidden-link" href="{{route('ad.index')}}">{{__('ui.listaannunci')}}</a>      
</div>
      </li>
      <li class="nav-item mobile-homepage @if(Route::currentRouteName() == 'homepage') current @endif" title="Homepage">
        <a class="text-dark text-decoration-none" href="{{route('homepage')}}"><i class="fas fa-home"></i></a>
      </li>
      <li class="nav-item link-container" title="Lingue">
        <i class="main-icon fas fa-language"></i>
        <div class="inner-container invisible">
          <p class="container-title">{{__('ui.lingue')}}</p>
          <div class="hidden-link"><x-langflag lang="it" nation="it"/></div>
          <div class="hidden-link">
            <x-langflag lang="en" nation="gb"/>
          </div>
          <div class="hidden-link">
            <x-langflag lang="ro" nation="ro"/>
          </div>
        </div>
      </li>
      <li class="nav-item link-container search-icon @if(Route::currentRouteName() == 'ad.search') current @endif" title="Cerca">
        <i class="main-icon fas fa-magnifying-glass"></i>
        <div class="inner-container invisible">
          <p class="container-title">{{__('ui.cerca')}}</p>
          <form class="mobile-search-form" action="{{route('ad.search')}}" method="GET">
            @csrf
            <input class="mobile-search-input d-inline" type="search" name="q">
            <button class="btn btn-custom mobile-search-button" type="submit"><i class="fas fa-arrow-right"></i></button>
          </form>
        </div>
      </li>
    </ul>
    <i class="close-icon fa-solid fa-x invisible"></i>
  </div>
</nav>
@endmobile