import { createApp } from "vue";
import AddClientContactsComponent from "./Clients/AddClientContactsComponent.vue";
import ShowClientContactsComponent from "./Clients/ShowClientContactsComponent.vue";
import ConfirmDeleteModalComponent from "./General/ConfirmDeleteModalComponent.vue";
import ShowServicesComponent from "./Invoices/ShowServicesComponent.vue";
import AddServiceComponent from "./Invoices/AddServiceComponent.vue";

// Register AddClientContactsComponent
if(document.getElementById("add-client-contacts"))
{
    createApp(AddClientContactsComponent).mount("#add-client-contacts");
}

// Register ShowClientContactsComponent
if(document.getElementById("show-client-contacts"))
{
    createApp(ShowClientContactsComponent).mount("#show-client-contacts");
}

// Register ConfirmDeleteModalComponent
if(document.getElementById("confirm-delete-modal-component-div"))
{
    createApp({}).component('confirm-delete-modal-component', ConfirmDeleteModalComponent).mount("#confirm-delete-modal-component-div");
}

// Register ShowInvoiceComponent
if(document.getElementById("show-services-component"))
{
    createApp(ShowServicesComponent).mount("#show-services-component");
}

// Register AddServiceComponent
if(document.getElementById("add-service-component-div"))
{
    createApp({}).component('add-service-component', AddServiceComponent).mount("#add-service-component-div");
}