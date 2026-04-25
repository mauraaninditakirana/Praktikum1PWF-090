<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1f2937] overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-700">
                
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-white">Add Category</h2>
                    <p class="text-gray-400 text-sm mt-1">Fill in the details to add a new category</p>
                </div>

                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Category Name</label>
                        <input type="text" name="name" id="name" 
                            class="w-full bg-[#374151] border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 p-2.5" 
                            placeholder="e.g. Electronics" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 mt-6">
                        <a href="{{ route('category.index') }}" class="text-gray-400 hover:text-white transition text-sm">
                            Cancel
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-md transition duration-150">
                            Save Category
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>