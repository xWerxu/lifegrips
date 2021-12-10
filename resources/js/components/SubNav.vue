<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div
                class="collapse navbar-collapse d-flex justify-content-center"
                id="navbarNavDropdown"
            >
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            aria-current="page"
                            :href="href_muzyka"
                        >
                            Muzyka
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="href_akcesoria">Akcesoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="href_odziez">Odzież</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {};
    },
    props: ["href_muzyka", "href_akcesoria", "href_odziez"],
};
</script>

<style scoped>
li {
    display: flex;
    flex-wrap: row
}

a {
    color: #fff;
    letter-spacing: 0.05em;
    display: inline-block;
    padding: 2px 20px;
    position: relative;
}
a:after {
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
a:hover:after {
    width: 100%;
    left: 0;
}
</style>
