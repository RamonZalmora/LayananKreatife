<x-app-layout :title="'Dashboard'" :subtitle="'Selamat datang kembali, '.Auth::user()->name">

    <style>
        /* Digital Clock Style */
        .digital-clock {
            font-size: 3rem;
            font-weight: bold;
            letter-spacing: 4px;
            display: flex;
            gap: 10px;
        }

        .time-box {
            padding: 10px 22px;
            background: #0b0b0f;
            color: #00ffd5;
            border-radius: 12px;
            box-shadow: 0px 0px 12px #00ffd5;
            transition: 0.2s ease-in-out;
            opacity: 1;
        }

        .time-box.fade {
            opacity: 0.3;
        }

        /* Quick Button Hover */
        .quick-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 255, 255, 0.2);
        }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">

            <!-- TITLE -->
            <div class="mb-8">
                <h1 class="text-4xl font-extrabold tracking-wide">🚀 Dashboard Utama</h1>
                <p class="text-gray-400 mt-1 text-lg">Pantau produktivitas, cuaca, waktu, dan ringkasan cepat.</p>
            </div>

            <!-- QUICK ACCESS -->
            <h2 class="text-xl font-bold mb-3">Akses Cepat</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-10">

                <a href="{{ route('tasks.index') }}"
                    class="quick-btn p-4 bg-darkcard rounded-xl border border-gray-700 flex flex-col items-center text-center transition">
                    <span class="text-3xl mb-2">📝</span>
                    <p class="font-bold">Tasks</p>
                </a>

                <a href="{{ route('inventories.index') }}"
                    class="quick-btn p-4 bg-darkcard rounded-xl border border-gray-700 flex flex-col items-center text-center transition">
                    <span class="text-3xl mb-2">📦</span>
                    <p class="font-bold">Inventory</p>
                </a>

                <a href="{{ route('expenses.index') }}"
                    class="quick-btn p-4 bg-darkcard rounded-xl border border-gray-700 flex flex-col items-center text-center transition">
                    <span class="text-3xl mb-2">💰</span>
                    <p class="font-bold">Expenses</p>
                </a>

                <a href="{{ route('categories.index') }}"
                    class="quick-btn p-4 bg-darkcard rounded-xl border border-gray-700 flex flex-col items-center text-center transition">
                    <span class="text-3xl mb-2">📂</span>
                    <p class="font-bold">Categories</p>
                </a>

                <a href="{{ route('profile.edit') }}"
                    class="quick-btn p-4 bg-darkcard rounded-xl border border-gray-700 flex flex-col items-center text-center transition">
                    <span class="text-3xl mb-2">👤</span>
                    <p class="font-bold">Profile</p>
                </a>

            </div>

            <!-- STATISTICS -->
            <h2 class="text-xl font-bold mb-3">Statistik Tugas</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

                <div class="p-6 rounded-xl shadow bg-gradient-to-br from-indigo-600 to-indigo-800 text-white">
                    <h2 class="text-lg font-bold">Total Tasks</h2>
                    <p class="text-4xl mt-3 font-extrabold">{{ $totalTasks }}</p>
                </div>

                <div class="p-6 rounded-xl shadow bg-gradient-to-br from-green-500 to-green-700 text-white">
                    <h2 class="text-lg font-bold">Completed</h2>
                    <p class="text-4xl mt-3 font-extrabold">{{ $completed }}</p>
                </div>

                <div class="p-6 rounded-xl shadow bg-gradient-to-br from-yellow-400 to-yellow-600 text-white">
                    <h2 class="text-lg font-bold">In Progress</h2>
                    <p class="text-4xl mt-3 font-extrabold">{{ $inProgress }}</p>
                </div>

                <div class="p-6 rounded-xl shadow bg-gradient-to-br from-red-500 to-red-700 text-white">
                    <h2 class="text-lg font-bold">Pending</h2>
                    <p class="text-4xl mt-3 font-extrabold">{{ $pending }}</p>
                </div>

            </div>

            <!-- WEATHER & TIME -->
            <h2 class="text-xl font-bold mb-3">Informasi Realtime</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

                <!-- Weather -->
                <div class="bg-darkcard border border-gray-700 p-6 rounded-xl shadow-xl">
                    <h2 class="text-xl font-bold mb-2">☁️ Cuaca di Pekanbaru</h2>
                    <p id="weatherTemp" class="text-4xl font-bold">-- °C</p>
                    <p class="text-gray-300 mt-2" id="weatherDesc">Mengambil data...</p>
                </div>

                <!-- Digital Clock -->
                <div class="bg-darkcard border border-gray-700 p-6 rounded-xl shadow-xl">
                    <h2 class="text-xl font-bold mb-2">⏳ Jam Server (Realtime)</h2>

                    <div class="digital-clock mt-3">
                        <div id="h" class="time-box">00</div>
                        <div id="m" class="time-box">00</div>
                        <div id="s" class="time-box">00</div>
                    </div>

                    <p id="serverDate" class="text-gray-300 mt-3"></p>
                </div>

            </div>

            <!-- CHART -->
            <div class="bg-darkcard p-6 border border-gray-700 rounded-xl shadow-xl backdrop-blur-xl bg-opacity-60">
                <h2 class="text-xl font-bold mb-4">📊 Grafis Task Dibuat (7 Hari)</h2>
                <canvas id="taskChart"></canvas>
            </div>

        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- WEATHER -->
    <script>
        function loadWeather() {
            $.ajax({
                url: "/api/weather",
                method: "GET",
                success: function(res) {
                    $("#weatherTemp").text(res.temperature + " °C");
                    $("#weatherDesc").text("Kecepatan angin: " + res.windspeed + " km/h");
                }
            });
        }
        loadWeather();
        setInterval(loadWeather, 30000);
    </script>

    <!-- DIGITAL CLOCK -->
    <script>
        function animateTimeBox(box, value) {
            box.classList.add("fade");
            setTimeout(() => {
                box.innerText = value;
                box.classList.remove("fade");
            }, 200);
        }

        function updateClock(t) {
            let parts = t.split(":");
            animateTimeBox(document.getElementById("h"), parts[0]);
            animateTimeBox(document.getElementById("m"), parts[1]);
            animateTimeBox(document.getElementById("s"), parts[2]);
        }

        function loadTime() {
            $.ajax({
                url: "/api/server-time",
                method: "GET",
                success: function(res) {
                    updateClock(res.time);
                    $("#serverDate").text(res.date);
                }
            });
        }

        loadTime();
        setInterval(loadTime, 1000);
    </script>

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
                    borderColor: '#00e1ff',
                    backgroundColor: 'rgba(0,225,255,0.2)',
                    tension: 0.3
                }]
            }
        });
    </script>

</x-app-layout>
