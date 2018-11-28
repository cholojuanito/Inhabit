<template>
    <div class="field">
        <div class="control has-icons-left is-expanded">
            <input ref="autocomplete"  class="input is-medium search-bar" type="text" placeholder="Try 'Provo, UT'">
            <span class="icon is-left is-medium">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        query: "",
        numericFilters: [],
        facetFilters: [],
        location: {
          lat: "",
          lng: ""
        }
      }),
      searchURL: "/api/search"
    };
  },
  mounted() {
    this.autocomplete = new google.maps.places.Autocomplete(
      this.$refs.autocomplete,
      { types: ["geocode"] }
    );

    this.autocomplete.addListener("place_changed", () => {
      let place = this.autocomplete.getPlace();
      let lat = place.geometry.location.lat();
      let lng = place.geometry.location.lng();
      let streetAdr = "";
      let city = "";
      let state = "";
      place.address_components.map(ac => {
        if (ac.types.includes("street_number")) {
          streetAdr += ac.short_name;
        }
        if (ac.types.includes("route")) {
          streetAdr += ac.long_name;
        }
        if (ac.types.includes("locality")) {
          city = ac.short_name;
        }
        if (ac.types.includes("administrative_area_level_1")) {
          state = ac.short_name;
        }
      });
      // Add the query and other filters to the call
      this.form.query = streetAdr + " " + city + " " + state;
      this.form.location.lat = lat;
      this.form.location.lng = lng;

      this.search();
    });
  },
  methods: {
    search() {
      this.$store.dispatch("listings/searchListings", this.form);
    },
    onSuccess() {},
    onFailure(errorData) {
      this.form.onFail(errorData);
    }
  }
};
</script>


<style <style lang="scss" scoped>
*,
*::after,
*::before {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}
.search-bar {
  font-weight: 600 !important;
  transition: width 200ms ease-in !important;
  transition-property: width !important;
  transition-duration: 200ms !important;
  transition-timing-function: ease-in !important;
  transition-delay: 0s !important;
}

.input {
  width: 400px !important;
  background-color: #ffffff !important;
  border: 1px solid #ebebeb !important;
  border-radius: 4px !important;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
  transition: box-shadow 250ms ease-in !important;
}

input:focus {
  transition: width 250ms ease-in !important;
  transition-property: width !important;
  transition-duration: 250ms !important;
  transition-timing-function: ease-in !important;
  transition-delay: 0s !important;
  width: 500px !important;
}

input:hover {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 4px 12px rgba(26, 26, 29, 0.08) !important;
}
</style>

