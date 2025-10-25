<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Edit Task</h1>

        <a href="{{ route('tasks.index') }}"
           class="inline-block px-4 py-2 mb-6 text-white bg-gray-600 hover:bg-gray-700 rounded-lg shadow">
            Back to Tasks
        </a>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-200 dark:bg-red-700 text-red-800 dark:text-red-100 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow max-w-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700 dark:text-gray-200 mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600"
                       required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 dark:text-gray-200 mb-2">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 dark:text-gray-200 mb-2">Category</label>
                <select name="category_id" id="category_id"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600"
                        required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="due_date" class="block text-gray-700 dark:text-gray-200 mb-2">Due Date</label>
                <input type="date" name="due_date" id="due_date"
                       value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
            </div>

            <div class="mb-4 flex items-center space-x-2">
                <input type="checkbox" name="completed_at" id="completed_at" value="{{ now() }}" {{ $task->completed_at ? 'checked' : '' }}>
                <label for="completed_at" class="text-gray-700 dark:text-gray-200">Completed</label>
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                    Update
                </button>
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
