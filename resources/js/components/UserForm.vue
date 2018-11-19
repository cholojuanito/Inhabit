
<script>
    import ImageUpload from './uploads/SingleImageUpload.vue';

    export default {
        props: ['user'],

        components: {
            ImageUpload
        },

        data() {
            return {
                profilePic: this.user.profile_pic,
            };
        },

        methods: {
            onLoad(image) {                
                this.profilePic = image.file.name;
            }
        }
    }
</script>
