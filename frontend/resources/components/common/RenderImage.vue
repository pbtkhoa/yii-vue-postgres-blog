<template>
    <img :src="img" @error="imageError">
</template>
<script>
    import NotFoundImage from '~/static/img/image-not-found.png';
    export default {
        name: 'RenderImage',
        data() {
            return {
                img: NotFoundImage
            }
        },
        created() {
            if (this.image === null || this.image === '') {
                this.img = NotFoundImage
            } else {
                this.img = this.image
            }
        },
        props: {
            image: {
                type: String
            }
        },
        methods: {
            imageError() {
                this.img = NotFoundImage
            }
        }
    }
</script>