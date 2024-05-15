@include('shared.html')

  @include('shared.head', ['pageTitle' => 'Komis samochodowy'])
  <body>
    @include('shared.navbar')

    <div id="start">
      <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/image.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="text-white">Najlepsze ceny</h1>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/image2.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="text-white">Najlepsza jakość</h1>
            </div>
          </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div id="wycieczki" class="container mt-5">
      <div class="row">
        <h1>Aukcje</h1>
      </div>
      <div class="row">
        @forelse ($randomCars as $car)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card">
                    <div>
                        {{ asset( $car->img) }}
                    </div>

                    <img src="{{ asset('img/'.$car->img) }}" class="card-img-top">
                    <div class="card-body">
                        <img src="{{ asset($car->img) }}" class="card-img-top">
                        <h5 class="card-title">{{ $car->name }}</h5>
                        <p class="card-text">{{ $car->description }}</p>
                        <a href="{{route('cars.show', ['id' => $car->id])}}" class="btn btn-primary">Więcej szczegółów...</a>
                    </div>
                </div>
            </div>
            @empty
                <p>Brak ogłoszeń.</p>
            @endforelse
        </div>
    </div>

    <div id="cennik" class="container mt-5 mb-5">
      <div class="row">
          <h1>Aktualnie licytowane</h1>
      </div>
      @can('is-admin')
      <div class="row mb-2">
        <a href="{{ route('trips.image_upload') }}">Dodaj nowy obrazek</a>
      </div>
      @endcan
      <div class="table-responsive-sm">
        <table class="table table-hover table-striped">
          <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nazwa wycieczki</th>
                  <th scope="col">Kontynent</th>
                  <th scope="col">Kraj</th>
                  <th scope="col">Okres</th>
                  <th scope="col">Cena</th>
                  <th scope="col"></th>
                  @can('is-admin')
                    <th scope="col"></th>
                  @endcan
              </tr>
          </thead>
          <tbody>
            @forelse ($cars as $car)
                <tr>
                    <th scope="row">{{$car->id}}</th>

                    <td>{{$car->brand}}</td>
                    <td>{{$car->name}}</td>
                    <td>{{$car->description}} dni</td>
                    <td>{{$car->price}} PLN</td>
                    <td>

                    </td>
                    @can('is-admin')
                        <td><a href="{{route('trips.edit', $trip->id)}}">Edycja</a></td>
                    @endcan
                </tr>
            @empty
                <tr>
                    <th scope="row" colspan="6">Brak wycieczek.</th>
                </tr>
            @endforelse
          </tbody>
      </table>
      </div>
    </div>

    <div id="inne" class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 mb-4">
          <h2>Jak kupować samochody używane</h2>
          <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/OUJXrHUSKIE"></iframe>
        </div>
        </div>
        <div class="col-sm-12 col-md-6">
          <h2>Skontaktuj się z nami</h2>
          <form>
            <div class="mt-2 mb-3">
                <label for="exampleFormControlInput1">Adres email</label>
                <input type="email" class="form-control" id="exampleFormControlInput1"
                    placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormSelect1">Skontaktuj się z nami</label>
                <select class="form-select" id="exampleFormControlSelect1">
                    <option selected>indywidualna</option>
                    <option>grupowa</option>
                    <option>specjalna</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlAmount">Budżet</label>
                <div class="input-group mb-3">
                  <input type="number" min="0" placeholder="20000" step="any" class="form-control" aria-label="Amount">
                  <span class="input-group-text">PLN</span>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1">Komentarz</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <a href="#" class="btn btn-primary">Wyślij</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    @include('shared.footer', ['fixedBottom' => false])

</html>
