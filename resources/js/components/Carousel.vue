<template>
  <div class="carousel">
        <div class="carousel-container">
            <div class="carousel-content carousel-animate carousel-animate-slide">
                <div class="carousel-item" v-for="url in imgUrls" :key="url">
                    <img class="is-background" :src="url" alt="">
                </div>
            </div>
            <div class="carousel-nav-left">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
            </div>
            <div class="carousel-nav-right">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: {
        imgUrls: {
            type: Array,
            required: true
        }
    },

    created() { // Brings in the carousel script to make the carousel work
        let carouselScript = document.createElement('script');
        carouselScript.setAttribute('src', '/js/carousel.min.js');
        document.head.appendChild(carouselScript);
    },
}
</script>

