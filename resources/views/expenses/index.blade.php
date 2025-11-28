<x-app-layout :title="'Expense Tracker'" :subtitle="'Kelola pemasukan & pengeluaran kamu'">

    {{-- SUMMARY CARDS --}}
    <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-5">

        <!-- Total Pemasukan -->
        <div class="p-6 bg-green-700 text-white rounded-2xl shadow-lg">
            <h3 class="text-lg font-semibold opacity-90">Total Pemasukan</h3>
            <p class="text-4xl font-bold mt-2">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
        </div>

        <!-- Total Pengeluaran -->
        <div class="p-6 bg-red-700 text-white rounded-2xl shadow-lg">
            <h3 class="text-lg font-semibold opacity-90">Total Pengeluaran</h3>
            <p class="text-4xl font-bold mt-2">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
        </div>

        <!-- Sisa Saldo -->
        <div class="p-6 bg-blue-700 text-white rounded-2xl shadow-lg">
            <h3 class="text-lg font-semibold opacity-90">Sisa Saldo</h3>
            <p class="text-4xl font-bold mt-2">
                Rp {{ number_format($totalIncome - $totalExpense, 0, ',', '.') }}
            </p>
        </div>

    </div>

    {{-- BUTTON TAMBAH --}}
    <button onclick="document.getElementById('addModal').classList.remove('hidden')"
        class="px-6 py-3 bg-primary text-white rounded-xl text-lg shadow hover:bg-primary/90 transition">
        + Tambah Transaksi
    </button>

    {{-- LIST TRANSAKSI --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach($expenses as $e)
        <div class="bg-gray-900 border border-gray-700 p-5 rounded-2xl shadow-lg hover:shadow-xl transition">

            {{-- HEADER --}}
            <div class="flex justify-between items-start">
                <span class="font-bold text-xl text-white">{{ $e->title }}</span>
                <span class="text-sm text-gray-400">{{ $e->date }}</span>
            </div>

            {{-- CATEGORY --}}
            <p class="mt-1 text-sm text-gray-400 italic">{{ $e->category }}</p>

            {{-- AMOUNT --}}
            <p class="mt-4 text-3xl font-bold 
                {{ $e->type == 'income' ? 'text-green-400' : 'text-red-400' }}">
                {{ $e->type == 'expense' ? '-' : '+' }}
                Rp {{ number_format($e->amount, 0, ',', '.') }}
            </p>

            {{-- RECEIPT --}}
            @if($e->receipt)
                <img src="{{ Storage::url($e->receipt) }}"
                     class="mt-4 w-full h-44 object-cover rounded-xl shadow">
            @endif

            {{-- NOTE --}}
            <p class="mt-4 text-gray-300 text-sm leading-relaxed">
                {{ $e->note }}
            </p>

            {{-- DELETE BUTTON --}}
            <form action="{{ route('expenses.destroy', $e->id) }}" method="POST" class="mt-5"
                  onsubmit="return confirm('Yakin mau hapus?')">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow">
                    🗑️ Hapus
                </button>
            </form>

        </div>
        @endforeach

    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $expenses->links() }}
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="addModal"
         class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white text-black p-8 rounded-2xl w-full max-w-xl shadow-2xl">
            <h2 class="text-2xl font-bold mb-5">Tambah Transaksi</h2>

            <form method="POST" action="{{ route('expenses.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <select name="type" class="border p-3 rounded-lg">
                        <option value="income">Pemasukan</option>
                        <option value="expense">Pengeluaran</option>
                    </select>

                    <input type="date" name="date" class="border p-3 rounded-lg" required>

                    <input type="text" name="title" class="border p-3 rounded-lg" placeholder="Judul" required>

                    <input type="number" name="amount" class="border p-3 rounded-lg" placeholder="Nominal" required>

                    <input type="text" name="category" class="border p-3 rounded-lg" placeholder="Kategori">

                    <input type="file" name="receipt" class="border p-3 rounded-lg">

                    <textarea name="note"
                              class="border p-3 rounded-lg md:col-span-2"
                              placeholder="Catatan" rows="3"></textarea>

                </div>

                <div class="mt-5 flex justify-end gap-3">

                    <button type="button"
                            onclick="document.getElementById('addModal').classList.add('hidden')"
                            class="px-5 py-2 border rounded-lg shadow">
                        Batal
                    </button>

                    <button class="px-5 py-2 bg-primary text-white rounded-lg shadow hover:bg-primary/90">
                        Simpan
                    </button>

                </div>
            </form>

        </div>
    </div>

</x-app-layout>
