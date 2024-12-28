<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Client Details Card -->
        <div class="mt-12 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Client Details</h2>
                    <a href="{{ route('clients.form', ['id' => $client->id]) }}" class="bg-slate-700 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">
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
                                Client type
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                                CUI
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        <tr>
                            <td class="p-4 text-left text-sm text-gray-900 dark:text-white">
                                {{ $client->name }}
                            </td>
                            <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                {{ $client->client_type }}
                            </td>
                            <td class="p-4 text-right text-sm text-gray-900 dark:text-white">
                                {{ $client->cui }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 mb-4">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                Address
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                                Location
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        <tr>
                            <td class="p-4 text-left text-sm text-gray-900 dark:text-white">
                                {{ $client->address }}
                            </td>
                            <td class="p-4 text-right text-sm text-gray-900 dark:text-white">
                                {{ $client->city }}, {{ $client->county }}, {{ $client->country }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="pt-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Contact</h4>
                </div>

                @if(count($contacts) == 0)
                    <div class="p-4 text-sm text-gray-900 text-center dark:text-white">
                        No contacts found.
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Name
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                                    Title
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Phone
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                                    Email
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td class="p-4 text-left text-sm text-gray-900 dark:text-white">
                                        {{ $contact->first_name }} {{ $contact->last_name }}
                                    </td>
                                    <td class="p-4 text-right text-sm text-gray-900 dark:text-white">
                                        {{ $contact->title }}
                                    </td>
                                    <td class="p-4 text-left text-sm text-gray-900 dark:text-white">
                                        {{ $contact->phone }}
                                    </td>
                                    <td class="p-4 text-right text-sm text-gray-900 dark:text-white">
                                        {{ $contact->email }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Invoices -->
        <div class="mt-12 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">List of client's invoices</h2>
                </div>

                <ol class="relative border-s border-gray-200 dark:border-gray-700">
                    @foreach($invoices as $invoice)
                        <li class="mb-10 ms-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Invoice #{{ $invoice->id }}</h3>
                            <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Generated at {{ $invoice->created_at->format('d M y, H:i') }}</time>
                            <div class="flex justify-between">
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Invoice value: {{ currency_symbol($invoice->currency) }}{{ $invoice->value }}</p>
                                <a href="{{ route('invoices.details', ['id' => $invoice->id]) }}" class="bg-slate-700 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded opacity-85 hover:opacity-100">
                                    View
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ol>
                {{ $invoices->onEachSide(3)->links() }}
            </div>
        </div>
    </div>
</x-app-layout>