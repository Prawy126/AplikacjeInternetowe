@include('shared.html')

@include('shared.head', ['pageTitle' => 'Błąd 405'])

<style>
    body{
        background-image: url('img/403.webp');
    }
</style>


<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">

        @if (session('error'))
            <div class="row d-flex justify-content-center">

                <div class="alert alert-danger">{{ session('error') }}</div>
            </div>
        @endif

        <div class="row mt-4 mb-4 text-center card">

            <h1 class="display-1 fw-bold">403</h1>
            <h2>
                @if (App::environment('local'))
                    <h1>Nie posiadasz dostępu do tej strony</h1>
                @else
                    not found
                @endif

            </h2>
        </div>
    </div>

    @include('shared.footer')
    <script>
        document.getElementById("navbar-user").remove();
    </script>
</body>

</html>

