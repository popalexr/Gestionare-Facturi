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
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Clients List</h3>
                        <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a list of latest transactions</span>
                    </div>

                    <a href="{{ route('clients.form') }}" class="bg-slate-700 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">
                        Add client
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
                                                        <!-- Magnifying Glass Icon -->
                                                        <a href="{{ route('clients.details', ['id' => $client->id]) }}" 
                                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200"
                                                        data-tooltip-target="tooltip-magnify-{{ $client->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 inline-block" style="fill: white;">
                                                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                                                            </svg>
                                                        </a>
                                                        <!-- Tooltip -->
                                                        <div id="tooltip-magnify-{{ $client->id }}" 
                                                            role="tooltip" 
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                            View
                                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                                        </div>

                                                        <!-- Edit client details -->
                                                        <a href="{{ route('clients.form', ['id' => $client->id]) }}" 
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200"
                                                            data-tooltip-target="tooltip-edit-{{ $client->id }}"
                                                        >
                                                            <i class="fa-solid fa-pen"></i>
                                                        </a>
                                                        <!-- Tooltip -->
                                                        <div id="tooltip-edit-{{ $client->id }}" 
                                                            role="tooltip" 
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                                        >
                                                            Edit
                                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $clients->onEachSide(3)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.querySelectorAll('[data-tooltip-target]').forEach((element) => {
        const tooltipId = element.getAttribute('data-tooltip-target');
        const tooltip = document.getElementById(tooltipId);
        element.addEventListener('mouseenter', () => {
            tooltip.classList.remove('invisible', 'opacity-0');
            tooltip.classList.add('visible', 'opacity-100');
        });
        element.addEventListener('mouseleave', () => {
            tooltip.classList.remove('visible', 'opacity-100');
            tooltip.classList.add('invisible', 'opacity-0');
        });
    });
</script>
