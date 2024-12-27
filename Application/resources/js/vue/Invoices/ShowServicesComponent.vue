<template>
    <div>
        <table class="w-full divide-y divide-gray-200 dark:divide-gray-600">
            <thead>
                <tr>
                    <th class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                        Service name
                    </th>
                    <th class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                        Quantity
                    </th>
                    <th class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                        Price
                    </th>
                    <th class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                        VAT
                    </th>
                    <th class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                        Currency
                    </th>
                    <th class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="services.length === 0">
                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white" colspan="6">
                        No services found.
                    </td>
                </tr>
                <tr v-for="(service, index) in services" :key="index">
                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                        {{ service.service_name }}
                    </td>
                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                        {{ service.quantity }}
                    </td>
                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                        {{ service.price }}
                    </td>
                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                        {{ service.vat }}
                    </td>
                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                        {{ service.currency }}
                    </td>
                    <td class="p-4 text-center text-sm text-gray-900 dark:text-white">
                        <button type="button" @click="editService(index, service)"
                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-2"
                        >
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        <button type="button" @click="deleteService(index)"
                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-for="(service, index) in services" :key="index">
            <input type="hidden" :name="'services[' + index + '][service_name]'" :value="service.service_name">
            <input type="hidden" :name="'services[' + index + '][quantity]'" :value="service.quantity">
            <input type="hidden" :name="'services[' + index + '][price]'" :value="service.price">
            <input type="hidden" :name="'services[' + index + '][vat]'" :value="service.vat">
            <input type="hidden" :name="'services[' + index + '][currency]'" :value="service.currency">
        </div>
    </div>
</template>

<script>
import eventBus from './../eventBus';

export default {
    data() {
        return {
            services: [],
        };
    },
    methods: {
        addService(service) {
            this.services.push(service);
        },
        editService(index, service) {
            eventBus.emit('open-edit-service-modal', {"index": index, "service": service});
        },
        updateService(data) {
            this.services[data.index] = data.service;
        },
        deleteService(index) {
            this.services.splice(index, 1);
        },
    },
    mounted() {
        if(services.length > 0) {
            this.services = services;
        }

        eventBus.on('service-added', this.addService);
        eventBus.on('edit-service', this.updateService);
    },
}
</script>