<template>
    <div id="add-client-contacts-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-1/2 max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add new contact
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-client-contacts-modal">
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
                                <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">First name</label>
                                <span class="text-sm text-red-500 dark:text-red-400" v-if="error.first_name">{{ error.first_name }}</span>
                            </div>
                            <input type="text" v-model="newContact.first_name" name="first_name" id="first_name"
                                class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <div class="flex justify-between">
                                <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Last name</label>
                                <span class="text-sm text-red-500 dark:text-red-400" v-if="error.last_name">{{ error.last_name }}</span>
                            </div>
                            <input type="text" v-model="newContact.last_name" name="last_name" id="last_name"
                                class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <div class="flex justify-between">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                                <span class="text-sm text-red-500 dark:text-red-400" v-if="error.title">{{ error.title }}</span>
                            </div>
                            <input type="text" v-model="newContact.title" name="title" id="title"
                                class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <div class="flex justify-between">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                                <span class="text-sm text-red-500 dark:text-red-400" v-if="error.email">{{ error.email }}</span>
                            </div>
                            <input type="text" v-model="newContact.email" name="email" id="email"
                                class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        
                        <div class="col-span-2">
                            <div class="flex justify-between">
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Phone</label>
                                <span class="text-sm text-red-500 dark:text-red-400" v-if="error.phone">{{ error.phone }}</span>
                            </div>
                            <input type="text" v-model="newContact.phone" name="phone" id="phone"
                                class="mt-1 w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>
                    </div>
                    <button type="button" @click="addContact()" class="flex py-1 px-3 border-4 border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Add new client
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
    import eventBus from './../eventBus';
    import { Modal } from 'flowbite';

    export default {
        data() {
            return {
                newContact: {
                    id: "",
                    first_name: "",
                    last_name: "",
                    title: "",
                    email: "",
                    phone: ""
                },
                error: {
                    first_name: "",
                    last_name: "",
                    title: "",
                    email: "",
                    phone: ""
                },
                isEditing: false,
                idEdited: null,
                modal: null
            };
        },
        methods: {
            addContact() {
                let hasError = false;
                
                // Check if the fields are empty
                for (const key in this.newContact) {
                    if (this.newContact[key] === "") {
                        this.error[key] = "This field is required";

                        hasError = true;
                    } else {
                        this.error[key] = "";

                        hasError = false;
                    }
                }

                // Check if email is valid
                if(this.newContact.email !== "") {
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if(!emailPattern.test(this.newContact.email)) {
                        this.error.email = "Invalid email address";

                        hasError = true;
                    }
                    else {
                        this.error.email = "";

                        hasError = false;
                    }
                }

                if (hasError) {
                    return;
                }

                if(this.newContact.id === "") {
                    this.newContact.id = Math.random().toString(36);
                }

                if(this.isEditing) {
                    eventBus.emit("edit-contact", { "contact": {...this.newContact}, "index": this.idEdited });
                }
                else {
                    eventBus.emit("add-contact", { ...this.newContact });
                }

                this.modal.toggle();
            },

            openModal(e) {
                if(typeof e !== 'undefined')
                {
                    for (const key in this.newContact) {
                        this.newContact[key] = e.contact[key];
                        this.error[key] = "";
                    }

                    this.isEditing = true;
                    this.idEdited = e.index;
                }
                else {
                    this.isEditing = false;
                    this.idEdited = null;
                    
                    for (const key in this.newContact) {
                        this.newContact[key] = "";
                        this.error[key] = "";
                    }
                }

                this.modal.toggle();
            },
        },
        mounted() {
            const modal_target = document.getElementById("add-client-contacts-modal");
            const modal_options = {
                placement: 'bottom-right',
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
            };

            this.modal = new Modal(modal_target, modal_options);

            eventBus.on("open-add-client-contacts-modal", this.openModal);
            eventBus.on("open-edit-client-contacts-modal", this.openModal);
        }
    };
</script>
  