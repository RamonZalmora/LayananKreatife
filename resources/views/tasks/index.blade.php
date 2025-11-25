<x-app-layout :title="'Tasks'" :subtitle="'Daftar semua task Anda'">
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex justify-between mb-6">
                <h1 class="text-2xl font-bold">My Tasks</h1>

                <a href="{{ route('tasks.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Add Task
                </a>
            </div>

            {{-- Alert --}}
            @if (session('success'))
                <div class="bg-green-200 text-green-900 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Table --}}
            <div class="bg-white shadow rounded-lg p-6">

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b font-semibold">
                            <th class="py-3">Title</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Deadline</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($tasks as $task)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 font-medium">{{ $task->title }}</td>
                                <td>{{ ucfirst($task->status) }}</td>
                                <td>{{ ucfirst($task->priority) }}</td>
                                <td>{{ $task->deadline ?? '-' }}</td>

                                <td class="py-3 flex gap-3">

                                    {{-- EDIT --}}
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                       class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('tasks.destroy', $task->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this task?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">
                                    No tasks available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>
