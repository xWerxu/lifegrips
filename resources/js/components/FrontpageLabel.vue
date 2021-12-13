<template>
    <div class="mb-5 shadow-bottom">
        <div
            class="container-fluid label-up"
            :style="{ backgroundColor: data.background_color }"
        >
            <div class="container pl-5 pb-3 pt-2">
                <div v-if="data.image_position">
                    <div class="row d-flex">
                        <div
                            class="
                                col
                                justify-content-start
                                label-text
                                mt-4
                                centered
                            "
                        >
                            <h2>{{ data.title }}</h2>
                            <h4>{{ data.short_description }}</h4>
                        </div>
                        <div class="col justify-content-end pt-4">
                            <img :src="data.image" />
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="row d-flex">
                        <div class="col justify-content-start pt-4">
                            <img :src="data.image" />
                        </div>
                        <div
                            class="
                                col
                                justify-content-end
                                label-text
                                mt-4
                                centered
                            "
                        >
                            <h2>{{ data.title }}</h2>
                            <h4>{{ data.short_description }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="container-fluid label-down"
            :style="{ backgroundColor: data.background_products }"
        >
            <div class="container pt-5">
                <div class="row d-flex justify-content-evenly">
                    <div v-for="product in data.products" style="width: 268px">
                        <product-card
                            :product_id="product['main_variant'].product_id"
                            :img_src="product['main_variant'].main_image"
                            :title="product['main_variant'].name"
                            :text="product['main_variant'].price"
                        ></product-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductCard from "../components/ProductCard.vue";

export default {
    data() {
        return {};
    },

    props: ["data"],
    computed: {
        font_color() {
            const hexcolor = background_color.replace("#", "");
            const r = parseInt(hexcolor.substr(0, 2), 16);
            const g = parseInt(hexcolor.substr(2, 2), 16);
            const b = parseInt(hexcolor.substr(4, 2), 16);
            const yiq = (r * 299 + g * 587 + b * 114) / 1000;
            const color_value = "#ffffff";
            if (yiq >= 128) {
                color_value = "#ffffff";
            } else color_value = "#00000";
            return color_value;
        },
    },
    components: { ProductCard },
};
</script>

<style scoped>
.label-up {
    /* background-color: rgb(172, 172, 172); */
}

.label-down {
    /* background-color: rgb(36, 36, 36); */
}

.shadow-bottom {
    -webkit-box-shadow: 0px 34px 0px 0px rgba(0, 0, 0, 1);
    -moz-box-shadow: 0px 34px 0px 0px rgba(0, 0, 0, 1);
    box-shadow: 0px 34px 0px 0px rgba(0, 0, 0, 1);
}

img {
    -webkit-box-shadow: 14px -14px 0px 0px rgba(192, 192, 192, 1);
    -moz-box-shadow: 14px -14px 0px 0px rgba(192, 192, 192, 1);
    box-shadow: 14px -14px 0px 0px rgba(192, 192, 192, 1);
}

/* id: Number,
            published: Number,
            background_color: String,
            background_products: String,
            title: String,
            short_description: String,
            content: String,
            image: String,
            image_position: Number,
            products: Array,
            created_at: String,
            updated_at: String, */
</style>
