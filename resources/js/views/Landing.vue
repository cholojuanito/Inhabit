<template>
    <section class="hero is-primary is-bold is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
        <div class="column is-6 is-offset-3">
          <h1 class="title">
            Browse our listings
          </h1>
          <h2 class="subtitle">
             Make finding your next apartment easier than ever.
          </h2>
          <div class="box">
            <div class="level">
              <div class="level-item">
                  <search-bar></search-bar>
                </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </section>    
</template>

<script>
import SearchBar from "../components/SearchBar";

export default {
  components: { SearchBar }
};
</script>
