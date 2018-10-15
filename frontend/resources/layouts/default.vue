<template>
    <div>
        <header-vue></header-vue>
        <child/>
        <footer-vue></footer-vue>
    </div>
</template>

<script>
    import Header from '~/components/common/Header'
    import Footer from '~/components/common/Footer'

    export default {
        name: 'MainLayout',
        components: {
            HeaderVue: Header,
            FooterVue: Footer
        },
        created() {
            this.$store.dispatch('category/getCategories', {
                vm: this
            });
        },
    }
</script>