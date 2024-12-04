<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-8">
            Client Details
        </h1>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('clients.index') }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">
                Back to Clients
            </a>
        </div>
    </div>
</x-app-layout>