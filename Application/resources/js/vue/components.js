import { createApp } from "vue";
import AddClientContactsComponent from "./Clients/AddClientContactsComponent.vue";
import ShowClientContactsComponent from "./Clients/ShowClientContactsComponent.vue";
import ConfirmDeleteModalComponent from "./General/ConfirmDeleteModalComponent.vue";

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