<x-app-layout :title="'Edit Task'" :subtitle="'Perbarui task Anda'">

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-2xl font-bold mb-6">Edit Task</h1>

            <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data"
                  class="bg-white shadow p-6 rounded-lg">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Title</label>
                    <input type="text" name="title" class="w-full border p-2 rounded"
                           value="{{ $task->title }}" required>
                </div>

                {{-- Category --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Category</label>
                    <select name="category_id" class="w-full border p-2 rounded">
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}" {{ $task->category_id == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Description</label>
                    <textarea name="description" class="w-full border p-2 rounded">{{ $task->description }}</textarea>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Status</label>
                    <select name="status" class="w-full border p-2 rounded">
                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                {{-- Priority --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Priority</label>
                    <select name="priority" class="w-full border p-2 rounded">
                        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                {{-- Deadline --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Deadline</label>
                    <input type="date" name="deadline" class="w-full border p-2 rounded"
                           value="{{ $task->deadline }}">
                </div>

                {{-- Attachment --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Attachment</label>
                    <input type="file" name="attachment" class="w-full border p-2 rounded">

                    @if($task->attachment)
                        <p class="text-sm mt-2">
                            Current File:
                            <a href="{{ asset('storage/'.$task->attachment) }}"
                               class="text-blue-600 underline" target="_blank">
                                View Attachment
                            </a>
                        </p>
                    @endif
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Task
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
