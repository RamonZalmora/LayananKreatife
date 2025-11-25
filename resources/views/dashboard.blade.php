<x-app-layout :title="'Dashboard'" :subtitle="'Selamat datang, '.Auth::user()->name">

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

                <div class="bg-white p-6 rounded shadow">
                    <h2 class="text-xl font-bold">Total Tasks</h2>
                    <p class="text-3xl mt-2">{{ $totalTasks }}</p>
                </div>

                <div class="bg-green-100 p-6 rounded shadow">
                    <h2 class="text-xl font-bold">Completed</h2>
                    <p class="text-3xl mt-2">{{ $completed }}</p>
                </div>

                <div class="bg-yellow-100 p-6 rounded shadow">
                    <h2 class="text-xl font-bold">In Progress</h2>
                    <p class="text-3xl mt-2">{{ $inProgress }}</p>
                </div>

                <div class="bg-red-100 p-6 rounded shadow">
                    <h2 class="text-xl font-bold">Pending</h2>
                    <p class="text-3xl mt-2">{{ $pending }}</p>
                </div>

            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-xl font-bold mb-4">Task Created (7 days)</h2>
                <canvas id="taskChart"></canvas>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('taskChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData->pluck('date')) !!},
                datasets: [{
                    label: 'Tasks Created',
                    data: {!! json_encode($chartData->pluck('total')) !!},
                    borderWidth: 3,
                    borderColor: 'blue',
                    backgroundColor: 'lightblue'
                }]
            }
        });
    </script>

</x-app-layout>
