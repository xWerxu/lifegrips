<script>
import ProductCard from "./components/ProductCard.vue";
import MainNavbar from "./components/MainNavbar.vue";
import MainBanner from "./components/main_page/MainBanner.vue";
import SubNav from "./components/SubNav.vue";
import FrontpageLabel from "./components/main_page/FrontpageLabel.vue";

export default {
    data() {
        return { count: 4 };
    },

    components: {
        ProductCard,
        MainNavbar,
        SubNav,
        MainBanner,
        FrontpageLabel,
    },

    mounted() {},
};
</script>

<style>
body {
    background-color: rgb(250, 250, 250);
}
</style>
