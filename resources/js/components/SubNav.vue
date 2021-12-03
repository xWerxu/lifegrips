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
                        <a class="nav-link active" aria-current="page" :href="href_muzyka"> Muzyka </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="href_akcesoria">Akcesoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="href_koszulki">Koszulki</a>
                    </li>
                    <li class="nav-item">
                     <a class="nav-link" :href="href_bluzy">Bluzy</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" :href="href_spodnie">Spodnie</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    props: ["href_muzyka","href_akcesoria","href_koszulki","href_bluzy","href_spodnie"]
};
</script>

<style>

li {
  padding-left: 3rem;
  padding-right: 3rem;
}

a:hover {
      box-shadow:
    0 0 60px 30px #fff,  /* inner white */
    0 0 100px 60px #f0f, /* middle magenta */
    0 0 140px 90px #0ff; /* outer cyan */

    background-color:white;
}
</style>
