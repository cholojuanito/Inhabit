<template>
            <span  :class="classes" :data-tooltip="toolTipText" @click="toggle">
                <i class="fas fa-heart fa-2x"></i>
            </span>
</template>

<script>
export default {
  props: ["favorite"],

  data() {
    return {
      active: this.favorite.isFavorited,
      favoriteType: "listing"
    };
  },

  computed: {
    classes() {
      return [
        "icon",
        "is-large",
        this.active ? "has-text-danger" : "has-text-grey-light",
        "tooltip"
      ];
    },

    url() {
      return "/favorite";
    },

    toolTipText() {
      return this.active ? "Remove from favorites" : "Add to favorites";
    }
  },

  methods: {
    toggle() {
      this.active ? this.destroy() : this.create();
    },

    create() {
      this.active = true;
    },

    destroy() {
      this.active = false;
    }
  }
};
</script>

<style lang="scss">
</style>

