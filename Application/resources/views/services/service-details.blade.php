<x-app-layout>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-8">
            Service Details
        </h1>

        <!-- Service Details Card -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background-color: #1F2937;">
            <div class="p-6">
                <div class="flex flex-col md:flex-row items-center">
                    <!-- Service Avatar -->
                    <div class="flex-shrink-0 mb-4 md:mb-0">
                        <img class="w-24 h-24 rounded-full object-cover border border-gray-300" src="/path-to-avatar-placeholder.jpg" alt="Service Avatar">
                    </div>

                    <!-- Service Information -->
                    <div class="ml-0 md:ml-6 flex-1 text-white">
                        <h2 class="text-2xl font-bold">
                            {{ $service->name }}
                        </h2>
                        <p>
                            Price: <span class="text-blue-500">{{ $service->price }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('services.index') }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">
                Back to Services
            </a>
        </div>
    </div>
</x-app-layout>