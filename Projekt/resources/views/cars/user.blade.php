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
                <div class="card">
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
                                                <h3>Rok produkcji: {{$announcement->year}}</h3>
                                                <a href="{{ route('cars.show', $announcement->id) }}"
                                                    class="btn btn-primary">Edytuj</a>
                                                    <a href="" class="btn btn-danger">Usuń</a>
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
    @include('shared.footer')
</body>
