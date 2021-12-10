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
        FrontpageLabel
    },

    mounted() {
        $(".add-item").click(function () {
            var id = $(this).data("id");
            var quantity = $(this).data("quantity");
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "{{ route('add-to-cart') }}",
                type: "POST",
                data: {
                    variant_id: id,
                    _token: token,
                    quantity: quantity,
                },
            }).done(function (data) {
                console.log(data);
            });
        });
    },
};
</script>

<style>
body {
    background-color: rgb(250, 250, 250);
}
</style>
