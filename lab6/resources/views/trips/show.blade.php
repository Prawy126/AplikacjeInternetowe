<!doctype html>
<html lang="pl" data-bs-theme="">
<head>
  @include('shared.head', ['pageTitle' => 'Wycieczka: ' . $trip->name])
</head>
<body>
  @include('shared.navbar')

  <div class="container mt-5">
      <div class="row">
        <div class="col text-center">
          <h1>{{ $trip->name }}</h1>
        </div>
      </div>
      <div class="row">
      <div class="col">
        <div class="card">
          <img src="{{asset('storage/img/'. $trip->img)}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{ $trip->name }}</h5>
            <p class="card-text">{{ $trip->description }}</p>
            <p class="card-text"><strong>Cena: </strong>{{ $trip->price }} zł</p>
            <p class="card-text"><strong>Czas trwania: </strong>{{ $trip->period }} dni</p>
            <p class="card-text"><strong>Kontynent: </strong>{{ $trip->continent }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('shared.footer')
  <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>
</html>
