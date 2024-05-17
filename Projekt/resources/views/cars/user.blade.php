@include('shared.html')

@include('shared.head', ['pageTitle' => "Używkonik ".$user->name])
<body>
    @include('shared.navbar')
    <h1>{{$user->name . " " . $user->surname}}</h1>
    <h4>Dane:</h4>
    <div class="table-responsive-sm">
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
                        <td>{{ $user->name }} </td>
                        <td>{{ $user->surname }} </td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->phone_number }}</td>
                    </tr>
            </tbody>
        </table>
    </div>
</body>
