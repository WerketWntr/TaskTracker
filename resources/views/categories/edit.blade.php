<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Edit Category</h1>

        <a href="{{ route('categories.index') }}"
           class="inline-block px-4 py-2 mb-6 text-white bg-gray-600 hover:bg-gray-700 rounded-lg shadow">
            Back to Categories
        </a>

        {{--        ERRORS--}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-200 dark:bg-red-700 text-red-800 dark:text-red-100 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{--EDIT FORM--}}
        <form action="{{ route('categories.update', $category) }}" method="POST"
              class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow max-w-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-200 mb-2">Category Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $category->name) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600"
                       required>
            </div>

            <div class="flex space-x-2">
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                    Update
                </button>
                <a href="{{ route('categories.index') }}"
                   class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
