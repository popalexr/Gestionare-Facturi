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
                                        data-for="detailsGeneral"
                                        class="inline-flex items-center px-4 py-3 border border-black-900 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white text-center clients-form-tab">
                                            General Details
                                    </a>
                                 </li>
                                <li>
                                    <a href="#" 
                                        data-for="contactPersons"
                                        class="inline-flex items-center px-4 py-3 border border-black-900 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white text-center clients-form-tab">
                                            Contact Details
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
                            <div id="detailsGeneral" class="w-full p-4">
  
                                <div class="space-y-4 mb-4">
                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        
                                        @error('name')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- CUI -->
                                    <div>
                                        <label for="cui" class="block text-sm font-medium text-gray-700 dark:text-gray-200">CUI</label>
                                        <input type="text" name="cui" id="cui" value="{{ old('cui') }}"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        
                                        @error('cui')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror    
                                    </div>
                                    <div class="mt-4">
                                    <label for="client_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Client Type</label>
                                    <select name="client_type" id="client_type"
                                        class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        <option value="individual" @if(old('client_type') == 'individual') checked @endif>Individual</option>
                                        <option value="company" @if(old('client_type') == 'company') @endif>Company</option>
                                    </select>
                                    
                                    @error('client_type')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                    <!-- Address -->
                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Address</label>
                                        <input type="text" name="address" id="address" value="{{ old('address') }}"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        
                                        @error('address')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Smaller inputs in a horizontal row -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <!-- Country -->
                                    <div>
                                        <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Country</label>
                                        <input type="text" name="country" id="country" value="{{ old('country') }}"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        
                                        @error('country')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- County -->
                                    <div>
                                        <label for="county" class="block text-sm font-medium text-gray-700 dark:text-gray-200">County</label>
                                        <input type="text" name="county" id="county" value="{{ old('county') }}"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        
                                        @error('county')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- City -->
                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-200">City</label>
                                        <input type="text" name="city" id="city" value="{{ old('city') }}"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        
                                        @error('city')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Persoane de Contact Input -->
                            <div id="contactPersons" class="hidden">
                                <div id="show-client-contacts">
                                    <show-client-contacts-component></show-client-contacts-component>
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
         <div id="add-client-contacts">
             <add-client-contacts-component></add-client-contacts-component>
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
<script>
    let contacts = @json(old('contacts', []));
</script>
</x-app-layout>
