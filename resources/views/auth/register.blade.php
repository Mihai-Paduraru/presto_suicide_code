<x-layout>

  <div class="container p-3">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <h1 class=" text-center">{{__('ui.register')}}</h1>
        </div> 
        <div class="col-12 d-flex justify-content-center">
          <img src="/media/logo_orz.svg" class="logo_register_login img-fluid" alt="">
        </div> 
    </div>
  </div>

  <div class="container vh-100 py-5">
    <div class="row justify-content-center align-items-center shadow">
      <div class="col-12 col-md-6 p-3">
        <form method="POST" action="{{route('register')}}">
            @csrf
            <div class="mb-3">
                <label for="usernameInput" class="form-label">Username</label>
                <input type="text" name="name" class="form-control" id="usernameInput" value="{{old('name')}}">
              </div>
            <div class="mb-3">
              <label for="emailInput" class="form-label">{{__('ui.email')}}</label>
              <input type="email" name="email" class="form-control" id="emailInput" aria-describedby="emailHelp" value="{{old('email')}}">
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="passwordInput">
              </div>
              <div class="mb-3">
                <label for="passwordConfirmInput" class="form-label">{{__('ui.confermaPassword')}}</label>
                <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmInput">
              </div>
            <button type="submit" class="btn btn-custom d-block mx-auto">{{__('ui.submit')}}</button>
          </form>
          <p class="text-center pt-3">{{__('ui.seiGiàRegistrato')}}<a href="{{route('login')}}">{{__('ui.cliccaQui')}}</a></p>
      </div>
    </div>
  </div>
</x-layout>