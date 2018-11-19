<template>
<div>
    <div class="columns is-multiline">
        <div class="column" v-for="listing in listings" :key="listing.id">
            <listing-card :listing="listing"></listing-card>
        </div>
    </div>
</div>
</template>

<script>
import ListingCard from "./ListingCard.vue";
export default {
  props: ["listings"],

  components: { ListingCard },

  data() {
    return {
      listingsArray: this.listings
    };
  },

  computed: {
    chunkedListings() {
      return _.chunk(this.listingsArray, 4);
    }
  },

  methods: {}
};
</script>

