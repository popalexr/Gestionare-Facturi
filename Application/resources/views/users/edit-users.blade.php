<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
             <h3 class="mb-8 ml-12 text-xl font-bold text-gray-900 dark:text-white">Add User</h3>


            <form method="POST">
                @csrf
                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <!-- Card header -->
                    <div class="items-center lg:flex ">
                        <div class="items-center justify-between lg:flex bg-white rounded-lg shadow-sm sm:p-6 dark:bg-gray-800">
                            <ul class="flex flex-row justify-start space-x-4 text-sm font-medium text-gray-500 dark:text-gray-400 mb-2 w-full">
                                <li>
                                    <a href="#" 
                                        data-for="general"
                                        class="inline-flex items-center px-4 py-3 border border-black-900 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white text-center users-form-tab">
                                            General Details
                                    </a>
                                 </li>
                                <li>
                                    <a href="#" 
                                        data-for="permissions"
                                        class="inline-flex items-center px-4 py-3 border border-black-900 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white text-center users-form-tab">
                                            Permissions
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
                            <div id="general" class="w-full p-4">
  
                                <div class="space-y-4 mb-4">
                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        
                                        @error('name')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                                        <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        
                                        @error('email')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- Phone -->
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Phone</label>
                                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                            class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                        
                                        @error('phone')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Persoane de Contact Input -->
                            <div id="permissions" class="hidden">
                                <div class="space-y-4 mb-4">
                                    <div class="flex mb-4 py-4">
                                        <input id="permissions-admin" @if(old('admin', $user->isAdmin() ? 'on' : '') == 'on') checked @endif name="admin" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="permissions-admin" class="ms-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Set as Admin</label>
                                    </div>

                                    @foreach($permissions as $category => $permissions_list)
                                        <div>
                                            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">{{ $category }}</h3>

                                            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                @foreach($permissions_list as $permission => $description)
                                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                        <div class="flex items-center p-3">
                                                            <input 
                                                                id="{{ $permission }}"
                                                                name="permission[{{ $permission }}]"
                                                                @if(old('permission.' . $permission, $user->hasPermission($permission) ? 'on' : '') == 'on') checked @endif
                                                                type="checkbox"
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 permissions-checkbox"
                                                            >
                                                            <label for="{{ $permission }}" class="ms-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">{{ $description }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="flex justify-center">
                            <button type="submit" class="py-1 px-3 border-4 border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Edit User
                            </button>
                        </div>
                    </div>
                </div> 
            </form>
         </div>
    </div>

</x-app-layout>
