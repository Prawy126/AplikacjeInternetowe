@include('shared.html')

@include('shared.head', ['pageTitle' => 'Admin'])

@include('shared.navbar')

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2>Edytuj użytkownika</h2>
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

                        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Imię</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" required maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label for="surname" class="form-label">Nazwisko</label>
                                <input type="text" class="form-control" id="surname" name="surname"
                                    value="{{ old('surname', $user->surname) }}" required maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" required maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Adres</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address', $user->address) }}" required maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Numer telefonu</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                    value="{{ old('phone_number', $user->phone_number) }}" required pattern="[0-9]{9,15}">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Rola</label>
                                <input type="text" class="form-control" id="role" name="role"
                                    value="{{ old('role', $user->role) }}" required maxlength="50">
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
