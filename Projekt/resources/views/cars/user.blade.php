@include('shared.html')

@include('shared.head', ['pageTitle' => 'Użytkownik ' . $user->name])

<body>
    @include('shared.navbar')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Karta użytkownika -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h1 class="card-title">{{ $user->name . ' ' . $user->surname }}</h1>
                    </div>
                    <div class="card-body">
                        <h4>Dane:</h4>
                        <div class="table-responsive-sm mt-3">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Imię</th>
                                        <th scope="col">Nazwisko</th>
                                        <th scope="col">Adres</th>
                                        <th scope="col">Numer telefonu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Karta ogłoszeń -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h2>Moje ogłoszenia</h2>
                    </div>
                    <div class="card-body">
                        @if ($announcements->isEmpty())
                            <p>Brak ogłoszeń.</p>
                        @else
                            <div class="row">
                                @foreach ($announcements as $announcement)
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3>Marka: {{ $announcement->name }}</h3>
                                                <h3>Model: {{ $announcement->brand }}</h3>
                                                <h3>Rok produkcji: {{ $announcement->year }}</h3>
                                                <a href="{{ route('cars.edit', $announcement->id) }}"
                                                    class="btn btn-primary">Edytuj</a>
                                                <form action="{{ route('cars.destroy', $announcement->id) }}"
                                                    method="POST" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger container-fluid">Usuń</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Karta dodania ogłoszenia -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h2>Dodaj nowe ogłoszenie</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('announcements.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="carName" class="form-label">Marka</label>
                                <input type="text" class="form-control" id="carName" name="name"
                                    placeholder="Wprowadź markę samochodu" required>
                            </div>
                            <div class="mb-3">
                                <label for="carBrand" class="form-label">Model</label>
                                <input type="text" class="form-control" id="carBrand" name="brand"
                                    placeholder="Wprowadź model samochodu" required>
                            </div>
                            <div class="mb-3">
                                <label for="carYear" class="form-label">Rok produkcji</label>
                                <input type="number" class="form-control" id="carYear" name="year"
                                    placeholder="Wprowadź rok produkcji" required>
                            </div>
                            <div class="mb-3">
                                <label for="carMileage" class="form-label">Przebieg (km)</label>
                                <input type="number" class="form-control" id="carMileage" name="mileage"
                                    placeholder="Wprowadź przebieg samochodu" required>
                            </div>
                            <div class="mb-3">
                                <label for="carDescription" class="form-label">Opis</label>
                                <textarea class="form-control" id="carDescription" name="description" rows="3" placeholder="Dodaj opis samochodu"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="carEndDate" class="form-label">Data zakończenia</label>
                                <input type="datetime" class="form-control" id="carEndDate" name="end_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="carMinPrice" class="form-label">Cena minimalna (PLN)</label>
                                <input type="number" class="form-control" id="carMinPrice" name="min_price"
                                    placeholder="Wprowadź cenę minimalną" step="0.01" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Dodaj ogłoszenie</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Karta aukcji, w których użytkownik bierze udział -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h2>Aukcje, w których biorę udział</h2>
                    </div>
                    <div class="card-body">
                        @if ($participatingAuctions->isEmpty())
                            <p>Nie bierzesz udziału w żadnych aukcjach.</p>
                        @else
                            <div class="row">
                                @foreach ($participatingAuctions as $auction)
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3>Marka: {{ $auction->announcement->name }}</h3>
                                                <h3>Model: {{ $auction->announcement->brand }}</h3>
                                                <h3>Rok produkcji: {{ $auction->announcement->year }}</h3>
                                                <p>Data końca licytacji: {{ $auction->announcement->end_date }}</p>
                                                <p>Najwyższa oferta użytkownika: {{ $auction->amount }}</p>
                                                <a class="btn btn-primary" href="{{ route('cars.show' ,[ $auction->announcement->id])}}">Przeglądaj</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('shared.footer', ['fixedBottom' => true])
</body>

</html>
