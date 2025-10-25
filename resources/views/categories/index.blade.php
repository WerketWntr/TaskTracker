<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">My Categories</h1>

        <a href="{{ route('categories.create') }}"
           class="inline-block px-4 py-2 mb-6 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow">
            Create Category
        </a>

        @if(session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-200 dark:text-green-100 dark:bg-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{--CATEGORY LIST--}}
        @if($categories->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="text-left px-4 py-2 text-gray-700 dark:text-gray-200">Name</th>
                        <th class="text-left px-4 py-2 text-gray-700 dark:text-gray-200">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $category->name }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded shadow text-sm">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this category?')"
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
            <p class="text-gray-700 dark:text-gray-300 mt-4">No categories found.</p>
        @endif
    </div>
</x-app-layout>
