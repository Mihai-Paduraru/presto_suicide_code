<x-layout>
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-10">
        <h2 class="text-center">{{__('ui.inserisciIlTuoAnnuncio')}} </h2>
      </div>
    </div>
  </div>

  <div class="container py-5">
    <div class="row justify-content-center align-items-center shadow">
      <div class="col-12 col-md-6 ">
        
        <form method="POST" action="{{route('ad.store')}}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="uniqueSecret" value={{$uniqueSecret}}>

          <div class="mb-3">
              <label for="titleInput" class="form-label">{{__('ui.titolo')}}</label>
              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="titleInput" value="{{old('title')}}">
  
              @error('title')
              <p class="small fst-italic text-danger">{{$message}}</p>
              @enderror
  
            </div>
          <div class="mb-3">
            <label for="decriptionInput" class="form-label">{{__('ui.descrizione')}}</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
            @error('description')
              <p class="small fst-italic text-danger">{{$message}}</p>
              @enderror
          </div>
          <div class="mb-3">
            <label for="priceInput" class="form-label">{{__('ui.prezzo')}}</label>
            <input type="number" step="0.01" name="price" placeholder="Euro (Es. '123.45')" class="form-control @error('price') is-invalid @enderror" id="priceInput" value="{{old('price')}}"><p class="d-inline"></p>
            @error('price')
              <p class="small fst-italic text-danger">{{$message}}</p>
              @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">{{__('ui.inserisciUnaOPiùImmagini')}} </label>
            <div class="dropzone" id="drophere">
              <div class="dz-message" data-dz-message><span>{{__('ui.inserisciQuiLeTueImmagini')}} </span></div>
            </div>
          </div>
          <div class="mb-3">
            <label for="categoryInput" class="form-label ">{{__('ui.categoria')}}</label>
            <select name="category" id="categoryInput">
              @foreach($categories as $category)
              <option value="{{$category->id}}">{{__('ui.' . ucfirst($category->name))}}</option>
              @endforeach
            </select>
          </div>
          <div class="my-3">
            <button type="submit" class="btn btn-custom d-block mx-auto ">{{__('ui.submit')}}</button>
          </div>
        </form>

        
      </div>
    </div>
  </div>

</x-layout>