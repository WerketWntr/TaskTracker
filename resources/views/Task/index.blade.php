<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">My Tasks</h1>

        <a href="{{ route('tasks.create') }}"
           class="inline-block px-4 py-2 mb-6 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow">
            Create Task
        </a>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-200 dark:bg-green-700 text-green-800 dark:text-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($tasks->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Title</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Category</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Due Date</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Status</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->title }}</td>
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->category->name }}</td>
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->due_date?->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('tasks.update', $task) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="title" value="{{ $task->title }}">
                                    <input type="hidden" name="description" value="{{ $task->description }}">
                                    <input type="hidden" name="category_id" value="{{ $task->category_id }}">
                                    <input type="hidden" name="due_date" value="{{ $task->due_date }}">
                                    <input type="checkbox" name="completed_at" value="{{ now() }}"
                                           onchange="this.form.submit()" {{ $task->completed_at ? 'checked' : '' }}>
                                </form>
                            </td>
                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('tasks.edit', $task) }}"
                                   class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded shadow text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this task?')"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded shadow text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-700 dark:text-gray-300 mt-4">No tasks found.</p>
        @endif
    </div>
</x-app-layout>
