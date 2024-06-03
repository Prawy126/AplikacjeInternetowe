@include('shared.html')

@include('shared.head', ['pageTitle' => 'Admin'])

@include("shared.navbar")
<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Sekcja zarządzania użytkownikami -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2>Użytkownicy</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nazwa</th>
                                    <th>Email</th>
                                    <th>Rola</th>
                                    <th>Akcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if ($user->role === 'user')
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <a href="{{ route('admin.editUser', $user->id) }}"
                                                    class="btn btn-sm btn-warning">Edytuj</a>
                                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Usuń</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sekcja przeglądania ofert -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2>Oferty</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Marka</th>
                                    <th>Model</th>
                                    <th>Rok</th>
                                    <th>Akcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($announcements as $announcement)
                                    <tr>
                                        <td>{{ $announcement->id }}</td>
                                        <td>{{ $announcement->name }}</td>
                                        <td>{{ $announcement->brand }}</td>
                                        <td>{{ $announcement->year }}</td>
                                        <td>
                                            <a href="{{ route('admin.editAnnouncement', $announcement->id) }}"
                                                class="btn btn-sm btn-warning">Edytuj</a>
                                            <form action="{{ route('admin.deleteAnnouncement', $announcement->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Usuń</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sekcja wykresów i statystyk -->
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h2>Liczba ogłoszeń na użytkownika</h2>
                    </div>
                    <div class="card-body">
                        <canvas id="userAnnouncementsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h2>Statystyki</h2>
                    </div>
                    <div class="card-body">
                        <p><strong>Średnia liczba ogłoszeń na użytkownika:</strong> {{ number_format($averageAnnouncementsPerUser, 2) }}</p>
                        <p><strong>Średnia liczba ofert na dzień:</strong> {{ number_format($averageOffersPerDay, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dane do wykresu liczby ogłoszeń na użytkownika
        const userAnnouncements = @json($userAnnouncements);
        const userNames = userAnnouncements.map(user => user.email);
        const announcementCounts = userAnnouncements.map(user => user.announcements_count);

        const ctx = document.getElementById('userAnnouncementsChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: userNames,
                datasets: [{
                    label: 'Liczba ogłoszeń',
                    data: announcementCounts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw} ogłoszeń`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
@include('shared.footer')
