<template>
    <div class="row">
        <div class="col-3">
            <div v-for="image in images_parsed" :key="image.image_id">
                <img class="side_image mr-2 mt-2" :src="image.path" />
            </div>
        </div>
        <div class="col-9">
            <img :src="main_image" />
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    props: ["side_images", "main_image"],
    mounted() {
        console.log(this.main_image);
    },
    computed: {
        images_parsed() {
            return JSON.parse(this.side_images);
        },
    },
};
</script>

<style>
.side_image {
    width: 80px;
    height: 80px;
}

/* 
 {
            image_id: Number,
            path: String,
            created_at: String,
            updated_at: String,
            variant_id: Number,
        }, */
</style>
