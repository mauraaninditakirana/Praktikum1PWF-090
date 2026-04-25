<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    {{-- Tulisan Role --}}
                    <div>
                        <span class="text-gray-500 dark:text-gray-400">Role:</span>
                        <span class="ml-1 font-bold text-gray-800 dark:text-gray-100 uppercase tracking-tight">
                            {{ auth()->user()->role }}
                        </span>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
