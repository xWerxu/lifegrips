require("./bootstrap");

import { createApp } from "vue";
import App from "./App.vue";
import PrimeVue from "primevue/config";

const app = createApp(App);
app.use(PrimeVue);

const vm = app.mount("#app");

console.log(vm.count); // => 4
