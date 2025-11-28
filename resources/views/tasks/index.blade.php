<x-app-layout :title="'Tasks'" :subtitle="'Daftar semua task Anda'">
    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex justify-between mb-8 items-center">
                <h1 class="text-3xl font-bold text-white">My Tasks</h1>

                <a href="{{ route('tasks.create') }}"
                   class="bg-blue-600 text-white px-5 py-3 rounded-xl hover:bg-blue-700 shadow-md transition text-lg">
                    + Add Task
                </a>
            </div>

            {{-- Alert --}}
            @if (session('success'))
                <div class="bg-green-200 text-green-900 p-4 rounded mb-6 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Table --}}
            <div class="bg-white shadow-xl rounded-xl p-8">

                <table class="w-full text-left border-collapse text-lg">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="py-4 px-4 font-semibold">Title</th>
                            <th class="px-4 font-semibold">Status</th>
                            <th class="px-4 font-semibold">Priority</th>
                            <th class="px-4 font-semibold">Deadline</th>
                            <th class="px-4 font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($tasks as $task)
                            <tr class="border-b hover:bg-gray-100 transition">

                                <td class="py-4 px-4 font-medium text-gray-800">
                                    {{ $task->title }}
                                </td>

                                {{-- Status --}}
                                <td class="px-4 capitalize">
                                    <span class="
                                        @if($task->status == 'completed') text-green-600 font-semibold
                                        @elseif($task->status == 'pending') text-yellow-600 font-semibold
                                        @else text-gray-700 font-semibold
                                        @endif
                                    ">
                                        {{ $task->status }}
                                    </span>
                                </td>

                                {{-- Priority --}}
                                <td class="px-4 capitalize">
                                    <span class="
                                        @if($task->priority == 'high') text-red-600 font-bold
                                        @elseif($task->priority == 'medium') text-yellow-600 font-bold
                                        @else text-green-600 font-bold
                                        @endif
                                    ">
                                        {{ $task->priority }}
                                    </span>
                                </td>

                                {{-- Deadline --}}
                                <td class="px-4">
                                    {{ $task->deadline ?? '-' }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-4 py-4 flex gap-5">

                                    {{-- Edit --}}
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                       class="text-blue-600 hover:text-blue-800 font-semibold transition">
                                       ✏️ Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('tasks.destroy', $task->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this task?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 font-semibold transition">
                                            🗑️ Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-500 text-lg">
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
