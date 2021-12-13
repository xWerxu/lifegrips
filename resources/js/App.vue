<script>
import ProductCard from "./components/ProductCard.vue";
import MainNavbar from "./components/MainNavbar.vue";
import MainBanner from "./components/MainBanner.vue";
import SubNav from "./components/SubNav.vue";
import FrontpageLabel from "./components/FrontpageLabel.vue";
import CheckboxList from "./components/CheckboxList.vue";
import ProductImg from "./components/ProductImg.vue";
import ProductInfo from "./components/ProductInfo.vue";
import JqInjection from "./components/JqInjection.vue";

export default {
    data() {
        return {};
    },

    components: {
        ProductCard,
        MainNavbar,
        SubNav,
        MainBanner,
        FrontpageLabel,
        CheckboxList,
        ProductImg,
        ProductInfo,
        JqInjection,
    },

    mounted() {},
};
</script>

<style>
body {
    background-color: rgb(250, 250, 250);
}
</style>
