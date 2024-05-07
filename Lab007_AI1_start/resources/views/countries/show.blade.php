@include('shared.html')

@include('shared.head', ['pageTitle' => 'Kraj'])

<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-left">Kraj</h1>
                <table class="table">
                    <tr class="table-light">
                        <th>Nazwa</th>
                        <td>{{ $c->name }}</td>
                    </tr>
                    <tr>
                        <th>Kod</th>
                        <td>{{ $c->code }}</td>
                    </tr>
                    <tr class="table-light">
                        <th>Waluta</th>
                        <td>{{ $c->currency }}</td>
                    </tr>
                    <tr>
                        <th>Powierzchnia</th>
                        <td>{{ $c->area }}</td>
                    </tr>
                    <tr class="table-light">
                        <th>Język</th>
                        <td>{{ $c->language }}</td>
                    </tr>
                </table>
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('countries.edit', $c->id) }}" class="btn btn-primary">Edycja</a>
                    <form method="POST" action="{{ route('countries.destroy', $c->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('shared.footer')
</body>

</html>
