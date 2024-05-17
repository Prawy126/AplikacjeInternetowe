@include('shared.html')

@include('shared.head', ['pageTitle' => 'Komis samochodowy'])
<body>
    @include('shared.navbar')

    <div id="start">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/image.png') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-white">Najlepsze ceny</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/image2.png') }}" class="d-block w-100" alt="...">
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
                        <img src="{{ asset('img/'.$car->randomPhoto()->photo_name) }}" class="card-img-top" alt="{{ $car->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->name }}</h5>
                            <p class="card-text">{{ $car->description }}</p>
                            <a href="{{ route('cars.show', ['id' => $car->id]) }}" class="btn btn-primary">Więcej szczegółów...</a>
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
            <h1>Ostatnio licytowane</h1>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Samochód</th>
                        <th scope="col">Kwota</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentBids as $bid)
                        <tr>
                            <th scope="row">{{ $bid->id }}</th>
                            <td>{{ $bid->announcement->name }} {{ $bid->announcement->brand }}</td>
                            <td>{{ $bid->amount }} PLN</td>
                            <td>{{ $bid->time }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="4">Brak licytacji.</th>
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
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormSelect1">Wybierz kategorię</label>
                        <select class="form-select" id="exampleFormControlSelect1">
                            <option selected>miejski</option>
                            <option>terenowy</option>
                            <option>sportowy</option>
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

    @include('shared.footer', ['fixedBottom' => true])
</body>
</html>
