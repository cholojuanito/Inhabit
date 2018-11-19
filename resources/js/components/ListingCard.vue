<template>
<div>
    <div class="card">
        <div class="card-image">
            <image-carousel :imgUrls="urls"></image-carousel>
        </div>

        <footer class="card-footer">
            <p class="card-footer-item">
                <favorite :favorite="favorite"></favorite>
            </p>
            <p class="card-footer-item">
                <a :href="mailTo" class="button is-link">
                    <span class="icon is-medium">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <span v-text="emailText"></span>
                </a>
            </p>
        </footer>

    </div>
    <br>
</div>
</template>

<script>
import Favorite from "./Favorite.vue";
import ImageCarousel from "./Carousel.vue";
export default {
  props: ["listing"],

  components: { Favorite, ImageCarousel },

  data() {
    return {
      //   manager: {
      //     name: this.listing.contact_name,
      //     phone: this.listing.contact_phone,
      //     email: this.listing.contact_email
      //   },
      id: this.listing.id,
      address: this.listing.address,
      rent: this.listing.monthly_price,
      views: this.listing.views,

      modalVisible: false,

      favorite: {
        // manager: this.manager,
        numFavorites: 5,
        isFavorited: true
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
      let storagePath = "/uploads/listings/";
      uploads.forEach(upload => {
        urls.push(storagePath + upload.file_path);
      });

      return urls;
    }
  },

  methods: {
    showModal() {
      this.modalVisible = true;
    },

    hideModal() {
      this.modalVisible = false;
    }
  }
};
</script>

