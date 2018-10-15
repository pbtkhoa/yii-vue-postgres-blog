<template>
    <div class="section">
        <!-- container -->
        <div class="container">
            <div class="row">
                <post-list
                        :posts="category == null ? [] : category.posts"
                        @loadMore="loadMorePost"
                />
                <div class="col-md-4">
                    <most-read-post :posts="mostViewCategory === null ? [] : mostViewCategory.posts"/>
                </div>
            </div>
        </div>
        <!-- /container -->
    </div>
</template>

<script>
    import PostList from '~/components/PostList'
    import MostReadPost from '~/components/MostReadPost'

    export default {
        components: {
            PostList,
            MostReadPost
        },
        props: {
            slug: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                page: 1,
                category: null,
                mostViewCategory: null
            }
        },
        metaInfo() {
            return {
                title: this.category !== null ? this.category.title : 'Loading...',
            }
        },
        watch: {
            async slug(newValue) {
                this.page = 1;
                this.category = null;
                this.mostViewCategory = null;

                let category = this.$store.dispatch('category/getCategory', {
                    vm: this,
                    slug: newValue,
                    page: this.page,
                    created_at: 'desc'
                });
                let mostViewCategory =this.$store.dispatch('category/getMostReadCategory', {
                    vm: this,
                    slug: newValue,
                    limit: 5,
                    created_at: 'desc'
                });

                this.category = await category;
                this.mostViewCategory = await mostViewCategory;
            }
        },
        destroyed() {
            this.$store.commit('category/setItem', null);
        },
        async created() {
            let category = this.$store.dispatch('category/getCategory', {
                vm: this,
                slug: this.slug,
                page: this.page,
                created_at: 'desc'
            });

            let mostViewCategory = this.$store.dispatch('category/getMostReadCategory', {
                vm: this,
                slug: this.slug,
                limit: 5,
                created_at: 'desc'
            });

            this.category = await category;
            this.mostViewCategory = await mostViewCategory;
        },
        methods: {
            async loadMorePost() {
                this.$emit('loadingLoadMore', true);
                this.page = this.page + 1;
                let categoryPost = this.category.posts,
                    posts = await this.$store.dispatch('category/getCategory', {
                        vm: this,
                        slug: this.slug,
                        page: this.page,
                        created_at: 'desc'
                    }).then(cat => cat.posts);
                if (typeof posts !== 'undefined' && posts.length > 0) {
                    this.category.posts = categoryPost.concat(posts);
                    this.$emit('loadingLoadMore', false);
                } else {
                    this.$emit('removeLoadMore');
                }
            }
        }
    }
</script>