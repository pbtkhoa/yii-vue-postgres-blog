<template>
    <div class="col-md-8">
        <div class="row" v-if="posts.length > 0">
            <template v-for="(post, index) in posts">
                <div :class="{'col-md-12': index === 0, 'col-md-6': index !== 0}"
                     :key="post.id">
                    <div class="post post-thumb" v-if="index === 0">
                        <router-link class="post-img" :to="{ name:'post.detail', params: { slug: post.slug } }">
                            <render-image :image="post.thumbnail"></render-image>
                        </router-link>
                        <div class="post-body">
                            <div class="post-meta">
                                <router-link :class="['post-category', `cat-${(postCategory.id % 4) + 1}`]"
                                             :to="{name: 'category.detail', params:{slug:postCategory.slug}}"
                                             v-for="postCategory in post.categories"
                                             :key="postCategory.id">
                                    {{ postCategory.title }}
                                </router-link>
                                <span class="post-date">{{ post.created_at | formatDate }}</span>
                            </div>
                            <h3 class="post-title">
                                <router-link :to="{ name:'post.detail', params: { slug: post.slug } }">
                                    {{ post.title }}
                                </router-link>
                            </h3>
                        </div>
                    </div>
                    <div class="post" v-else>
                        <router-link class="post-img" :to="{ name:'post.detail', params: { slug: post.slug } }">
                            <render-image :image="post.thumbnail"></render-image>
                        </router-link>
                        <div class="post-body">
                            <div class="post-meta">
                                <router-link :class="['post-category', `cat-${(postCategory.id % 4) + 1}`]"
                                             :to="{name: 'category.detail', params:{slug:postCategory.slug}}"
                                             v-for="postCategory in post.categories"
                                             :key="postCategory.id">
                                    {{ postCategory.title }}
                                </router-link>
                                <span class="post-date">{{ post.created_at | formatDate }}</span>
                            </div>
                            <h3 class="post-title">
                                <router-link :to="{ name:'post.detail', params: { slug: post.slug } }">
                                    {{ post.title }}
                                </router-link>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix visible-md visible-lg" v-if="index % 2 === 0"></div>
            </template>
            <div class="clearfix visible-md visible-lg"></div>
            <div class="col-md-12" v-if="isShowLoadMore">
                <div class="section-row">
                    <button
                            class="primary-button center-block" @click="loadMore"
                            :disabled="isLoadingLoadMore"
                            :style="{ opacity: isLoadingLoadMore ? 0.3 : 1}"
                    >
                        Load More
                    </button>
                </div>
            </div>
        </div>
        <p v-else>Loading...</p>
    </div>
</template>
<script>
    export default {
        props: {
            posts: Array
        },
        data() {
            return {
                isLoadingLoadMore: false,
                isShowLoadMore: true,
            }
        },
        created: function () {
            this.$parent.$on('loadingLoadMore', this.setLoadingLoadMore);
            this.$parent.$on('removeLoadMore', this.removeLoadMore);
        },
        watch: {
            posts() {
                this.isLoadingLoadMore = false;
                this.isShowLoadMore = true;
            }
        },
        methods: {
            loadMore() {
                this.$emit('loadMore');
            },
            setLoadingLoadMore(value) {
                this.isLoadingLoadMore = value;
            },
            removeLoadMore() {
                this.isShowLoadMore = false;
            }
        }
    }
</script>

<style scoped>
    .post-meta .post-category {
        margin-bottom: 5px;
        display: inline-block;
    }

    .post-meta .post-date {
        display: block;
    }
</style>