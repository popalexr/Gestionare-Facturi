<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <!-- Card header -->
                <div class="items-center justify-between lg:flex">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Add Client</h3>
                        <span class="text-base font-normal text-gray-500 dark:text-gray-400">Add a new client</span>
                    </div>
                </div>

                <!-- Component Integration -->
                <div class="md:flex mt-4">
                    <!-- Sidebar for navigation -->
                    <ul class="flex-column space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
                        <li>
                            <a href="#" 
                               onclick="showInput('nameInput')" 
                               class="inline-flex items-center px-4 py-3 text-white bg-blue-700 rounded-lg active w-full dark:bg-blue-600" 
                               aria-current="page">
                                Name
                            </a>
                        </li>
                        <li>
                            <a href="#" 
                               onclick="showInput('clientTypeInput')" 
                               class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                                Client Type
                            </a>
                        </li>
                        <li>
                            <a href="#" 
                               onclick="showInput('cuiInput')" 
                               class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                                CUI
                            </a>
                        </li>
                        <li>
                            <a href="#" 
                               onclick="showInput('addressInput')" 
                               class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                                Address
                            </a>
                        </li>
                    </ul>

                    <!-- Input fields -->
                    <div class="w-full">
                        <!-- Name Input -->
                        <div id="nameInput" class="hidden">
                            <div class="flex flex-col items-center">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Name</label>
                                <input type="text" name="name" id="name" 
                                       class="mt-2 w-64 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                            </div>
                        </div>

                        <!-- Client Type Input -->
                        <div id="clientTypeInput" class="hidden">
                            <div class="flex flex-col items-center">
                                <label for="clientType" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Client Type</label>
                                <input type="text" name="clientType" id="clientType" 
                                       class="mt-2 w-64 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                            </div>
                        </div>

                        <!-- CUI Input -->
                        <div id="cuiInput" class="hidden">
                            <div class="flex flex-col items-center">
                                <label for="cui" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-center">CUI</label>
                                <input type="text" name="cui" id="cui" 
                                       class="mt-2 w-64 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                            </div>
                        </div>

                        <!-- Address Input -->
                        <div id="addressInput" class="hidden">
                            <div class="flex flex-col items-center">
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Address</label>
                                <input type="text" name="address" id="address" 
                                       class="mt-2 w-64 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function showInput(inputId) {
            // Hide all inputs
            const inputs = document.querySelectorAll('#nameInput, #clientTypeInput, #cuiInput, #addressInput');
            inputs.forEach(input => {
                input.classList.add('hidden'); // Add the hidden class to hide elements
            });

            // Show the selected input
            const selectedInput = document.getElementById(inputId);
            if (selectedInput) {
                selectedInput.classList.remove('hidden'); // Remove the hidden class to show element
            }
        }
    </script>
</x-app-layout>
