<template>
    <div class="field">
        <div class="control has-icons-left is-expanded">
            <input ref="autocomplete"  class="input search-bar" type="text" placeholder="Try 'Provo, UT'">
            <span class="icon is-large">
                <i class="fa fa-search"></i>
            </span>
        </div>
    </div>
</template>

<script>
export default {
  mounted() {
    this.autocomplete = new google.maps.places.Autocomplete(
      this.$refs.autocomplete,
      { types: ["geocode"] }
    );

    this.autocomplete.addListener("place_changed", () => {
      let place = this.autocomplete.getPlace();
      let ac = place.address_components;
      let lat = place.geometry.location.lat();
      let lon = place.geometry.location.lng();
      let city = ac[0]["short_name"];
      console.log(
        `The placeobj: ${place} \n` +
          `The user picked ${city} with the coordinates ${lat}, ${lon}`
      );
    });
  }
};
</script>


<style>
*,
*::after,
*::before {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}
.search-bar {
  width: 30vw;
  font-size: 16px;
  font-weight: 600;
}

/* Places dropdown that contains autocomplete*/
.pac-container {
  padding: 8px 12px;
}
.pac-item {
  border: none;
  margin-top: 6px;
  margin-bottom: 6px;
  height: 40px;
}
.pac-icon {
}
.pac-container:after {
  background-image: none !important;
  height: 0px;
}
</style>

