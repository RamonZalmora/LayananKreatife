<x-guest-layout>

<style>
    body {
        background: radial-gradient(circle at top, #151521, #0d0d12 60%);
        color: white;
        font-family: "Inter", sans-serif;
    }

    /* Main Page */
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

    /* Input Style */
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

    /* Button */
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

    .already-btn {
        border: 1px solid #7dd3fc;
        padding: 10px 18px;
        border-radius: 12px;
        transition: 0.2s;
    }

    .already-btn:hover {
        background: #7dd3fc;
        color: black;
    }

    /* Responsive */
    @media(max-width: 992px) {
        .grid-custom {
            grid-template-columns: 1fr;
            text-align: center;
        }
    }
</style>


<div class="page-wrapper">

    <div class="grid-custom grid grid-cols-2 max-w-5xl gap-10">

        {{-- LEFT PANEL --}}
        <div class="info-panel">

            <div class="info-title">
                Buat Akun <span class="text-blue-300">SmartTask™</span>
            </div>

            <p class="subtext">
                Daftar sekarang dan nikmati pengalaman mengelola tugas,
                inventaris, dan keuangan dengan teknologi futuristik.
            </p>

            <div class="quote-box">
                “Kesuksesan dimulai dari langkah kecil yang konsisten.
                Manajemen yang baik membawa hasil luar biasa.”
            </div>

            <p class="mt-6 text-gray-300">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-300 hover:underline">
                    Masuk sekarang →
                </a>
            </p>

        </div>

        {{-- RIGHT REGISTER FORM --}}
        <div class="flex justify-center items-center">
            <div class="glass-card w-full max-w-sm">

                <div class="flex justify-center mb-6">
                    <img src="/logo.png" class="w-16 opacity-90" alt="Logo">
                </div>

                <h2 class="text-center text-2xl font-bold mb-6">Daftar Akun Baru</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-4">
                        <x-input-label for="name" class="text-gray-200" :value="__('Name')" />
                        <x-text-input id="name" type="text"
                            name="name" class="input-glass w-full mt-1"
                            required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-300" />
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <x-input-label for="email" class="text-gray-200" :value="__('Email')" />
                        <x-text-input id="email" type="email"
                            name="email" class="input-glass w-full mt-1"
                            required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <x-input-label for="password" class="text-gray-200" :value="__('Password')" />
                        <x-text-input id="password" type="password"
                            name="password" class="input-glass w-full mt-1"
                            required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-4">
                        <x-input-label for="password_confirmation" class="text-gray-200" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" type="password"
                            name="password_confirmation" class="input-glass w-full mt-1"
                            required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-300" />
                    </div>

                    {{-- Register Button --}}
                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('login') }}" class="already-btn text-gray-200">
                            Sudah punya akun?
                        </a>
                        <button class="btn-cyber">Daftar</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

</x-guest-layout>
