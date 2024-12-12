<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <h1 class="text-3xl font-extrabold text-center text-gray-500 mb-8 mt-12">
            Add Service
        </h1>

        <!-- Add Service Form -->
        <form class="max-w-lg mx-auto mt-12">
            @csrf

            <!-- Service Name Input -->
            <div class="flex flex-col items-center ">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Service Name</label>
                <input type="text" name="name" id="name" 
                       class="mt-2 w-64 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
            </div>

            <!-- Service Price Input -->
            <div class="flex flex-col items-center mt-6">
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Price</label>
                <input type="text" name="price" id="price" 
                       class="mt-2 w-64 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
            </div>

            <!-- Add Service Button -->
            <div class="mt-6">
                <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add Service
                </button>
            </div>
        </form>
    </div>
</x-app-layout>