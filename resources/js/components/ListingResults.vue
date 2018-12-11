<template>
	<div class="container has-top-margin">
		<div class="content">
			<p class="title">Results</p>
		</div>
		<div class="content has-text-centered" v-if="this.listings.listings.length === 0">
			<p class="title">Uh oh! No listings were found!</p>
		</div>
		<div class="columns is-multiline" v-else>
			<div class="column is-3" v-for="l in this.listings.listings" :key="l.id">
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

	created() {
		let l = this.$store.getters["listings/currentListings"];
		let currQ = this.$store.getters["listings/currentQ"];
		if (l.length <= 0 && currQ === undefined) {
			this.$store
				.dispatch("listings/getInitialListings")
				.then(data => {})
				.catch(errors => {
					console.log("Stuff");
				});
		}
	},

	computed: {
		...mapState(["listings"])
	},

	methods: {}
};
</script>

<style lang="scss" scoped>
</style>

