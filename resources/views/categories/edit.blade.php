<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

            <form action="{{ route('categories.update', $category->id) }}" method="POST"
                  class="bg-white shadow p-6 rounded-lg">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Category Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded"
                           value="{{ $category->name }}" required>
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
