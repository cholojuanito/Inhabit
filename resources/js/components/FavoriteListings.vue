<template>
	<div class="container has-top-margin">
		<div class="content">
			<p class="title">Favorites</p>
		</div>
		<div class="content has-text-centered" v-if="this.listings.favoriteListings.length === 0">
			<p class="title">You haven't favorited any listings yet!</p>
		</div>
		<div class="columns is-multiline" v-else>
			<div class="column is-3" v-for="l in this.listings.favoriteListings" :key="l.id">
				<listing-card :listing="l" :show-favorite="true"></listing-card>
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

<style lang="scss">
</style>

