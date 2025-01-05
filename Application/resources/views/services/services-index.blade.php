<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
           
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <!-- Card header -->

            <div class="items-center justify-between lg:flex">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Services List</h3>
                    </div>

                    <a href="{{ route('services.form') }}" class="bg-slate-700 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">
                        Add Service
                    </a>
            </div>

            <div class="flex flex-col mt-6">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                               Service name
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                                Price
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                                Currency
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800">
                                        @if($services->count() == 0)
                                            <tr>
                                                <td scope="row" class="p-4 text-center text-sm font-medium text-gray-900 dark:text-white" colspan="4">
                                                    {{ __('No services found') }}
                                                </td>
                                            </tr> 
                                        @else
                                            @foreach($services as $service)
                                                <tr>
                                                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                        {{ $service->name }}
                                                    </td>
                                                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                        {{ $service->price }}
                                                    </td>
                                                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                                                        {{ $service->currency }}
                                                    </td>
                                                    <td class="p-4 text-sm font-medium text-right dark:text-white">
                                                        <!-- View service details -->
                                                        <a href="{{ route('services.details', ['id' => $service->id]) }}" 
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-2"
                                                            data-tooltip-target="tooltip-view-{{ $service->id }}"
                                                        >
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </a>
                                                        <!-- Tooltip -->
                                                        <div id="tooltip-view-{{ $service->id }}" 
                                                            role="tooltip" 
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                                        >
                                                            View
                                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                                        </div>

                                                        <!-- Edit service details -->
                                                        <a href="{{ route('services.form', ['id' => $service->id]) }}" 
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 me-2"
                                                            data-tooltip-target="tooltip-edit-{{ $service->id }}"
                                                        >
                                                            <i class="fa-solid fa-pen"></i>
                                                        </a>
                                                        <!-- Tooltip -->
                                                        <div id="tooltip-edit-{{ $service->id }}" 
                                                            role="tooltip" 
                                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                                        >
                                                            Edit
                                                            <div class="tooltip-arrow" data-popper-arrow></div>

                                                        </div>
                                                        <!-- Delete service -->
                                                        <button type="button"
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 show-delete-modal"
                                                            data-tooltip-target="tooltip-delete-{{ $service->id }}"
                                                            data-id="{{ $service->id }}"
                                                        >
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                        <div id="confirm-delete-modal-component-div">
                                                              <confirm-delete-modal-component 
                                                                    delete-url="{{ route('services.delete', ['id' => '{id}']) }}" 
                                                                    csrf-token="{{ csrf_token() }}">
                                                             </confirm-delete-modal-component>
                                                        </div>
                                                        <!-- Tooltip -->
                                                        <div id="tooltip-delete-{{ $service->id }}" 
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
                            {{ $services->onEachSide(3)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>