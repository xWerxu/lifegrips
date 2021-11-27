require("./bootstrap");

import { createApp } from "vue";
import ExampleComponent from "./components/ExampleComponent.vue";

const app = createApp({
    data() {
        return { count: 4 };
    },
    components: {
        ExampleComponent,
    },
});

const vm = app.mount("#app");

console.log(vm.count); // => 4
