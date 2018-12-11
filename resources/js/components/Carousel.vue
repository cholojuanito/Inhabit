<template>
  <div class="carousel carousel-animate carousel-animate-slide">
        <div class="carousel-container">

            <div v-for="(url, index) in imgUrls" :key="index" :class="carouselItemClasses(index)">
                <img class="is-background" :src="url" alt="">
            </div>

            <!-- Navigation Arrows -->
            <div class="carousel-navigation is-overlay">
                <div class="carousel-nav-left">
                    <span class="icon">
                    <i class="fas fa-chevron-left" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="carousel-nav-right">
                <span class="icon">
                    <i class="fas fa-chevron-right" aria-hidden="true"></i>
                </span>
                </div>
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

  created() {
    // // Brings in the carousel script to make the carousel work
    let carouselScript = document.createElement("script");
    carouselScript.setAttribute("src", "/js/carousel.min.js");
    document.head.appendChild(carouselScript);
  },
  methods: {
    carouselItemClasses(index) {
      return ["carousel-item", "has-background"];
    }
  }
};
</script>

