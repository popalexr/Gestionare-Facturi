import { createApp } from "vue";
import AddClientContactsComponent from "./Clients/AddClientContactsComponent.vue";
import ShowClientContactsComponent from "./Clients/ShowClientContactsComponent.vue";

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