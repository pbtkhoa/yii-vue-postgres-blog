<template>
    <div class="aside-widget" v-if="posts.length > 0">
        <div class="section-title">
            <h2>Most Read</h2>
        </div>

        <div class="post post-widget" v-for="post in posts" :key="post.id">
            <router-link class="post-img" :to="{ name:'post.detail', params: {slug: post.slug} }">
                <render-image :image="post.thumbnail"/>
            </router-link>
            <div class="post-body">
                <h3 class="post-title">
                    <router-link :to="{ name:'post.detail', params: {slug: post.slug} }">{{ post.title }}</router-link>
                </h3>
            </div>
        </div>
    </div>
    <p v-else>Loading...</p>
</template>
<script>
    import RenderImage from "~/components/common/RenderImage";

    export default {
        components: {RenderImage},
        props: {
            posts: {
                type: Array,
                required: true
            }
        }
    }
</script>
<style scoped>
    .post-body{
        margin-left: 105px;
        word-break: break-word;
        word-wrap: break-word;
    }
</style>