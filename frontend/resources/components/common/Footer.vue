<template>
    <footer id="footer">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-5">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <router-link :to="{name:'home'}" lass="logo">
                                <img :src="logoBanner">
                            </router-link>
                        </div>
                        <div class="footer-copyright">
								<span>&copy;
Copyright &copy;{{ new Date().getFullYear() }} All rights reserved | This template is made with <i class="fa fa-heart-o"
                                                                                                   aria-hidden="true"></i> by <a
                                            href="https://colorlib.com" target="_blank">Colorlib</a>
                                </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="footer-widget">
                                <h3 class="footer-title">About Us</h3>
                                <ul class="footer-links">
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="#">Join Us</a></li>
                                    <li><a href="contact.html">Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6" v-if="categories.length > 0">
                            <div class="footer-widget">
                                <h3 class="footer-title">Categories</h3>
                                <ul class="footer-links">
                                    <li v-for="category in categories" :key="category.id">
                                        <router-link :to="{name:'category.detail', params: {slug:category.slug}}">
                                            {{ category.title }}
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </footer>
</template>
<script>
    import LogoBanner from '~/static/img/logo.png';

    export default {
        data() {
            return {
                logoBanner: LogoBanner
            }
        },
        computed: {
            categories() {
                return this.$store.state.category.items;
            }
        }
    }
</script>