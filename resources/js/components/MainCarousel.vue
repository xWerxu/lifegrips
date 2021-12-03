<template>
    <div class="container">
        <div class="row">
            <div class="col mb-4">
                <div
                    id="carouselExampleIndicators"
                    class="carousel slide"
                    data-bs-ride="carousel"
                >
                    <div
                        class="carousel-indicators carousel-indicators-styling"
                    >
                        <button
                            type="button"
                            data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="0"
                            class="active"
                            aria-current="true"
                            aria-label="Slide 1"
                        ></button>
                        <button
                            type="button"
                            data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="1"
                            aria-label="Slide 2"
                        ></button>
                        <button
                            type="button"
                            data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="2"
                            aria-label="Slide 3"
                        ></button>
                    </div>
                    <div class="carousel-inner carousel_style">
                        <div class="carousel-item active">
                            <img :src="src1" class="d-block w-100" alt="test" />
                        </div>
                        <div class="carousel-item">
                            <img :src="src2" class="d-block w-100" alt="test" />
                        </div>
                        <div class="carousel-item">
                            <img :src="src3" class="d-block w-100" alt="test" />
                        </div>
                    </div>
                    <button
                        class="carousel-control-prev"
                        type="button"
                        data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev"
                    >
                        <span
                            class="carousel-control-prev-icon"
                            aria-hidden="true"
                        ></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button
                        class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next"
                    >
                        <span
                            class="carousel-control-next-icon"
                            aria-hidden="true"
                        ></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["src1", "src2", "src3"],
};
</script>

<style scoped>
.carousel_style {
    border-radius: 45px;
}

.carousel-inner {
    max-height: 350px;
}

.card-style {
    border-radius: 20px;
}

.product_styling {
    border-radius: 15px;
}

@media only screen and (max-width: 768px) {
    .carousel_style {
        border-radius: 10px;
    }

    .carousel-indicators-styling {
    }
}
</style>
