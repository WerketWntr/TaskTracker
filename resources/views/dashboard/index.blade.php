<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Dashboard</h1>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-500 text-white rounded-2xl shadow p-6 text-center">
                <h2 class="text-xl font-semibold">Total Tasks</h2>
                <p class="text-3xl font-bold mt-2">{{ $totalTasks }}</p>
            </div>
            <div class="bg-green-500 text-white rounded-2xl shadow p-6 text-center">
                <h2 class="text-xl font-semibold">Completed</h2>
                <p class="text-3xl font-bold mt-2">{{ $completedTasks }}</p>
            </div>
            <div class="bg-yellow-500 text-white rounded-2xl shadow p-6 text-center">
                <h2 class="text-xl font-semibold">Pending</h2>
                <p class="text-3xl font-bold mt-2">{{ $pendingTasks }}</p>
            </div>
            <div class="bg-indigo-500 text-white rounded-2xl shadow p-6 text-center">
                <h2 class="text-xl font-semibold">Completed Today</h2>
                <p class="text-3xl font-bold mt-2">{{ $completedToday }}</p>
            </div>
            <div class="bg-red-500 text-white rounded-2xl shadow p-6 text-center">
                <h2 class="text-xl font-semibold">Overdue</h2>
                <p class="text-3xl font-bold mt-2">{{ $overdueTasks }}</p>
            </div>
        </div>

        {{-- Upcoming Tasks --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Upcoming Tasks</h2>

            @if ($upcomingTasks->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No upcoming tasks for today or tomorrow 🎉</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse">
                        <thead>
                        <tr class="border-b border-gray-300 dark:border-gray-700">
                            <th class="px-4 py-2 text-gray-700 dark:text-gray-300">Title</th>
                            <th class="px-4 py-2 text-gray-700 dark:text-gray-300">Category</th>
                            <th class="px-4 py-2 text-gray-700 dark:text-gray-300">Due Date</th>
                            <th class="px-4 py-2 text-gray-700 dark:text-gray-300">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($upcomingTasks as $task)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->title }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->category->name ?? '-' }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                </td>
                                <td class="px-4 py-2">
                                    @if ($task->completed_at)
                                        <span class="text-green-600 font-semibold">Completed</span>
                                    @else
                                        <span class="text-yellow-600 font-semibold">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
