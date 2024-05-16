@include('shared.html')

@include('shared.head', ['pageTitle' => 'Samochód: '.$car->name])
<body>
    @include('shared.navbar')

    <div id="wycieczki" class="container mt-5 mb-5">
        <div class="row m-2 text-center">
            <h1>{{ $car->name . ' ' . $car->brand }}</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-sm-6 col-lg-6">
                <div class="card">
                    <div id="carPhotosCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if ($car->photos->isNotEmpty())
                                @foreach($car->photos as $key => $photo)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('img/'.$photo->photo_name) }}" class="d-block w-100" alt="{{ $car->name }}">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/default.jpg') }}" class="d-block w-100" alt="Brak zdjęć">
                                </div>
                            @endif
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carPhotosCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carPhotosCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->name . ' ' . $car->brand }}</h5>
                        <h4>Opis:</h4>
                        <p class="card-text">{{ $car->description }}</p>
                        <h4>Rok produkcji:</h4>
                        <p>{{ $car->year }}</p>
                        <h4>Przebieg:</h4>
                        <p>{{ $car->mileage . ' km' }}</p>
                        <h4>Data końca licytacji:</h4>
                        <p>{{ $car->end_date }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <h5 class="card-title">{{ $car->min_price }} zł</h5>
                        <a href="#" class="btn btn-primary">Licytuj</a>
                        @if(!empty($promoPrice) && $promoPrice != $car->min_price)
                            <h5 class="card-title">{{ $promoPrice }} zł</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.footer')
</body>
</html>
