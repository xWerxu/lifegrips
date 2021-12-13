<template>
    <div class="card product-card">
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

<style lang="scss">
.link {
    /* RESET */
    text-decoration: none;
    line-height: 1;

    position: relative;
    z-index: 0;
    display: inline-block;
    padding: 5px 5px;
    overflow: hidden;
    color: #333;
    vertical-align: bottom;
    transition: color 0.3s ease-out;
}

link {
    color: rgb(0, 0, 0);
    letter-spacing: 0.05em;
    display: inline-block;
    padding: 2px 20px;
    position: relative;
}
link:after {
    bottom: 0;
    content: "";
    display: block;
    height: 1px;
    left: 50%;
    position: absolute;
    background: #fff;
    transition: width 0.3s ease 0s, left 0.3s ease 0s;
    width: 0;
}
link:hover:after {
    width: 100%;
    left: 0;
}

.product-card {
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
