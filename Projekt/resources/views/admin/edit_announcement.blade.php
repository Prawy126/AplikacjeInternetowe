@include('shared.html')

@include('shared.head', ['pageTitle'=> 'Admin'])

@include("shared.navbar")
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2>Edytuj ogłoszenie</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.updateAnnouncement', $announcement->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Marka</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $announcement->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="brand" class="form-label">Model</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $announcement->brand) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Rok produkcji</label>
                            <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $announcement->year) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="mileage" class="form-label">Przebieg</label>
                            <input type="number" class="form-control" id="mileage" name="mileage" value="{{ old('mileage', $announcement->mileage) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="min_price" class="form-label">Cena</label>
                            <input type="number" class="form-control" id="price" name="min_price" value="{{ old('min_price', $announcement->min_price) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Opis</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $announcement->description) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Zapisz zmiany</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Anuluj</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('shared.footer')
</body>

