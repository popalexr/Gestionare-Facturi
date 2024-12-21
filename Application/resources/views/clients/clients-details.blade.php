<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        

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
    </div>
</x-app-layout>