<template>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" :id="data" />
        <label class="form-check-label" :for="data"> {{ data }} </label>
    </div>

    <div class="container">
        <ul>
            <li>
                <input type="checkbox" id="option" /><label for="option">
                    Electronics</label
                >
                <ul>
                    <li>
                        <label
                            ><input type="checkbox" class="subOption" />
                            Laptops</label
                        >
                    </li>
                    <li>
                        <label
                            ><input type="checkbox" class="subOption" />
                            TVs</label
                        >
                    </li>
                    <li>
                        <label
                            ><input type="checkbox" class="subOption" />
                            Microphones</label
                        >
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        data: {},
    },
    mounted() {
        const checkboxes = document.querySelectorAll("input.subOption"),
            checkall = document.getElementById("option");

        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].onclick = function () {
                const checkedCount = document.querySelectorAll(
                    "input.subOption:checked"
                ).length;

                checkall.checked = checkedCount > 0;
                checkall.indeterminate =
                    checkedCount > 0 && checkedCount < checkboxes.length;
            };
        }

        checkall.onclick = function () {
            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = this.checked;
            }
        };
    },
};
</script>

<style></style>
