<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        

        <!-- Client Details Card -->
        <div class="mt-12 bg-white shadow-md rounded-lg overflow-hidden" style="background-color: #1F2937;">
            <div class="p-6">
                <div class="flex flex-col md:flex-row items-center">
                    <!-- Client Avatar -->
                    <div class="flex-shrink-0 mb-4 md:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <!-- Circle for the Head -->
                        <circle cx="12" cy="8" r="4" />
                        <!-- Path for the Shoulders -->
                        <path d="M4 20c0-4 4-7 8-7s8 3 8 7H4z" />
                        </svg>
                    </div>

                    <!-- Client Information -->
                    <div class="ml-0 md:ml-6 flex-1 text-white">
                        <h2 class="text-2xl font-bold">
                            {{ $client->name }}
                        </h2>
                        <p>
                            Email: <a href="mailto:{{ $client->email }}" class="text-blue-500 hover:underline">{{ $client->email }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('clients.index') }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">
                Back to Clients
            </a>
        </div>
    </div>
</x-app-layout>