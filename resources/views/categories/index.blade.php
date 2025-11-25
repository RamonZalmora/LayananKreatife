<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between mb-6">
                <h1 class="text-2xl font-bold">Categories</h1>

                <a href="{{ route('categories.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Add Category
                </a>
            </div>

            <div class="bg-white shadow rounded p-6">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3">Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $c)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $c->name }}</td>

                                <td class="py-3 flex gap-3">

                                    {{-- Edit --}}
                                    <a href="{{ route('categories.edit', $c->id) }}"
                                       class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('categories.destroy', $c->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this category?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center py-4 text-gray-500">
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
