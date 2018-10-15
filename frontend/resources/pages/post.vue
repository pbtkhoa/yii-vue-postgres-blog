<template>
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Post content -->
                <div class="col-md-8" v-if="isLoading">
                    Loading...
                </div>
                <div class="col-md-8" v-else>
                    <div class="section-row sticky-container">
                        <div class="main-post" v-html="post.content"></div>
                        <div class="post-shares sticky-shares">
                            <a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
                            <a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-envelope"></i></a>
                        </div>
                    </div>

                    <!-- author -->
                    <div class="section-row">
                        <div class="post-author">
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object"
                                         :src="post.author.avatar ? post.author.avatar : authorImage">
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <h3>{{ post.author.username }}</h3>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat.</p>
                                    <ul class="author-social">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /author -->
                </div>
                <!-- /Post content -->

                <!-- aside -->
                <div class="col-md-4" v-if="categories.length > 0">
                    <!--<most-read-post/>-->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2>Categories</h2>
                        </div>
                        <div class="category-widget">
                            <ul>
                                <li v-for="category in categories" :key="category.id">
                                    <router-link :to="{name:'category.detail', params: {slug:category.slug}}"
                                                 :class="`cat-${(category.id % 4) + 1}`">
                                        {{ category.title }}
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /aside -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</template>

<script>
    import MostReadPost from '~/components/MostReadPost'
    import AuthorImage from '~/static/img/author.png';

    export default {
        components: {
            MostReadPost
        },
        data() {
            return {
                isLoading: true,
                authorImage: AuthorImage
            }
        },
        props: {
            slug: {
                type: String,
                required: true
            }
        },
        metaInfo() {
            return {
                title: this.post !== null ? this.post.title : 'Loading...',
            }
        },
        watch: {
            async slug(newValue) {
                this.isLoading = true;
                await this.$store.dispatch('post/getPost', {
                    vm: this,
                    slug: newValue
                });
                this.isLoading = false;
            }
        },
        computed: {
            post: {
                get: function () {
                    return this.$store.state.post.post;
                },
                set: function (value) {
                    return this.$store.commit('post/setPost', value);
                }
            },
            categories() {
                return this.$store.state.category.items;
            },
        },
        destroyed() {
            this.post = null;
        },
        async created() {
            await this.$store.dispatch('post/getPost', {
                vm: this,
                slug: this.slug
            });
            this.isLoading = false;
        }
    }
</script>
<style scoped>
    .sticky-container .main-post {
        min-height: 300px;
    }
</style>