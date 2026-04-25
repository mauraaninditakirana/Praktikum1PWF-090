<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1f2937] overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-700">
                
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Category List</h2>
                        <p class="text-gray-400 text-sm mt-1">Manage your category</p>
                    </div>
                    <a href="{{ route('category.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2 px-4 rounded-md transition duration-150">
                        + Add Category
                    </a>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-700">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-[#374151]">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider w-16">#</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">NAME</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">TOTAL PRODUCT</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#1f2937] divide-y divide-gray-700">
                            {{-- Looping Data Kategori --}}
                            @forelse ($categories as $index => $category)
                            <tr class="hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200 font-medium">
                                    {{ $category->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    {{-- Mengambil jumlah produk otomatis dari Controller --}}
                                    {{ $category->products_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('category.edit', $category->id) }}" class="text-gray-400 hover:text-indigo-400 transition" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="inline-block m-0 p-0" onsubmit="return confirm('Apakah kamu yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            {{-- Jika data kosong --}}
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400 text-sm">
                                    No categories found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>