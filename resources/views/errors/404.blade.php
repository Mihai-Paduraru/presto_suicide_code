<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content={{csrf_token()}}>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <title>Presto.it</title>
    <link rel="shortcut icon" href="{{asset('/media/icona.svg')}}" type="image/x-icon">
</head>
<body>
    
    <section class="container py-5 d-flex align-items center justify-content-center">
        <div class="row text-center align-items-center justify-content-center">
            <h2>{{__('ui.notFound')}}</h2>
          <div class="col-12 col-md-6">
            <img src="/media/logo_orz.svg" alt="Logo del sito">
            <p>{{__('ui.notFoundSubtitle')}}</p>
            <a href="{{route('homepage')}}" class="btn btn-custom align-self-end">{{__('ui.back')}}</a>
          </div>
        </div>

    </section>
    <script src="{{asset('/js/app.js')}}"></script>
</body>
</html>