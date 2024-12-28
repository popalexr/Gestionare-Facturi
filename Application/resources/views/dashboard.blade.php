<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between">
                    <div class="max-w-xl w-full p-4 md:p-6">
                        <div>
                            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ currency_symbol('ron') }} {{ $thisWeekSales['totalSales'] }}</h5>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Sales this week</p>
                        </div>
                        <div id="dashboard-this-week-sales">
                            <div class="hidden" id="dashboard-this-week-sales-json">
                                @json($thisWeekSales['salesChart'] ?? [])
                            </div>
                        </div>
                    </div>
                    <div class="max-w-xl w-full p-4 md:p-6">
                        <p class="leading-none text-lg font-bold text-gray-900 dark:text-white pb-2">Last 5 invoices</p>

                        <div class="overflow-x-auto">
                            @if ($lastInvoices->count() == 0)
                                <p class="text-sm text-gray-900 dark:text-white">No invoices found</p>
                            @else
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                                Client
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                                Total
                                            </th>
                                            @can('invoices-view')
                                                <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                                                    Action
                                                </th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800">
                                        @foreach ($lastInvoices as $invoice)
                                            <tr>
                                                <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                    {{ $invoice->getClientName() }}
                                                </td>
                                                <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                    {{ currency_symbol($invoice->currency) }} {{ $invoice->value }}
                                                </td>
                                                @can('invoices-view')
                                                    <td class="p-4 text-right text-sm text-gray-900 dark:text-white">
                                                        <!-- View invoice details -->
                                                        <a href="{{ route('invoices.details', ['id' => $invoice->id]) }}" 
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-2"
                                                            data-tooltip-target="tooltip-view-{{ $invoice->id }}"
                                                        >
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </a>
                                                        <!-- Tooltip -->
                                                        <div id="tooltip-view-{{ $invoice->id }}" 
                                                            role="tooltip" 
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                                        >
                                                            View
                                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                                        </div>
                                                    </td>
                                                @endcan
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
