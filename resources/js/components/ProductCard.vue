<template>
    <div class="card" style="width: 18rem">
        <img :src="img_src" class="card-img-top" alt="..." />
        <div class="card-body">
            <h5 class="card-title">{{ title }}</h5>
            <p class="card-text">
                {{ text }}
            </p>
            <a :href="href_link" class="btn btn-primary">Dodaj do koszyka</a>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    props: ["img_src", "title", "text", "href_link"],
};
</script>

<style lang="scss" scoped></style>
