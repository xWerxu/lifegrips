<template>
    <nav class="navbar navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li>
                <a class="navbar-brand" href="/">Lifegrips</a>
            </li>
            <li class="float-end">
                <button type="button" class="btn btn-dark">
                    <i class="bi bi-bag-fill"></i>
                </button>
                <button type="button" class="btn btn-dark">
                    <i class="bi bi-person-fill"></i>
                </button>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {};
</script>

<style scoped>
.navbar-nav {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
}

button {
}
</style>
