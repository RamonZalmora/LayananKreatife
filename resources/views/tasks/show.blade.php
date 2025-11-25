<x-app-layout :title="'Detail Task'" :subtitle="'Lihat detail task secara lengkap'">
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow p-6 rounded-lg">

                <h1 class="text-3xl font-bold mb-4">{{ $task->title }}</h1>

                <p class="mb-2"><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
                <p class="mb-2"><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>
                <p class="mb-2"><strong>Deadline:</strong> {{ $task->deadline }}</p>
                <p class="mb-4"><strong>Description:</strong> <br> {{ $task->description }}</p>

                @if ($task->attachment)
                    <p><strong>Attachment:</strong></p>
                    <a class="text-blue-600 underline"
                       href="{{ asset('storage/'.$task->attachment) }}" target="_blank">
                        View File
                    </a>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
