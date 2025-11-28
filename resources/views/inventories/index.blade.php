<x-app-layout :title="'Inventory'">

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-white">Inventory / Barang Pribadi</h1>

                <button 
                    onclick="document.getElementById('addModal').classList.remove('hidden')"
                    class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 shadow-lg transition">
                    + Tambah Barang
                </button>
            </div>

            {{-- SUCCESS ALERT --}}
            @if(session('success'))
                <div class="p-4 bg-green-200 text-green-900 rounded-lg mb-6 shadow">
                    {{ session('success') }}
                </div>
            @endif

            {{-- GRID ITEMS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($inventories as $item)
                    <div class="bg-white rounded-xl shadow-lg p-5 hover:shadow-2xl hover:scale-[1.02] transition">

                        {{-- IMAGE --}}
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}"
                                 class="w-full h-48 object-cover rounded-lg mb-4 shadow">
                        @endif

                        {{-- NAME --}}
                        <h3 class="text-xl font-bold mb-1 text-gray-800">{{ $item->name }}</h3>

                        {{-- CATEGORY --}}
                        <span class="inline-block bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full mb-3">
                            {{ $item->category }}
                        </span>

                        {{-- DESCRIPTION --}}
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                            {{ $item->description }}
                        </p>

                        {{-- PRICE + CONDITION --}}
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xl font-bold text-green-700">
                                Rp {{ number_format($item->price,0,',','.') }}
                            </span>

                            <span class="px-3 py-1 text-sm rounded-full 
                                @if($item->condition == 'new') bg-green-200 text-green-800 
                                @elseif($item->condition == 'good') bg-blue-200 text-blue-800
                                @elseif($item->condition == 'used') bg-yellow-200 text-yellow-800
                                @else bg-red-200 text-red-800 @endif
                            ">
                                {{ ucfirst($item->condition) }}
                            </span>
                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="flex gap-3">

                            {{-- EDIT --}}
                            <button 
                                onclick="editInventory({{ $item->id }})"
                                class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-lg text-center transition shadow">
                                ✏️ Edit
                            </button>

                            {{-- DELETE --}}
                            <form class="flex-1"
                                action="{{ route('inventories.destroy', $item->id) }}" 
                                method="POST" 
                                onsubmit="return confirm('Yakin ingin menghapus barang ini?')">

                                @csrf
                                @method('DELETE')

                                <button class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition shadow">
                                    🗑️ Hapus
                                </button>
                            </form>

                        </div>

                    </div>
                @endforeach

            </div>

            {{-- PAGINATION --}}
            <div class="mt-6">
                {{ $inventories->links() }}
            </div>

        </div>
    </div>

    {{-- MODAL TAMBAH BARANG --}}
    <div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-8 rounded-xl w-full max-w-xl shadow-2xl animate-fade-in">

            <h2 class="text-2xl font-bold mb-5 text-gray-800">Tambah Barang</h2>

            <form action="{{ route('inventories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <input type="text" name="name" placeholder="Nama Barang" class="border p-3 rounded-lg" required>
                    <input type="text" name="sku" placeholder="SKU" class="border p-3 rounded-lg">
                    <input type="text" name="category" placeholder="Kategori" class="border p-3 rounded-lg">
                    <input type="number" name="price" placeholder="Harga" class="border p-3 rounded-lg">

                    <input type="number" value="1" name="quantity" placeholder="Jumlah" class="border p-3 rounded-lg">

                    <select name="condition" class="border p-3 rounded-lg">
                        <option value="new">Baru</option>
                        <option value="good">Bagus</option>
                        <option value="used">Bekas</option>
                        <option value="broken">Rusak</option>
                    </select>

                    <textarea name="description" rows="3" class="border p-3 rounded-lg md:col-span-2" placeholder="Deskripsi"></textarea>

                    <input type="file" name="image" class="border p-3 rounded-lg md:col-span-2">
                </div>

                <div class="mt-5 flex justify-end gap-3">
                    <button 
                        type="button"
                        onclick="document.getElementById('addModal').classList.add('hidden')"
                        class="px-5 py-2 rounded border shadow">
                        Batal
                    </button>

                    <button class="px-5 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-8 rounded-xl w-full max-w-xl shadow-2xl animate-fade-in">

            <h2 class="text-2xl font-bold mb-5 text-gray-800">Edit Barang</h2>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <input type="text" id="editName" name="name" class="border p-3 rounded-lg">
                    <input type="text" id="editSku" name="sku" class="border p-3 rounded-lg">

                    <input type="text" id="editCategory" name="category" class="border p-3 rounded-lg">
                    <input type="number" id="editPrice" name="price" class="border p-3 rounded-lg">

                    <input type="number" id="editQuantity" name="quantity" class="border p-3 rounded-lg">

                    <select id="editCondition" name="condition" class="border p-3 rounded-lg">
                        <option value="new">Baru</option>
                        <option value="good">Bagus</option>
                        <option value="used">Bekas</option>
                        <option value="broken">Rusak</option>
                    </select>

                    <textarea id="editDescription" name="description" rows="3" class="border p-3 rounded-lg md:col-span-2"></textarea>

                    <input type="file" name="image" class="border p-3 rounded-lg md:col-span-2">
                </div>

                <div class="mt-5 flex justify-end gap-3">
                    <button 
                        type="button"
                        onclick="document.getElementById('editModal').classList.add('hidden')"
                        class="px-5 py-2 rounded border shadow">
                        Batal
                    </button>

                    <button class="px-5 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function editInventory(id) {
            fetch(`/inventories/${id}`)
                .then(res => res.json())
                .then(data => {
                    editName.value = data.name;
                    editSku.value = data.sku;
                    editCategory.value = data.category;
                    editPrice.value = data.price;
                    editQuantity.value = data.quantity;
                    editCondition.value = data.condition;
                    editDescription.value = data.description;

                    document.getElementById('editForm').action = `/inventories/${id}`;
                    document.getElementById('editModal').classList.remove('hidden');
                });
        }
    </script>

</x-app-layout>
