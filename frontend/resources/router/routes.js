const Home = () => import('~/pages/home').then(m => m.default || m);
const PostDetail = () => import('~/pages/post').then(m => m.default || m);
const CategoryDetail = () => import('~/pages/category').then(m => m.default || m);
export default [
    {path: '/', name: 'home', component: Home, props: true },
    {path: '/post/:slug', name: 'post.detail', component: PostDetail, props: true },
    {path: '/category/:slug', name: 'category.detail', component: CategoryDetail, props: true },
]