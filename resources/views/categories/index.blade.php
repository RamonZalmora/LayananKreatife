<x-app-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex justify-between mb-8">
                <h1 class="text-3xl font-bold text-white">Categories</h1> 
                {{-- Judul warna putih & lebih besar --}}

                <a href="{{ route('categories.create') }}"
                   class="bg-green-600 text-white px-5 py-3 rounded-lg hover:bg-green-700 text-lg">
                    + Add Category
                </a>
            </div>

            {{-- Table Container --}}
            <div class="bg-white shadow-xl rounded-xl p-8">
                <table class="w-full border-collapse text-left text-lg">
                    <thead>
                        <tr class="border-b">
                            <th class="py-4 px-4 font-semibold">Name</th>
                            <th class="px-4 font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $c)
                            <tr class="border-b hover:bg-gray-100">

                                {{-- Nama kategori warna putih + background gelap --}}
                                <td class="py-4 px-4 text-white bg-gray-800 rounded">
                                    {{ $c->name }}
                                </td>

                                <td class="py-4 px-4 flex gap-5 items-center">

                                    {{-- Edit --}}
                                    <a href="{{ route('categories.edit', $c->id) }}"
                                       class="text-blue-600 hover:underline text-lg">
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('categories.destroy', $c->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this category?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:underline text-lg">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center py-6 text-gray-500 text-lg">
                                    No categories found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>
