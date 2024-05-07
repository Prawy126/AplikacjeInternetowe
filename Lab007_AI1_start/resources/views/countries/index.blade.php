@include('shared.html')

@include('shared.head', ['pageTitle' => 'Kraje'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        <div class="row mb-1">
            <h1>Kraje</h1>
        </div>
        <div class="row mb-2">
            <a href="{{ route('countries.create') }}">Dodaj nowy kraj</a>
        </div>
        @include('shared.session-error')
        @include('shared.validation-error')
        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Kod</th>
                        <th scope="col">Waluta</th>
                        <th scope="col">Powierzchnia</th>
                        <th scope="col">Język</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($countries as $c)
                        <tr>
                            <th scope="row"><a href="{{ route("countries.show", $c->id) }}">{{ $c->id }}</td>
                            <td scope="row">{{ $c->name }}</td>
                            <td scope="row">{{ $c->code }}</td>
                            <td scope="row">{{ $c->currency }}</td>
                            <td scope="row">{{ $c->area }}</td>
                            <td scope="row">{{ $c->language }}</td>
                            {{-- <td><a href="{{route('countries.edit', $c->id)}}">Edycja</a></td> --}}
                            <td><a href="{{route('countries.edit', $c)}}">Edycja</a></td> 
                            <td>
                                <form method="POST" action="{{ route('countries.destroy', $c->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                </form>
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="6">Brak krajów.</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('shared.footer')
</body>

</html>
