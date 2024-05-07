@include('shared.html')
@include('shared.head', ['pageTitle' => 'Edit Trip'])
@include('shared.navbar')
@include('shared.session-error')
@include('shared.validation-error')

<div class="container mt-5">
    <h1>Edytuj dane wycieczki</h1>
    <form action="{{ route('trips.update', $trip->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $trip->name }}">
        </div>

        <div class="mb-3">
            <label for="continent" class="form-label">Kontynent</label>
            <input type="text" class="form-control" id="continent" name="continent" value="{{ $trip->continent }}">
        </div>

        <div class="mb-3">
            <label for="period" class="form-label">Okres</label>
            <input type="number" class="form-control" id="period" name="period" value="{{ $trip->period }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <textarea class="form-control" id="description" name="description">{{ $trip->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Cena</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $trip->price }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Nazwa obrazka</label>
            <input type="text" class="form-control" id="image" name="image" value="{{ $trip->img }}">
        </div>

        <div class="mb-3">
            <label for="country_id" class="form-label">Kraj</label>
            <select name="country_id" class="form-select">
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ $country->id == $trip->country_id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Wyślij</button>
        </div>
    </form>
</div>

@include('shared.footer')
</body>
</html>
