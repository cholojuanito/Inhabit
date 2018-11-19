<template>
<div>
    <section class="section">
        <!-- Photo section -->
    </section>
    <section class="section">
        <!-- Info section -->
        <div class="container">
            <div class="columns is-gapless is-centered">
                <div class="column is-5 is-offset-2">
                    This is the info section
                </div>
                <div class="column is-3 is-offset-7">
                    <div class="box action-area" >
                        <!-- Make the action area component -->
                        The action area will be here
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <confirm-delete 
        v-show='confirmModalVisible'
        :contentText='modalText'
        :confirmButtonText='modalButtonText'
        @confirm='deleteListing'
        @hide='hideDeleteModal'></confirm-delete>

        <edit-listing 
        v-show='editModalVisible'
        :listing='this.listing'
        @hide='hideEditModal'
        @edited='edited'
        @edit-failed='editFailed'></edit-listing> -->
    <br>
</div>
</template>

<script>
import ConfirmDelete from "../components/ConfirmDeleteModal.vue";
import EditListing from "../components/EditListingModal.vue";
import ImageCarousel from "../components/Carousel.vue";
export default {
  props: ["listing"],

  components: { ConfirmDelete, EditListing, ImageCarousel },

  data() {
    return {};
  },

  computed: {
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
    // deleteListing() {
    //   let listing = this.listing;
    //   this.$emit("delete", { listing });
    // },
    // confirmDelete() {
    //   this.confirmModalVisible = true;
    // },
    // hideDeleteModal() {
    //   this.confirmModalVisible = false;
    // },
    // showEditModal() {
    //   this.editModalVisible = true;
    // },
    // hideEditModal() {
    //   this.editModalVisible = false;
    // },
    // edited() {
    //   this.hideEditModal();
    //   let listing = this.listing;
    //   this.$emit("edit", { listing });
    // },
    // editFailed() {
    //   this.$emit("edit-fail");
    // }
  }
};
</script>

<style>
.action-area {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
}
</style>


