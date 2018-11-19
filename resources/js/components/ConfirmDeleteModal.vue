<template>
<div class="modal is-active">
	<div class="modal-background"></div>
	<div class="modal-content">
        <div class="box">
		    <h1 class="modal-title" v-text="this.contentText"></h1>
            <br>
            <div class="buttons is-centered">
                <span class="button is-primary is-hovered" @click="confirm" v-text="this.confirmButtonText"></span>
                <span class="button is-light is-hovered" @click="closePopup">Cancel</span>
            </div>
        </div>
	</div>
</div>
</template>

<script>
export default {
    props: [
        'contentText',
        'confirmButtonText',
    ],

    methods: {
        confirm() {
            this.$emit('confirm');
            this.closePopup();
        },
        closePopup() {
            this.$emit('hide');
        }
    }
}
</script>

