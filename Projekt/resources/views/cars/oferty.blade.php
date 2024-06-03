@include('shared.html')

@include('shared.head', ['pageTitle' => 'Komis samochodowy'])

<body>
    @include('shared.navbar')
    <div id="car" class="container mt-5">
        <div class="row">
            <h1>Aukcje</h1>
        </div>
        <div class="row">
            @forelse ($cars as $car)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card">
                        @if (!empty($car->randomPhoto()) && !empty($car->randomPhoto()->photo_name))
                            <img src="{{ asset('storage/' . $car->randomPhoto()->photo_name) }}" class="card-img-top"
                                alt="{{ $car->name }}">
                        @else
                            <img src="img/brak.webp" class="card-img-top" alt="{{ $car->name }}">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $car->name }}</h5>
                            <p class="card-text">{{ $car->description }}</p>
                            <a href="{{ route('cars.show', ['id' => $car->id]) }}" class="btn btn-primary">Więcej
                                szczegółów...</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Brak ogłoszeń.</p>
            @endforelse
        </div>
    </div>
    @include('shared.footer', ['fixedBottom' => true])
</body>
