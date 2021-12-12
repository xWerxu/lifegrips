<script>
import ExampleComponent from "./components/ExampleComponent.vue";
import ProductCard from "./components/ProductCard.vue";
import MainNavbar from "./components/MainNavbar.vue";
import MainCarousel from "./components/MainBanner.vue";

export default {
    data() {
        return { count: 4 };
    },

    components: {
        ExampleComponent,
        ProductCard,
        MainNavbar,
        MainCarousel,
    },
};
</script>

<style>
body {
    background-color: rgb(250, 250, 250);
}
</style>
