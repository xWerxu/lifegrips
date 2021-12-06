<template>
    <div
        class="container-fluid px-0 slider-style overflow-hidden"
        :style="{ backgroundImage: src_img }"
    >
        <div class="row d-flex flex-row"></div>
    </div>
</template>

<script>
export default {
    props: ["src_img"],
    data() {
        return {};
    },
    computed: {
        comp_src() {
            return {};
        },
    },
};
</script>

<style scoped>
.slider-style {
    height: 400px;
    background-color: rgb(172, 172, 172);
}

.container-fluid {
    /* background-image: cock.jpg; */
    /* filter: brightness(); */
}

.img_column_style {
    -ms-transform: rotate(-30deg); /* IE 9 */
    -webkit-transform: rotate(-30deg); /* Safari */
    transform: rotate(-30deg); /* Standard syntax */
}
</style>
