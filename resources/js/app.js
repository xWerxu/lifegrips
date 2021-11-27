require("./bootstrap");

import { createApp } from "vue";
import ExampleComponent from "./components/ExampleComponent.vue";

const app = createApp(ExampleComponent).mount("#app");
// app.component("example-component", ExampleComponent);
