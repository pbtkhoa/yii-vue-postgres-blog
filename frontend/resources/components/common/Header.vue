<template>
    <header id="header">
        <!-- Nav -->
        <div id="nav">
            <!-- Main Nav -->
            <div id="nav-fixed">
                <div class="container">
                    <!-- logo -->
                    <div class="nav-logo">
                        <router-link :to="{name:'home'}" class="logo">
                            <img :src="logoBanner"/>
                        </router-link>
                    </div>
                    <!-- /logo -->

                    <!-- nav -->
                    <ul class="nav-menu nav navbar-nav" v-if="categories.length > 0">
                        <li :class="`cat-${(category.id % 4) + 1}`" v-for="category in categories"
                            :key="category.id">
                            <router-link :to="{name: 'category.detail',params: {slug: category.slug}}">
                                {{ category.title }}
                            </router-link>
                        </li>
                    </ul>
                    <!-- /nav -->

                    <!-- search & aside toggle -->
                    <div class="nav-btns">
                        <button class="aside-btn"><i class="fa fa-bars"></i></button>
                        <button class="search-btn"><i class="fa fa-search"></i></button>
                        <div class="search-form">
                            <input class="search-input" type="text" name="search" placeholder="Enter Your Search ...">
                            <button class="search-close"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /search & aside toggle -->
                </div>
            </div>
            <!-- /Main Nav -->

            <!-- Aside Nav -->
            <div id="nav-aside">
                <!-- nav -->
                <div class="section-row">
                    <ul class="nav-aside-menu" v-if="categories.length > 0">
                        <li v-for="category in categories" :key="category.id">
                            <router-link :to="{name: 'category.detail',params: {slug: category.slug}}">
                                {{ category.title }}
                            </router-link>
                        </li>
                    </ul>
                </div>
                <!-- /nav -->

                <!-- social links -->
                <div class="section-row">
                    <h3>Follow us</h3>
                    <ul class="nav-aside-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
                <!-- /social links -->

                <!-- aside nav close -->
                <button class="nav-aside-close"><i class="fa fa-times"></i></button>
                <!-- /aside nav close -->
            </div>
            <!-- Aside Nav -->
        </div>
        <!-- /POST BANNER -->
        <div id="post-header" class="page-header" v-if="post">
            <div class="background-img" :style="{ backgroundImage: `url(${postImage})`}"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="post-meta">
                            <router-link :class="['post-category', `cat-${(postCategory.id % 4) + 1}`]"
                                         :to="{name: 'category.detail',params: {slug: postCategory.slug}}"
                                         v-for="postCategory in post.categories"
                                         :key="postCategory.id">{{ postCategory.title }}
                            </router-link>
                            <span class="post-date">{{ post.created_at | formatDate }}</span>
                        </div>
                        <h1>{{ post.title }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /PAGE BANNER -->
        <div class="page-header" v-if="category">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <ul class="page-header-breadcrumb">
                            <li>
                                <router-link :to="{name: 'home'}">Home</router-link>
                            </li>
                            <li>{{ category.title }}</li>
                        </ul>
                        <h1>{{ category.title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
<script>
    import LogoBanner from '~/static/img/logo.png';
    import NotFoundImage from '~/static/img/image-not-found.png';

    export default {
        data() {
            return {
                logoBanner: LogoBanner
            }
        },
        watch: {
            $route() {
                document.getElementById('nav-fixed').className = 'slide-down';
            }
        },
        computed: {
            post() {
                return this.$store.state.post.post;
            },
            category() {
                return this.$store.state.category.item;
            },
            categories() {
                return this.$store.state.category.items;
            },
            postImage() {
                if (this.post.thumbnail === null || this.post.thumbnail === '') {
                    return NotFoundImage;
                }

                return this.post.thumbnail;
            }
        }
    };
</script>