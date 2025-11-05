<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">My Tasks</h1>

        {{-- 🔍 Панель фильтров --}}
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow flex flex-wrap gap-4 items-end">

            {{-- Категория --}}
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                <select name="category_id" id="category_id" class="mt-1 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100">
                    <option value="">All</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Статус --}}
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select name="status" id="status" class="mt-1 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100">
                    <option value="">All</option>
                    <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            {{-- Диапазон дат --}}
            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300">From</label>
                <input type="date" name="date_from" id="date_from"
                       value="{{ $dateFrom }}"
                       class="mt-1 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100">
            </div>

            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300">To</label>
                <input type="date" name="date_to" id="date_to"
                       value="{{ $dateTo }}"
                       class="mt-1 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100">
            </div>

            {{-- Кнопки --}}
            <div class="flex gap-2 mt-4 sm:mt-0">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Filter</button>
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">Reset</a>
            </div>
        </form>

        {{-- Таблица задач --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <table class="min-w-full text-left">
                <thead class="border-b border-gray-300 dark:border-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Due Date</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($tasks as $task)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->title }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->category->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->due_date?->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">
                            @if ($task->completed_at)
                                <span class="text-green-600 font-semibold">Completed</span>
                            @else
                                <span class="text-yellow-600 font-semibold">Pending</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                            No tasks found for selected filters.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
