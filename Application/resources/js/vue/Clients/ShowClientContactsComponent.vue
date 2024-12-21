<template>
    <div>
        <div class="flex justify-end">
            <button id="open-add-client-contacts-modal-button" class="py-1 px-3 border-4 border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button">
                Add Contact Person
            </button>
        </div>
        <div class="flex justify-center" v-if="contacts.length === 0">
            <p class="text-center text-gray-500 dark:text-gray-300">No contacts found</p>
        </div>
        <div v-else>
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-600">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                            First name
                        </th>
                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                            Last name
                        </th>
                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                            Title
                        </th>
                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                            Email
                        </th>
                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                            Phone
                        </th>
                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-white">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    <tr v-for="(contact, index) in contacts" :key="index">
                        <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                            {{ contact.first_name }}
                        </td>
                        <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                            {{ contact.last_name }}
                        </td>
                        <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                            {{ contact.title }}
                        </td>
                        <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                            {{ contact.email }}
                        </td>
                        <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                            {{ contact.phone }}
                        </td>
                        <td class="p-4 text-right text-sm text-gray-900 dark:text-white">
                            <button type="button" @click="editContact(index, contact)"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-2"
                            >
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button type="button" @click="deleteContact(index)"
                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-for="(contact, index) in contacts" :key="contact.id">
            <input type="hidden" :name="'contacts[' + index + '][first_name]'" :value="contact.first_name">
            <input type="hidden" :name="'contacts[' + index + '][last_name]'" :value="contact.last_name">
            <input type="hidden" :name="'contacts[' + index + '][title]'" :value="contact.title">
            <input type="hidden" :name="'contacts[' + index + '][email]'" :value="contact.email">
            <input type="hidden" :name="'contacts[' + index + '][phone]'" :value="contact.phone">
        </div>
    </div>
</template>

<script>
    import eventBus from './../eventBus';
    export default {
        data() {
            return {
                contacts: []
            };
        },
        methods: {
            editContact(index, contact) {
                eventBus.emit("open-edit-client-contacts-modal", {"index": index, "contact": contact});
            },
            deleteContact(index) {
                this.contacts.splice(index, 1);
            }
        },
        mounted() {
            const open_add_client_contacts_modal_button = document.getElementById("open-add-client-contacts-modal-button");

            open_add_client_contacts_modal_button.addEventListener("click", () => {
                eventBus.emit("open-add-client-contacts-modal");
            });

            if(contacts.length > 0) {
                this.contacts = contacts;
            }

            eventBus.on('add-contact', (contacts) => {
                this.contacts.push(contacts);
            });

            eventBus.on('edit-contact', (data) => {
                this.contacts[data.index] = data.contact;
            });
        }
    };
</script>