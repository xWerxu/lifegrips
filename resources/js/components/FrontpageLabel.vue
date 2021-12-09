<template>
    <div class="mb-5 shadow-bottom">
        <div
            class="container-fluid label-up"
            :style="{ backgroundColor: data.background_color }"
        >
            <div class="container pl-5 pb-3 pt-2">
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
                        <h2>Drake w Lifegrips</h2>
                        <h4>Sprawdź jego twórczość!</h4>
                    </div>
                    <div class="col justify-content-end pt-4">
                        <img :src="data.image" />
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid label-down">
            <div class="container d-flex">
                <div class="row"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        const backgroundColor = 2;
        return {
            backgroundColor,
        };
    },

    props: {
        data: {
            id: Number,
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
            updated_at: String,
        },
    },
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
</style>
