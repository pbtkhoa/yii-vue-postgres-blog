<template>
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <post-list :posts="recentPosts"
                           @loadMore="loadMorePost"/>
                <div class="col-md-4">
                    <most-read-post :posts="mostReadPost"/>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</template>

<script>
    import apiUrl from '~/config/api';
    import PostList from '~/components/PostList'
    import MostReadPost from '~/components/MostReadPost'

    export default {
        components: {
            PostList,
            MostReadPost
        },
        data() {
            return {
                page: 1,
                recentPosts: [],
                mostReadPost: []
            }
        },
        metaInfo() {
            return {
                title: 'Home Page',
            }
        },
        created() {
            this.$axios.get(apiUrl.post, {
                params: {
                    created_at: 'desc',
                    page: this.page
                }
            }).then(resp => {
                this.recentPosts = resp.data;
            });

            this.$axios.get(apiUrl.post, {
                params: {
                    created_at: 'desc'
                }
            }).then(resp => {
                this.mostReadPost = resp.data.splice(0, 4);
            });
        },
        methods: {
            async loadMorePost() {
                this.$emit('loadingLoadMore', true);
                this.page = this.page + 1;
                let recentPosts = this.recentPosts,
                    posts = await this.$axios.get(apiUrl.post, {
                        params: {
                            created_at: 'desc',
                            page: this.page
                        }
                    }).then(resp => resp.data);
                if (typeof posts !== 'undefined' && posts.length > 0) {
                    this.recentPosts = recentPosts.concat(posts);
                    this.$emit('loadingLoadMore', false);
                } else {
                    this.$emit('removeLoadMore');
                }
            }
        }
    }
</script>