<template>
    <div id="add-service-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-1/2 max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add service
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-service-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <div class="flex justify-between">
                                <label for="service-name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Service name</label>
                                <span class="text-sm text-red-500 dark:text-red-400" v-if="error.service_name">{{ error.service_name }}</span>
                            </div>
                            <input type="text" v-model="newService.service_name" :data-ajax-url="ajaxUrl" name="service_name" id="service-name"
                                class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>

                        <div class="col-span-2">
                            <div class="flex justify-between">
                                <label for="service-price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                                <span class="text-sm text-red-500 dark:text-red-400" v-if="error.price">{{ error.price }}</span>
                            </div>
                            <input type="text" v-model="newService.price" name="service_price" id="service-price"
                                class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>

                        <div class="col-span-2">
                            <div class="flex justify-between">
                                <label for="service-vat" class="block text-sm font-medium text-gray-700 dark:text-gray-200">VAT</label>
                                <span class="text-sm text-red-500 dark:text-red-400" v-if="error.vat">{{ error.vat }}</span>
                            </div>
                            <input type="text" v-model="newService.vat" name="service_vat" id="service-vat"
                                class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        
                        <div class="col-span-2">
                            <div class="flex justify-between">
                                <label for="service-currency" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Currency</label>
                                <span class="text-sm text-red-500 dark:text-red-400" v-if="error.currency">{{ error.currency }}</span>
                            </div>
                            <select id="service-currency" name="service_currency" v-model="newService.currency" class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                <option value="ron" :selected="newService.currency === 'ron'">RON</option>
                                <option value="usd" :selected="newService.currency === 'usd'">USD</option>
                                <option value="eur" :selected="newService.currency === 'eur'">EUR</option>
                            </select>
                        </div>

                        <div class="col-span-2">
                            <div class="flex justify-between">
                                <label for="service-quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Quantity</label>
                                <span class="text-sm text-red-500 dark:text-red-400" v-if="error.quantity">{{ error.quantity }}</span>
                            </div>
                            <input type="text" v-model="newService.quantity" name="service_quantity" id="service-quantity"
                                class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>
                    </div>
                    <button type="button" @click="addService()" class="flex py-1 px-3 border-4 border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Add service
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
    import { type } from 'jquery';
import eventBus from './../eventBus';
    import { Modal } from 'flowbite';

    export default {
        props: {
            ajaxUrl: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                newService: {
                    service_name: '',
                    quantity: '',
                    price: '',
                    vat: '',
                    currency: '',
                },
                error: {
                    service_name: '',
                    quantity: '',
                    price: '',
                    vat: '',
                    currency: '',
                },
                modal: null,
                isEdit: false,
                editIndex: null,
            };
        },
        methods: {
            openModal() {
                this.modal.toggle();
            },
            onServiceSelected(data) {
                this.newService.service_name = data.name;
                this.newService.price = data.price;
                this.newService.vat = data.vat;
                this.newService.currency = data.currency;
            },

            addService() {
                // Reset errors
                this.error = {
                    service_name: '',
                    quantity: '',
                    price: '',
                    vat: '',
                    currency: '',
                };

                let isValid = true;

                // Validate the data
                for (const key in this.newService) {
                    if (this.newService[key] === '') {
                        this.error[key] = 'This field is required.';

                        isValid = false;
                    }
                }

                if (!isValid) {
                    return;
                }

                if(this.isEdit) {
                    eventBus.emit('edit-service', {"index": this.editIndex, "service": { ...this.newService}});
                }
                else {
                    eventBus.emit('service-added', { ...this.newService});
                }

                this.modal.toggle();
            },
            editService(e) {
                for (const key in this.newService) {
                    this.newService[key] = e['service'][key];
                }

                this.isEdit = true;
                this.editIndex = e['index'];

                for (const key in this.error) {
                    this.error[key] = '';
                }

                this.openModal();
            },
            addNewService() {
                for (const key in this.error) {
                    this.error[key] = '';
                }

                for (const key in this.newService) {
                    this.newService[key] = '';
                }

                this.isEdit = false;
                this.editIndex = null;

                this.openModal();
            }
        },
        mounted() {
            const modal_target = document.getElementById("add-service-modal");
            const modal_options = {
                placement: 'bottom-right',
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
            };
            this.modal = new Modal(modal_target, modal_options);

            const add_service_button = document.getElementById("open-service-modal-button");
            add_service_button.addEventListener("click", this.addNewService);

            eventBus.emit('add-service-modal-loaded'); // Trigger this event to initialize service autocomplete search.
            eventBus.on('service-modal-selected', this.onServiceSelected);

            eventBus.on('open-edit-service-modal', this.editService);
        }
    };
</script>
  