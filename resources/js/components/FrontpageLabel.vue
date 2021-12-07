<template>
<div class="mb-5">
    <div class="container-fluid label-up ">
        <div class="container pl-5">
            <div class="row d-flex">
                <div class="col justify-content-start label-text mt-4 centered">
                    <h2>Drake w Lifegrips</h2>
                    <h4> Sprawdź jego twórczość!</h4>

                </div>
                <div class="col justify-content-end pt-4">
                    <img :src="src_img">

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid label-down">
        <div class="container d-flex">
            <div class="row">

            </div>
        </div>
    </div>
</div>
    
</template>

<script>
export default {
    props: {
        src_img: String,
        }
}
</script>

<style scoped>

.label-up{
    background-color: rgb(70, 70, 70);
}

.label-down{
    background-color: rgb(36, 36, 36);
}






</style>

