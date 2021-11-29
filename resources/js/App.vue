<template>
    <Knob v:model="50"></Knob>
</template>

<script>
import ExampleComponent from "./components/ExampleComponent.vue";
import Knob from "primevue/knob";

export default {
    data() {
        return { count: 4 };
    },
    components: {
        ExampleComponent,
        Knob,
    },
};
</script>

<style></style>
