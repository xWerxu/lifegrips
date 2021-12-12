<template>
    <div class="card">
        <img :src="img_src" class="card-img-top" alt="..." />
        <div class="card-body">
            <h5 class="card-title">{{ title }}</h5>
            <p class="card-text">
                {{ text }}
            </p>
            <a
                :href="produkt_link"
                class="btn btn-info add-item"
                :data-id="product_id"
                >Zobacz produkt</a
            >
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    props: ["product_id", "img_src", "title", "text"],
    computed: {
        produkt_link() {
            return "sklep/produkt/" + this.product_id;
        },
    },
};
</script>

<style lang="scss" scoped>
.card {
    height: 430px;
    width: 270px;
}
</style>
