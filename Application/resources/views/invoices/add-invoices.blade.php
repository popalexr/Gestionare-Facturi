<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="detailsGeneral" class="w-full p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
                <h3 class="mb-8 text-xl font-bold text-gray-900 dark:text-white">Add Invoice</h3>
                <form method="POST">
                    @csrf
                    <!-- Input fields -->
                    <div class="w-full">
                        <div class="space-y-6 mb-4">
                            <!-- Client name -->
                            <div>
                                <label for="client-search" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Client</label>
                                <input type="text" name="client_name" id="client-search" value="{{ old('client_name') }}"
                                    data-ajax-url="{{ route('api.get-clients') }}"
                                    class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                <input type="hidden" id="client-id" name="client_id" value="{{ old('client_id') }}">
                                @error('client_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Currency -->
                            <div>
                                <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Currency</label>
                                <select id="currency" name="currency" class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                    <option value="ron" @if(old('currency') == 'ron') selected @endif>RON</option>
                                    <option value="usd" @if(old('currency') == 'usd') selected @endif>USD</option>
                                    <option value="eur" @if(old('currency') == 'eur') selected @endif>EUR</option>
                                </select>
                                @error('currency')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Invoice services -->
                            <div class="flex justify-between pt-4">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white">Services</h4>
                                <button type="button" id="open-service-modal-button" class="py-1 px-3 border-4 border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Add Service
                                </button>
                            </div>

                            <div id="show-services-component">
                                <show-services-component></show-services-component>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6" id="addClientButton">
                        <div class="flex justify-center">
                            <button type="submit" class="py-1 px-3 border-4 border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Add Invoice
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="add-service-component-div">
            <add-service-component
                ajax-url="{{ route('api.get-services') }}"
            >
            </add-service-component>
        </div>
    </div>

    <script>
        let services = @json(old('services', []));
    </script>
</x-app-layout>
