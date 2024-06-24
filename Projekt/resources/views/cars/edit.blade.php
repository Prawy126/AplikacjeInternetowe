@include('shared.head', ['pageTitle' => 'Użytkownik ' . $announcement->name])
@include('shared.navbar')

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2>Edytuj ogłoszenie</h2>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('announcements.update', $announcement->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Marka</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $announcement->name) }}" required maxlength="30">
                            </div>

                            <div class="mb-3">
                                <label for="brand" class="form-label">Model</label>
                                <input type="text" class="form-control" id="brand" name="brand"
                                    value="{{ old('brand', $announcement->brand) }}" required maxlength="30">
                            </div>

                            <div class="mb-3">
                                <label for="year" class="form-label">Rok produkcji</label>
                                <input type="number" class="form-control" id="year" name="year"
                                    value="{{ old('year', $announcement->year) }}" required min="1976" max="{{ date('Y') }}">
                            </div>

                            <div class="mb-3">
                                <label for="mileage" class="form-label">Przebieg</label>
                                <input type="number" class="form-control" id="mileage" name="mileage"
                                    value="{{ old('mileage', $announcement->mileage) }}" required min="0">
                            </div>

                            <div class="mb-3">
                                <label for="min_price" class="form-label">Cena</label>
                                <input type="number" class="form-control" id="min_price" name="min_price"
                                    value="{{ old('min_price', $announcement->min_price) }}" required min="0" step="0.01">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Opis</label>
                                <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $announcement->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">Data końcowa</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                    value="{{ old('end_date', \Carbon\Carbon::parse($announcement->end_date)->format('Y-m-d\TH:i')) }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="carImages" class="form-label">Zdjęcia</label>
                                <input type="file" class="form-control" id="carImages" name="images[]" multiple accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-success">Zapisz zmiany</button>
                            <a href="{{ route('cars.index') }}" class="btn btn-secondary">Anuluj</a>
                        </form>

                        <div class="container mt-5">
                            <h4>Aktualne zdjęcia</h4>
                            <div class="row">
                                @foreach ($announcement->photos as $photo)
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $photo->photo_name) }}" class="img-fluid mb-2">
                                        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('shared.footer', ['fixedBottom' => true])
</body>
