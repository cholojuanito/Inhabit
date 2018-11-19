<template>
        <button :class="classes" :data-tooltip="toolTipText" @click="toggle">
            <span class="icon is-medium">
                <i class="fa fa-heart"></i>
            </span>
            <span v-text="count"></span>
        </button>
</template>

<script>
export default {
    props: ['favorite'],

    data() {
        return {
            count: this.favorite.numFavorites,
            active: this.favorite.isFavorited
        }
    },

    computed: {
        classes() {
            return [
                'button',
                this.active ? 'is-primary' : 'is-light',
                'tooltip',
            ];
        },

        url() {
            return '/';
        },

        toolTipText() {
            return this.active ? 'Remove from favorites' : 'Add to favorites';
        },
    },

    methods: {
        toggle() {
            this.active ? this.destroy() : this.create();
        },

        create() {
            this.active = true;
            this.count++;
        },

        destroy() {
            this.active = false;
            this.count--;
        },
    }
}
</script>


