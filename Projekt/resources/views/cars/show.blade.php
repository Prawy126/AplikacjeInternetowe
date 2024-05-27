@include('shared.html')

@include('shared.head', ['pageTitle' => 'Samochód: '.$announcement->name])
<body>
    @include('shared.navbar')

    <div id="wycieczki" class="container mt-5 mb-5">
        <div class="row m-2 text-center">
            <h1>{{ $announcement->name . ' ' . $announcement->brand }}</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-sm-6 col-lg-6">
                <div class="card">
                    <div id="carPhotosCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if ($announcement->photos->isNotEmpty())
                                @foreach($announcement->photos as $key => $photo)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('img/'.$photo->photo_name) }}" class="d-block w-100" alt="{{ $announcement->name }}">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/brak.webp') }}" class="d-block w-100" alt="Brak zdjęć">
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
                        <h5 class="card-title">{{ $announcement->name . ' ' . $announcement->brand }}</h5>
                        <h4>Opis:</h4>
                        <p class="card-text">{{ $announcement->description }}</p>
                        <h4>Rok produkcji:</h4>
                        <p>{{ $announcement->year }}</p>
                        <h4>Przebieg:</h4>
                        <p>{{ $announcement->mileage . ' km' }}</p>
                        <h4>Data końca licytacji:</h4>
                        <p>{{ $announcement->end_date }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <h5 class="card-title">Cena minimalna: {{ $announcement->min_price }} zł</h5>
                        @if($highestBid)
                            <h5 class="card-title">Aktualnie oferowana cena: {{ $highestBid->amount }} zł</h5>
                        @else
                            <h5 class="card-title">Aktualnie brak ofert</h5>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(!$announcement->is_ended)
                            <div class="alert alert-warning">Licytacja zakończona</div>
                            @if($highestBid)
                                <h5 class="card-title">Zwycięzca licytacji: {{ $highestBid->user->email }}</h5>
                            @endif
                            <button type="button" class="btn btn-secondary" disabled>Licytuj</button>
                        @else
                            <form action="{{ route('bids.store', $announcement->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="number" name="amount" class="form-control" placeholder="Wpisz kwotę licytacji" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Licytuj</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.footer', ['fixedBottom' => true])
</body>
</html>
