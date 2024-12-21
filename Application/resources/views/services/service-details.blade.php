<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        

        <!-- Client Details Card -->
        <div class="mt-12 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Service Details</h2>
                    <a href="{{ route('services.form', ['id' => $service->id]) }}" class="bg-slate-700 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                </div>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Name
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                Price
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                                VAT
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                                Final Price
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 mb-4">
                        <tr>
                            <td class="p-4 text-left text-sm text-gray-900 dark:text-white">
                                {{ $service->name }}
                            </td>
                            <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                {{ $service->price }} {{ $service->getCurrencySymbol() }}
                            </td>
                            <td class="p-4 text-right text-sm text-gray-900 dark:text-white">
                                {{ $service->vat }} %
                            </td>
                            <td class="p-4 text-right text-sm text-gray-900 dark:text-white">
                                {{ $service->price + ( $service->price * ($service->vat / 100) ) }} {{ $service->getCurrencySymbol() }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="pt-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Description</h4>
                    <p class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ $service->description }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>