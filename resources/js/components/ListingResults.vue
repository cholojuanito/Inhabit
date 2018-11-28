<template>
<div class="container has-top-margin">
    <div class="content has-text-centered" v-if="this.listings.listings.length === 0">
      <p class="title">
        Uh oh! No listings showed up
      </p>
    </div>
    <div class="columns is-multiline" v-else>
        <div class="column is-3" v-for="l in this.listings.listings" :key="l.id">
          <listing-card :listing="l"></listing-card>
        </div>
    </div>
</div>
</template>

<script>
import { mapState } from "vuex";
import ListingCard from "./ListingCard.vue";
export default {
  components: { ListingCard },

  data() {
    return {};
  },

  computed: {
    ...mapState(["listings"])
  },

  methods: {}
};
</script>

<style lang="scss" scoped>
.has-top-margin {
  margin-top: 10%;
}
</style>

