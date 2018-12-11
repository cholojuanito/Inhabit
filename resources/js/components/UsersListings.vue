<template>
	<div class="container has-top-margin">
		<div class="content">
			<p class="title">Your Listings</p>
		</div>
		<div class="content has-text-centered" v-if="this.listings.userListings.length === 0">
			<p class="title">You haven't posted a listing yet!</p>
			<div class="button is-danger">
				<router-link to="/create-listing">Post your listing</router-link>
			</div>
		</div>
		<div class="columns is-multiline" v-else>
			<div class="column is-3" v-for="l in this.listings.userListings" :key="l.id">
				<listing-card :listing="l" :show-favorite="false"></listing-card>
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

