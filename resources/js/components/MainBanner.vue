<template>
    <div
        class="container-fluid px-0 slider-style overflow-hidden background_img"
        :style="{ backgroundImage: 'url(' + src_img + ')' }"
    >
        <div class="hero-text"> <h2>Największy wybór płyt </h2></div>
    </div>
</template>

<script>
export default {
    props: ["src_img"],
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

.background_img{
    background-position: center center;    
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

@media only screen and (max-width: 600px) {





}

</style>
