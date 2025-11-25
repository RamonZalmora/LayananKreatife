<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-2xl font-bold mb-6">Add Category</h1>

            <form action="{{ route('categories.store') }}" method="POST"
                  class="bg-white shadow p-6 rounded-lg">

                @csrf

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Category Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" required>
                </div>

                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Save
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
