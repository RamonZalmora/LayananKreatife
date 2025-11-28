<x-app-layout :title="'Dashboard'" :subtitle="'Selamat datang, '.Auth::user()->name">

    <style>
        .digital-clock {
            font-size: 3rem;
            font-weight: bold;
            letter-spacing: 4px;
            display: flex;
            gap: 10px;
        }

        .time-box {
            padding: 10px 20px;
            background: #111;
            color: #00ffcc;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #00ffcc;
            transition: 0.2s ease-in-out;
            opacity: 1;
        }

        .time-box.fade {
            opacity: 0.3;
        }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

            <!-- STATISTIK -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

                <div class="bg-white p-6 rounded shadow">
                    <h2 class="text-xl font-bold">Total Tasks</h2>
                    <p class="text-3xl mt-2" id="totalTasksNumber">{{ $totalTasks }}</p>
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

            <!-- CUACA & WAKTU -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <!-- CUACA REALTIME -->
                <div class="bg-blue-100 p-6 rounded shadow">
                    <h2 class="text-xl font-bold mb-2">Cuaca di pekanbaru (Realtime)</h2>

                    <p class="text-3xl font-bold" id="weatherTemp">-- °C</p>
                    <p class="mt-2" id="weatherDesc">Mengambil data...</p>
                </div>

                <!-- WAKTU SERVER -->
                <div class="bg-gray-100 p-6 rounded shadow">
                    <h2 class="text-xl font-bold mb-2">Waktu Server (Realtime)</h2>

                    <div class="digital-clock">
                        <div id="h" class="time-box">00</div>
                        <div id="m" class="time-box">00</div>
                        <div id="s" class="time-box">00</div>
                    </div>

                    <p id="serverDate" class="mt-2"></p>
                </div>

            </div>

            <!-- CHART -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-xl font-bold mb-4">Task Created (7 days)</h2>
                <canvas id="taskChart"></canvas>
            </div>

        </div>
    </div>

    <!-- CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- CHART -->
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

    <!-- CUACA AJAX -->
    <script>
        function loadWeather() {
            $.ajax({
                url: "/api/weather",
                method: "GET",
                success: function (res) {

                    if (res.error) {
                        $("#weatherTemp").text("-- °C");
                        $("#weatherDesc").text(res.message);
                        return;
                    }

                    $("#weatherTemp").text(res.temperature + " °C");
                    $("#weatherDesc").text("Kecepatan angin: " + res.windspeed + " km/h");
                }
            });
        }

        loadWeather();
        setInterval(loadWeather, 30000);
    </script>

    <!-- WAKTU SERVER + JAM DIGITAL -->
    <script>
        function animateTimeBox(box, value) {
            box.classList.add("fade");
            setTimeout(() => {
                box.innerText = value;
                box.classList.remove("fade");
            }, 150);
        }

        function updateDigitalClock(time) {
            let parts = time.split(":");
            animateTimeBox(document.getElementById("h"), parts[0]);
            animateTimeBox(document.getElementById("m"), parts[1]);
            animateTimeBox(document.getElementById("s"), parts[2]);
        }

        function loadServerTime() {
            $.ajax({
                url: "/api/server-time",
                method: "GET",
                success: function (res) {
                    updateDigitalClock(res.time);
                    $("#serverDate").text(res.date);
                }
            });
        }

        loadServerTime();
        setInterval(loadServerTime, 1000);
    </script>

</x-app-layout>
