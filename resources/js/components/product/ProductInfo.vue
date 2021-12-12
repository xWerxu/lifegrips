<template>
    <div class="text-end">
        <h1>{{ value.name }}</h1>
        <br />
        <h3>{{ value.price }} zł</h3>
        <br />
        <h6>Ilość na stanie: {{ value.on_stock }}</h6>
        <br />
        <br />
        <button
            class="button-import add-item"
            role="button"
            :data-id="value.id"
            :data-variant_id="value.id"
            data-quantity="3"
        >
            Dodaj do koszyka
        </button>
    </div>
</template>

<script>
export default {
    props: ["data"],
    computed: {
        value() {
            return JSON.parse(this.data);
        },
    },
    mounted() {
        $(".add-item").click(function () {
            const id = $(this).data("id");
            const quantity = $(this).data("quantity");
            const token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "/sklep/add-to-cart",
                type: "POST",
                data: {
                    variant_id: id,
                    _token: token,
                    quantity: quantity,
                },
            }).done(function (data) {
                console.log(data);
            });
        });
    },
};
</script>

<style>
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
