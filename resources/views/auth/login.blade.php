<x-guest-layout>

<style>
    body {
        background: radial-gradient(circle at top, #151521, #0d0d12 60%);
        color: white;
        font-family: "Inter", sans-serif;
    }

    /* Main Container */
    .page-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    /* Glass Card */
    .glass-card {
        backdrop-filter: blur(16px);
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 18px;
        padding: 35px;
        box-shadow: 0 0 25px rgba(0,0,0,0.4);
    }

    /* Info Panel */
    .info-panel {
        padding: 30px;
        color: #eaeaea;
    }

    .info-title {
        font-size: 2.4rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .subtext {
        font-size: 1.1rem;
        color: #bfc3d4;
    }

    .quote-box {
        margin-top: 30px;
        padding: 20px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 14px;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    .weather-box {
        margin-top: 20px;
        padding: 20px;
        background: rgba(20,20,30,0.6);
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,0.15);
    }

    /* Input Styles */
    .input-glass {
        background: rgba(255,255,255,0.07) !important;
        border: 1px solid rgba(255,255,255,0.18) !important;
        color: #fff !important;
        border-radius: 12px;
        height: 45px;
    }

    .input-glass:focus {
        border-color: #7dd3fc !important;
        box-shadow: 0 0 10px #38bdf8;
    }

    .btn-cyber {
        background: linear-gradient(135deg, #38bdf8, #6366f1);
        padding: 12px 28px;
        border-radius: 12px;
        color: black;
        font-weight: 600;
        transition: 0.2s;
        box-shadow: 0 0 18px rgba(56, 189, 248, 0.75);
    }

    .btn-cyber:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }

    .register-btn {
        border: 1px solid #7dd3fc;
        padding: 10px 20px;
        border-radius: 12px;
        display: inline-block;
        transition: 0.2s;
    }

    .register-btn:hover {
        background: #7dd3fc;
        color: black;
    }

    /* Responsive */
    @media(max-width: 992px) {
        .grid-custom {
            grid-template-columns: 1fr;
            text-align: center;
        }
        .info-panel {
            padding-bottom: 10px;
        }
    }
</style>


<div class="page-wrapper">

    <div class="grid-custom grid grid-cols-2 max-w-5xl gap-10">

        {{-- LEFT PANEL --}}
        <div class="info-panel">

            <div class="info-title">
                SmartTask <span class="text-blue-300">Futuristic™</span>
            </div>

            <p class="subtext">
                Aplikasi produktivitas generasi baru — monitor tugas, inventaris, dan keuanganmu secara modern.
            </p>

            <div class="quote-box">
                “Bekerja cerdas mengalahkan bekerja keras. Optimalkan waktu, tingkatkan hasil.”
            </div>

            <div class="weather-box mt-4">
                <h3 class="text-lg font-semibold mb-1">Cuaca Hari Ini</h3>
                <p id="weatherTemp" class="text-gray-300">Memuat...</p>
            </div>

            <p class="mt-6 text-gray-300">
                Tidak punya akun?
                <a href="{{ route('register') }}" class="text-blue-300 hover:underline">
                    Daftar gratis →
                </a>
            </p>

        </div>

        {{-- RIGHT LOGIN PANEL --}}
        <div class="flex justify-center items-center">
            <div class="glass-card w-full max-w-sm">

                <div class="flex justify-center mb-6">
                    <img src="/logo.png" class="w-16 opacity-90" alt="Logo">
                </div>

                <h2 class="text-center text-2xl font-bold mb-6">Masuk ke SmartTask</h2>

                <x-auth-session-status class="mb-4 text-white text-center" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                        <x-input-label for="email" class="text-gray-200" :value="__('Email')" />
                        <x-text-input id="email" type="email"
                            name="email" class="input-glass w-full mt-1"
                            required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <x-input-label for="password" class="text-gray-200" :value="__('Password')" />
                        <x-text-input id="password" type="password"
                            name="password" class="input-glass w-full mt-1"
                            required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                    </div>

                    {{-- Remember --}}
                    <label class="flex items-center text-gray-300 mt-1 mb-4">
                        <input type="checkbox"
                            class="rounded border-gray-600 bg-gray-700 text-blue-300">
                        <span class="ml-2">Remember me</span>
                    </label>

                    {{-- Buttons --}}
                    <div class="flex justify-between items-center">
                        <a class="underline text-gray-300 hover:text-gray-100 text-sm"
                            href="{{ route('password.request') }}">
                            Lupa password?
                        </a>

                        <button class="btn-cyber">Masuk</button>
                    </div>

                </form>

                <div class="text-center mt-6">
                    <a href="{{ route('register') }}" class="register-btn">
                        ✨ Buat Akun Baru
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>


{{-- WEATHER API --}}
<script>
    fetch("https://api.open-meteo.com/v1/forecast?latitude=0.52&longitude=101.44&current_weather=true")
        .then(res => res.json())
        .then(data => {
            document.getElementById("weatherTemp").innerHTML =
                `<span class='text-blue-300 font-bold text-xl'>
                    ${data.current_weather.temperature}°C
                </span> 
                • Angin ${data.current_weather.windspeed} km/h`;
        })
        .catch(() => {
            document.getElementById("weatherTemp").innerHTML = "Tidak dapat memuat cuaca.";
        });
</script>

</x-guest-layout>
