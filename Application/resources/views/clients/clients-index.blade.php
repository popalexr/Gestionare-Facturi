<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <!-- Card header -->
                <div class="items-center justify-between lg:flex">
                    <div class="mb-4 lg:mb-0">
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white"> Clients List</h3>
                    <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a list of latest transactions</span>
                    </div>
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
                                    Name
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                    Client type
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                    CUI
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                                    Action
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                @if($clients->count() == 0)
                                <tr>
                                    <td scope="row" class="p-4 text-center text-sm font-medium text-gray-900 dark:text-white" colspan="4">
                                    {{ __('No clients found') }}
                                    </td>
                                </tr> 
                                @else
                                    @foreach($clients as $client)
                                    <tr>
                                        <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                        {{ $client->name }}
                                        </td>
                                        <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                        {{ $client->client_type }}
                                        </td>
                                        <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                        {{ $client->cui }}
                                        </td>
                                        <td class="p-4 text-sm font-medium text-right dark:text-white">
                                        <a href="{{ route('clients.details', ['id' => $client->id]) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
