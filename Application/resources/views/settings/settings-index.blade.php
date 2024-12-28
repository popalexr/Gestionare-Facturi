<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form method="POST">
            @csrf
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
                    <h3 class="mb-8 text-xl font-bold text-gray-900 dark:text-white">Provider details</h3>
                    <!-- Input fields -->
                    <div class="w-full">
                        <div class="space-y-6 mb-4">
                            <!-- Company name -->
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Company Name</label>
                                <input type="text" name="company_name" id="company_name" value="{{ old('company_name', settings()->get('company_name')) }}"
                                    class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                @error('company_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Company CUI -->
                            <div>
                                <label for="company_cui" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Company CUI</label>
                                <input type="text" name="company_cui" id="company_cui" value="{{ old('company_cui', settings()->get('company_cui')) }}"
                                    class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                @error('company_cui')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Company address -->
                            <div>
                                <label for="company_address" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Address</label>
                                <input type="text" name="company_address" id="company_address" value="{{ old('company_address', settings()->get('company_address')) }}"
                                    class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                @error('company_address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Country -->
                                <div>
                                    <label for="company_country" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Country</label>
                                    <input type="text" name="company_country" id="company_country" value="{{ old('company_country', settings()->get('company_country')) }}"
                                        class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    
                                    @error('company_country')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- County -->
                                <div>
                                    <label for="company_county" class="block text-sm font-medium text-gray-700 dark:text-gray-200">County</label>
                                    <input type="text" name="company_county" id="company_county" value="{{ old('company_county', settings()->get('company_county')) }}"
                                        class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    
                                    @error('company_county')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div>
                                    <label for="company_city" class="block text-sm font-medium text-gray-700 dark:text-gray-200">City</label>
                                    <input type="text" name="company_city" id="company_city" value="{{ old('company_city', settings()->get('company_city')) }}"
                                        class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    
                                    @error('company_city')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 w-full">
                <div class="flex justify-center">
                    <button type="submit" class="py-1 px-3 border-4 border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save settings
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
