<template>
<div>
    <div class="card">

        <div class="card-image">
          <div class="favorite-container">
            <favorite :favorite="favorite"></favorite>
          </div>
            <img class="image image-size" :src="urls[0]" alt="Photo of the apartment">
        </div>

          <div class="has-top-padding">
            <div class="first-line-level">
              <p class="first-line has-text-primary">
                  {{this.listing.rental_type}}
                <span class="has-text-primary" aria-hidden="true"> · </span>
                  {{this.listing.city}}
              </p>
            </div>
            <div class="has-top-padding">
              <div class="second-line-level">
                  <p class="second-line">{{this.listing.street_address}}</p>
              </div>
            </div>
            <div class="has-top-padding">
              <div class="second-line-level">
                <p class="second-line">{{priceText}}</p>
              </div>
            </div>
          </div>

    </div>
</div>
</template>

<script>
import Favorite from "./Favorite.vue";
export default {
  props: ["listing"],

  components: { Favorite },

  data() {
    return {
      favorite: {
        isFavorited: true,
        userId: this.listing.owner.id,
        listingId: this.listing.id
      }
    };
  },

  computed: {
    mailTo() {
      return "mailto:"; //+ this.listing.contact_email;
    },

    emailText() {
      //let nameArray = this.listing.contact_name.split(" ");
      return "Email "; // + nameArray[0];
    },

    urls() {
      let uploads = this.listing.uploads;
      let urls = [];
      let storagePath = "/storage/";
      uploads.forEach(upload => {
        urls.push(storagePath + upload.path + "/" + upload.filename);
      });

      return urls;
    },
    priceText() {
      return "$" + this.listing.monthly_price + "/month";
    }
  },

  methods: {}
};
</script>

<style lang="scss" scoped>
.card {
  background-color: #fff;
  color: #4a4a4a;
  max-width: 100%;
  position: relative;
  box-shadow: none;
}

.card-image {
  position: relative !important;
  width: 100% !important;
  z-index: 0 !important;
}

.image-size {
  border-radius: 3px !important;
  height: 300px !important;
  width: 100% !important;
}

.favorite-container {
  position: absolute !important;
  right: 8px !important;
  top: 8px !important;
  z-index: 2 !important;
}

.has-top-padding {
  padding-top: 2px !important;
}

.first-line-level {
  max-height: 18px !important;
  margin-bottom: 2px !important;
}

.first-line {
  text-transform: uppercase !important;
  text-overflow: ellipsis !important;
  white-space: nowrap !important;
  overflow: hidden !important;
}

.second-line-level {
  line-height: 22px !important;
  max-height: 44px !important;
  text-overflow: ellipsis !important;
  display: -webkit-box !important;
  -webkit-line-clamp: 2 !important;
  -webkit-box-orient: vertical !important;
  font-size: 18px !important;
  overflow: hidden !important;
}

.second-line {
  overflow-wrap: break-word !important;
  font-size: 16px !important;
  line-height: 22px !important;
  letter-spacing: normal !important;
  color: rgb(72, 72, 72) !important;
  font-weight: 800 !important;
  margin: 0px !important;
}
</style>
