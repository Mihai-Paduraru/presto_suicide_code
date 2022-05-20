<x-layout>

  <div class="container p-3">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
          <h1 class="text-center">{{__('ui.login')}}</h1>
        </div> 
        <div class="col-12 d-flex justify-content-center">
          <img src="/media/logo_orz.svg" class="logo_register_login img-fluid" alt="">
        </div> 
    </div>
  </div>

  <div class="container vh-100 py-5">
    <div class="row justify-content-center align-items-center shadow">
      <div class="col-12 col-md-6 p-3">
        <form method="POST" action="{{route('login')}}">
            @csrf
            <div class="mb-3">
              <label for="emailInput" class="form-label">{{__('ui.email')}}</label>
              <input type="email" name="email" class="form-control" id="emailInput" aria-describedby="emailHelp" value="{{old('email')}}">
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="passwordInput">
              </div>
            <button type="submit" class="btn btn-custom mx-auto d-block">{{__('ui.entra')}}</button>
          </form>
          <p class="text-center pt-3">{{__('ui.nonSeiRegistrato')}} <a href="{{route('register')}}">{{__('ui.cliccaQui')}}</a></p>
      </div>
    </div>
  </div>

  
</x-layout>
