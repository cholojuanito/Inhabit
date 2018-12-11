<template>
	<span :class="classes" :data-tooltip="toolTipText" @click="toggle">
		<i class="fas fa-heart fa-2x"></i>
	</span>
</template>

<script>
export default {
	props: ["favorite"],

	data() {
		return {
			favoriteType: "listing"
		};
	},

	computed: {
		classes() {
			return [
				"icon",
				"is-large",
				this.favorite.isFavorited
					? "has-text-danger"
					: "has-text-grey-light",
				"tooltip"
			];
		},

		toolTipText() {
			return this.favorite.isFavorited
				? "Remove from favorites"
				: "Add to favorites";
		}
	},

	methods: {
		toggle() {
			this.favorite.isFavorited ? this.destroy() : this.create();
		},

		create() {
			this.$store
				.dispatch("listings/favorite", this.favorite.listingId)
				.then(data => {
					this.$noty.success("Favorited");
					this.favorite.isFavorited = true;
				})
				.catch(error => {
					if (error.response.status === 401) {
						this.$noty.error("You must be logged in to favorite");
					} else {
						this.$noty.error("Unable to favorite listing");
					}
				});
		},

		destroy() {
			this.$store
				.dispatch("listings/unfavorite", this.favorite.listingId)
				.then(data => {
					this.$noty.success("Unfavorited");
					this.favorite.isFavorited = false;
				})
				.catch(error => {
					if (error.response.status === 401) {
						this.$noty.error("You must logged in to unfavorite");
					} else {
						this.$noty.error("Unable to unfavorite");
					}
				});
		}
	}
};
</script>

<style lang="scss">
</style>

