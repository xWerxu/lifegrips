<template>
    <div class="row">
        <div class="col-3">
            <img class="side_image mr-2 mt-2" :src="image" />
            <div v-for="image in images_parsed" :key="image.image_id">
                <img
                    class="side_image mr-2 mt-2"
                    :id="image.image_id"
                    :src="image.path"
                    @mouseover="updateImages(image.path)"
                />
            </div>
        </div>
        <div class="col-9">
            <img class="main_img" :src="main_image" />
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            image: this.manage_image
        };
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
    methods: {
        updateImages(img_src) {
            this.image = img_src
            console.log(this.image);
        }
    },
};
</script>

<style>
.side_image {
    width: 80px;
    height: 80px;
    border: 1px solid #000000;
}

.main_img {
    padding: 10px;
    border: 3px solid #000000;
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
