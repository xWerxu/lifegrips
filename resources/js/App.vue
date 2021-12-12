<script>
import ProductCard from "./components/ProductCard.vue";
import MainNavbar from "./components/MainNavbar.vue";
import MainBanner from "./components/main_page/MainBanner.vue";
import SubNav from "./components/SubNav.vue";
import FrontpageLabel from "./components/main_page/FrontpageLabel.vue";
import CheckboxList from "./components/CheckboxList.vue";
import ProductImg from "./components/product/ProductImg.vue";
import ProductInfo from "./components/product/ProductInfo.vue";

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
    },

    mounted() {},
};
</script>

<style>
body {
    background-color: rgb(250, 250, 250);
}
</style>
