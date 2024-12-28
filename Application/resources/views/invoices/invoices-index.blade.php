<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <!-- Card header -->
                <div class="items-center justify-between lg:flex">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Invoices List</h3>
                    </div>

                    <a href="{{ route('invoices.form') }}" class="bg-slate-700 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">
                        Create new invoice
                    </a>
                </div>
                <!-- Table -->
                <div class="flex flex-col mt-6">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                                Invoice ID
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                                Client name
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                                Invoice value
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                                Created at
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                                SPV Status
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800">
                                        @if($invoices->count() == 0)
                                            <tr>
                                                <td scope="row" class="p-4 text-center text-sm font-medium text-gray-900 dark:text-white" colspan="5">
                                                    {{ __('No invoices found') }}
                                                </td>
                                            </tr> 
                                        @else
                                            @foreach($parsed_invoices as $invoice)
                                                <tr>
                                                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                        {{ $invoice->id }}
                                                    </td>
                                                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                        {{ $invoice->client_name }}
                                                    </td>
                                                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                        {{ $invoice->value }} {{ $invoice->currency }}
                                                    </td>
                                                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                        {{ $invoice->created_at }}
                                                    </td>
                                                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                        @if($invoice->spv_status == 'approved')
                                                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full dark:bg-green-700 dark:text-green-100">
                                                        @elseif($invoice->spv_status == 'pending')
                                                            <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                                        @elseif($invoice->spv_status == 'rejected')
                                                            <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full dark:bg-red-700 dark:text-red-100">
                                                        @else
                                                            <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-100">
                                                        @endif
                                                                {{ config('spv.status.' . $invoice->spv_status) }}
                                                            </span>
                                                    <td class="p-4 text-sm font-medium text-right dark:text-white">
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

                                                        <!-- Edit invoice details -->
                                                        <a href="{{ route('invoices.form', ['id' => $invoice->id]) }}" 
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-2"
                                                            data-tooltip-target="tooltip-edit-{{ $invoice->id }}"
                                                        >
                                                            <i class="fa-solid fa-pen"></i>
                                                        </a>
                                                        <!-- Tooltip -->
                                                        <div id="tooltip-edit-{{ $invoice->id }}" 
                                                            role="tooltip" 
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                                        >
                                                            Edit
                                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                                        </div>

                                                        <!-- Delete invoice -->
                                                        <button type="button"
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 show-delete-modal"
                                                            data-tooltip-target="tooltip-delete-{{ $invoice->id }}"
                                                            data-id="{{ $invoice->id }}"
                                                        >
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                        <!-- Tooltip -->
                                                        <div id="tooltip-delete-{{ $invoice->id }}" 
                                                            role="tooltip" 
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                                        >
                                                            Delete
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $invoices->onEachSide(3)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="confirm-delete-modal-component-div">
            <confirm-delete-modal-component 
                delete-url="{{ route('clients.delete', ['id' => '{id}']) }}" 
                csrf-token="{{ csrf_token() }}">
            </confirm-delete-modal-component>
        </div>
    </div>

</x-app-layout>
