<template>
    <div class="card">
        <img :src="img_src" class="card-img-top" alt="..." />
        <div class="card-body">
            <h5 class="card-title">{{ title }}</h5>
            <p class="card-text">
                {{ text }}
            </p>
            <a :href="produkt_link" class="button-import" :data-id="product_id"
                >Zobacz produkt</a
            >
        </div>
    </div>
</template>

<script>
export default {
    props: ["product_id", "img_src", "title", "text"],
    computed: {
        produkt_link() {
            return "/sklep/produkt/" + this.product_id;
        },
    },
};
</script>

<style lang="scss" scoped>
.card {
    height: 430px;
    width: 270px;
}

// <!-- HTML !-->
// <button class="button-34" role="button">Button 34</button>

/* CSS */
.button-import {
    background: #5e5df0;
    border-radius: 999px;
    box-shadow: #5e5df0 0 10px 20px -10px;
    box-sizing: border-box;
    color: #ffffff;
    cursor: pointer;
    font-family: Inter, Helvetica, "Apple Color Emoji", "Segoe UI Emoji",
        NotoColorEmoji, "Noto Color Emoji", "Segoe UI Symbol", "Android Emoji",
        EmojiSymbols, -apple-system, system-ui, "Segoe UI", Roboto,
        "Helvetica Neue", "Noto Sans", sans-serif;
    font-size: 16px;
    font-weight: 700;
    line-height: 24px;
    opacity: 1;
    outline: 0 solid transparent;
    padding: 8px 18px;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: fit-content;
    word-break: break-word;
    border: 0;
}
</style>
