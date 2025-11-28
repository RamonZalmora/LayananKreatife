<x-app-layout :title="'Inventory'">

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <h1 class="text-2xl font-bold mb-4">Inventory / Barang Pribadi</h1>

            @if(session('success'))
                <div class="p-3 bg-green-200 text-green-800 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tambah Barang -->
            <button 
                onclick="document.getElementById('addModal').classList.remove('hidden')"
                class="bg-blue-600 text-white px-4 py-2 rounded mb-4">
                Tambah Barang
            </button>

            <!-- Grid Items -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($inventories as $item)
                    <div class="bg-white p-4 rounded shadow">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" class="w-full h-40 object-cover rounded mb-3">
                        @endif

                        <h3 class="text-lg font-bold">{{ $item->name }}</h3>
                        <p class="text-gray-500 text-sm">{{ $item->category }}</p>
                        <p class="text-sm mt-2">{{ $item->description }}</p>

                        <div class="mt-3 flex justify-between items-center">
                            <span class="font-bold">Rp {{ number_format($item->price,0,',','.') }}</span>
                            <span class="px-2 py-1 bg-gray-100 rounded text-sm">{{ ucfirst($item->condition) }}</span>
                        </div>

                        <div class="mt-3 flex gap-2">
                            <!-- Edit -->
                            <button 
                                onclick="editInventory({{ $item->id }})"
                                class="bg-yellow-400 text-black px-3 py-1 rounded">
                                Edit
                            </button>

                            <!-- Delete -->
                            <form action="{{ route('inventories.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $inventories->links() }}
            </div>

        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded w-full max-w-xl">
            <h2 class="text-xl font-bold mb-3">Tambah Barang</h2>

            <form action="{{ route('inventories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <input type="text" name="name" class="border p-2 rounded" placeholder="Nama" required>
                    <input type="text" name="sku" class="border p-2 rounded" placeholder="SKU">

                    <input type="text" name="category" class="border p-2 rounded" placeholder="Kategori">
                    <input type="number" name="price" class="border p-2 rounded" placeholder="Harga">

                    <input type="number" name="quantity" class="border p-2 rounded" placeholder="Jumlah" value="1">

                    <select name="condition" class="border p-2 rounded">
                        <option value="new">Baru</option>
                        <option value="good">Bagus</option>
                        <option value="used">Bekas</option>
                        <option value="broken">Rusak</option>
                    </select>

                    <textarea name="description" class="border p-2 rounded md:col-span-2" rows="3" placeholder="Deskripsi"></textarea>

                    <input type="file" name="image" class="border p-2 rounded md:col-span-2">
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="px-4 py-2 border rounded">Batal</button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit (AJAX) -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded w-full max-w-xl">
            <h2 class="text-xl font-bold mb-3">Edit Barang</h2>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <input type="text" name="name" id="editName" class="border p-2 rounded">
                    <input type="text" name="sku" id="editSku" class="border p-2 rounded">

                    <input type="text" name="category" id="editCategory" class="border p-2 rounded">
                    <input type="number" name="price" id="editPrice" class="border p-2 rounded">

                    <input type="number" name="quantity" id="editQuantity" class="border p-2 rounded">

                    <select name="condition" id="editCondition" class="border p-2 rounded">
                        <option value="new">Baru</option>
                        <option value="good">Bagus</option>
                        <option value="used">Bekas</option>
                        <option value="broken">Rusak</option>
                    </select>

                    <textarea name="description" id="editDescription" class="border p-2 rounded md:col-span-2"></textarea>

                    <input type="file" name="image" class="border p-2 rounded md:col-span-2">
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 border rounded">Batal</button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editInventory(id) {
            fetch(`/inventories/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('editName').value = data.name;
                    document.getElementById('editSku').value = data.sku;
                    document.getElementById('editCategory').value = data.category;
                    document.getElementById('editPrice').value = data.price;
                    document.getElementById('editQuantity').value = data.quantity;
                    document.getElementById('editCondition').value = data.condition;
                    document.getElementById('editDescription').value = data.description;

                    document.getElementById('editForm').action = `/inventories/${id}`;
                    document.getElementById('editModal').classList.remove('hidden');
                });
        }
    </script>

</x-app-layout>
