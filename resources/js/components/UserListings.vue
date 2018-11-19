<template>
<div>
    <div class="columns" v-for="listings in chunkedListings">
        <div class="column" v-for="listing in listings" :key="listing.id">
            <listing-preview :listing="listing" @delete="onDelete" @edit="onEdit" @edit-fail="onEditFail"></listing-preview>
        </div>
    </div>

    	<!-- The Notifications
	<notifications group="success" :duration="3000" :width="300" animation-name=" v-fade-right" position="top right">
		<template slot="body" slot-scope="props">
        		<article class="message is-success">
					<div class="message-header">
						{{props.item.title}}
						<button class="delete" aria-label="delete" @click="props.close"></button>
					</div>
          			<div class="message-body" v-text="props.item.text">
          			</div>
          		</article>
	  	</template>
	</notifications>
	<notifications group="error" :duration="5000" :width="300" animation-name="v-fade-right" position="top right">
		<template slot="body" slot-scope="props">
				<article class="message is-danger">
					<div class="message-header">
						{{props.item.title}}
						<button class="delete" aria-label="delete" @click="props.close"></button>
					</div>
					<div class="message-body" v-text="props.item.text">
					</div>
				</article>
		</template>
	</notifications>
	End Notifications-->
</div>
</template>

<script>
import ListingPreview from "./ListingPreview.vue";
export default {
  props: ["listings"],

  components: { ListingPreview },

  data() {
    return {
      listingsArray: this.listings
    };
  },

  computed: {
    chunkedListings() {
      return _.chunk(this.listingsArray, 2);
    }
  },

  methods: {
    findListingByID(id) {
      for (var i = 0; i < this.listings.length; i++) {
        if (this.listings[i].id === id) {
          return i;
        }
      }
    },

    onDelete(listing) {
      let _this = this;
      let index = this.findListingByID(listing.listing.id);
      axios
        .delete(`/listing/${listing.listing.id}`)
        .then(function() {
          _this.onSuccess(index);
        })
        .catch(function() {
          _this.onFailure();
        });
    },

    onEdit(listing) {
      let _this = this;
      let index = this.findListingByID(listing.listing.id);
      axios
        .get(`/listing/${listing.listing.id}`)
        .then(function(response) {
          _this.onSuccessEdit(response.data, index);
        })
        .catch(function(response) {
          console.log(response);
        });

      this.showNotification("success-edit");
    },

    onEditFail() {
      this.showNotification("error-edit");
    },

    onSuccess(index) {
      this.listingsArray.splice(index, 1);
      this.showNotification("success-delete");
    },

    onFailure() {
      this.showNotification("error");
    },

    onSuccessEdit(newListing, index) {
      this.listings[index] = newListing;
    },

    showNotification(type) {
      let group = "";
      let title = "";
      let text = "";
      if (type === "success-delete") {
        group = "success";
        title = "Deleted";
        text = "Your listing has been deleted.";
      } else if (type === "success-edit") {
        group = "success";
        title = "Edited";
        text = "You updated the listing.";
      } else if (type === "error-delete") {
        group = "error";
        title = "Uh oh!";
        text = "Looks like something went wrong while deleting that listing.";
      } else if (type === "error-edit") {
        group = "error";
        title = "Uh oh!";
        text = "Looks like something went wrong while editing that listing.";
      }
      this.$notify({
        group,
        title,
        text
      });
    }
  }
};
</script>

