<template>
    <nav class="navbar navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li>
                <a class="navbar-brand" href="/">Lifegrips</a>
            </li>
            <li class="float-end">
                <form
                    action="/sklep"
                    class="d-flex flex-row-reverse mb-2 float-end"
                    method="get"
                >
                    <button class="btn btn-outline-success" type="submit">
                        <i class="me-2 bi bi-search"></i>
                    </button>
                    <input
                        class="form-control me-2"
                        type="search"
                        name="q"
                        placeholder="Nazwa produktu"
                        aria-label="Search"
                    />
                </form>
                <a href="/koszyk">
                    <button type="button" class="btn btn-dark">
                        <i class="bi bi-bag-fill"></i>
                    </button>
                </a>
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
