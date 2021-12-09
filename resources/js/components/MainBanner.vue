<template>
    <div
        class="container-fluid mb-5 slider-style overflow-hidden background_img"
        :style="{ backgroundImage: image_url }"
    >
        <div class="hero-text"><h2>Największy wybór płyt</h2></div>
    </div>
</template>

<script>
export default {
    props: ["src_img"],
    computed: {
        image_url() {
            return "url( " + this.src_img + " )";
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

.background_img {
    background-position: center;
}

.hero-text {
    margin: auto;
    width: 50%;
    padding: 10px;
    color: white;
}

@media only screen and (max-width: 600px) {
}
</style>
