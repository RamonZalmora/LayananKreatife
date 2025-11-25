<x-app-layout :title="'Add Task'" :subtitle="'Tambah task baru'">

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-2xl font-bold mb-6">Add New Task</h1>

            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data"
                  class="bg-white shadow p-6 rounded-lg">
                @csrf

                {{-- Title --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Title</label>
                    <input type="text" name="title" class="w-full border p-2 rounded" required>
                </div>

                {{-- Category --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Category</label>
                    <select name="category_id" class="w-full border p-2 rounded" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Description</label>
                    <textarea name="description" class="w-full border p-2 rounded"></textarea>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Status</label>
                    <select name="status" class="w-full border p-2 rounded">
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                {{-- Priority --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Priority</label>
                    <select name="priority" class="w-full border p-2 rounded">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                {{-- Deadline --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Deadline</label>
                    <input type="date" name="deadline" class="w-full border p-2 rounded">
                </div>

                {{-- Attachment --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Attachment (optional)</label>
                    <input type="file" name="attachment" class="w-full border p-2 rounded">
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Task
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
