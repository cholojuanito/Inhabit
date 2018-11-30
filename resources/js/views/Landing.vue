<template>
    <section class="hero is-primary is-bold is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
        <div class="column is-6 is-offset-3">
          <p class="title">
            Browse our listings
          </p>
          <p class="subtitle">
             Make finding your next apartment easier than ever.
          </p>
          <div class="box">
            <div class="level">
              <div class="level-item">
                  <search-bar></search-bar>
                </div>
            </div>
          </div>
          
          <div class="content">
            <p class="subtitle">Need to sell your apartment?</p>
            <div class="level">
              <div class="level-item">
                  <div class="field">
                      <div class="control">
                          <router-link to="/createListing" class="button is-danger">
                              Post Your Apartment
                          </router-link>
                      </div>
                  </div>
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
