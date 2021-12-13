<template></template>
<script>
export default {
    mounted() {
        $(".remove-item").click(function () {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "/koszyk/remove-item",
                type: "DELETE",
                data: {
                    item_id: id,
                    _token: token,
                },
            }).done(function (data) {
                console.log(data);
            });
        });
    },
};
</script>
