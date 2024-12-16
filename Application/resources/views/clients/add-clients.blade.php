<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
             <h3 class="mb-8 ml-12 text-xl font-bold text-gray-900 dark:text-white">Add Client</h3>


            <form method="POST">
                @csrf
                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <!-- Card header -->
                    <div class="items-center lg:flex ">
                        <div class="items-center justify-between lg:flex bg-white rounded-lg shadow-sm sm:p-6 dark:bg-gray-800">
                            <ul class="flex flex-row justify-start space-x-4 text-sm font-medium text-gray-500 dark:text-gray-400 mb-2 w-full">
                                <li>
                                    <a href="#" 
                                        onclick="showInput('detailsGeneral')" 
                                        class="inline-flex items-center px-4 py-3 border border-black-900 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white text-center">
                                            Detalii generale
                                    </a>
                                 </li>
                                <li>
                                    <a href="#" 
                                        onclick="showInput('contactPersons')" 
                                        class="inline-flex items-center px-4 py-3 border border-black-900 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white text-center">
                                            Persoane de contact
                                    </a>
                                </li>
                            </ul>
                        </div> 
                    </div>
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
                                        <label for="cui" class="block text-sm font-medium text-gray-700 dark:text-gray-200">CUI</label>
                                        <input type="text" name="cui" id="cui"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>
                                    <div class="mt-4">
                                    <label for="client_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Client Type</label>
                                    <select name="client_type" id="client_type"
                                        class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        <option value="individual">Individual</option>
                                        <option value="company">Company</option>
                                    </select>
                                </div>

                                    <!-- Address -->
                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Address</label>
                                        <input type="text" name="address" id="address"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>
                                </div>

                                <!-- Smaller inputs in a horizontal row -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <!-- Country -->
                                    <div>
                                        <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Country</label>
                                        <input type="text" name="country" id="country"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>

                                    <!-- County -->
                                    <div>
                                        <label for="county" class="block text-sm font-medium text-gray-700 dark:text-gray-200">County</label>
                                        <input type="text" name="county" id="county"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>

                                    <!-- City -->
                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-200">City</label>
                                        <input type="text" name="city" id="city"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>
                                </div>

                            
                            </div>


                            <!-- Persoane de Contact Input -->
                            <div id="contactPersons" class="hidden">
                                <div class="flex flex-col items-center space-y-4">
                                    <div>
                                        <label for="contactFirstName" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-center">First Name</label>
                                        <input type="text" name="contactFirstName" id="contactFirstName"
                                            class="mt-2 w-64 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>
                                    <div>
                                        <label for="contactLastName" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Last Name</label>
                                        <input type="text" name="contactLastName" id="contactLastName"
                                            class="mt-2 w-64 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>
                                    <div>
                                        <label for="contactEmail" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Email</label>
                                        <input type="email" name="contactEmail" id="contactEmail"
                                            class="mt-2 w-64 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>
                                    <div>
                                        <label for="contactPosition" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Position</label>
                                        <input type="text" name="contactPosition" id="contactPosition"
                                            class="mt-2 w-64 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="flex justify-center">
                            <button type="submit" class="py-1 px-3 border-4 border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Add Client
                            </button>
                        </div>
                    </div>
                </div> 
            </form>
         </div>
    </div>
<script>
    let interacted = false; 

    function showInput(inputId) {
        const inputs = document.querySelectorAll('#detailsGeneral, #contactPersons');
        inputs.forEach(input => {
            input.classList.add('hidden'); 
        });

        const selectedInput = document.getElementById(inputId);
        if (selectedInput) {
            selectedInput.classList.remove('hidden'); 
        }

        
    }
</script>
</x-app-layout>
