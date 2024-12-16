<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
             <h3 class="mb-8 ml-12 text-xl font-bold text-gray-900 dark:text-white">Add Service</h3>


            <form method="POST">
                @csrf
                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <!-- Component Integration -->
                    <div class="md:flex md:items-center mt-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        
                        <!-- Input fields -->
                        <div class="w-full">
                            <!-- Detalii Generale Input -->
                            <div id="detailsGeneral" class="w-full p-4 bg-white dark:bg-gray-800 rounded-md shadow-md">
  
                                <div class="space-y-4 mb-4">
                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>

                                    <!-- CUI -->
                                    <div>
                                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                                        <input type="text" name="price" id="price"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>
                                  

                                    <!-- Address -->
                                    <div>
                                        <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Currency</label>
                                        <input type="text" name="currency" id="currency"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>
                                    <div>
                                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                                        <input type="text" name="description" id="description"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6" id="addClientButton">
                        <div class="flex justify-center">
                            <button type="submit" class="py-1 px-3 border-4 border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Add Service
                            </button>
                        </div>
                    </div>
                </div> 
            </form>
         </div>
    </div>

</x-app-layout>
