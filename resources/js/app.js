// import { createApp } from 'vue';
//
// import EmptyComponent from "./components/EmptyComponent.vue";
// import HeaderComponent from "./components/HeaderComponent.vue";
// import HeaderDescription from "./components/HeaderDescription.vue";
// import Article from "./components/Article.vue";
// import ArticleList from "./components/ArticleList.vue";
// import BannersComponent from "./components/BannersComponent.vue";
// import CategoryComponent from "./components/CategoryComponent.vue";
// import FooterComponent from "./components/FooterComponent.vue";
// import ArticleHeader from "./components/ArticleHeader.vue";
// import ArticleContent from "./components/ArticleContent.vue";
// import ScrollNavigation from "./components/ScrollNavigation.vue";
// import AuthorCard from "./components/AuthorCard.vue";
// import AuthorDescription from "./components/AuthorDescription.vue";
//
// const app = createApp({});
//
//
// app.component('empty-component', EmptyComponent);
// app.component('header-component', HeaderComponent);
// app.component('header-description', HeaderDescription);
// app.component('article', Article);
// app.component('article-list', ArticleList);
// app.component('banners-component', BannersComponent);
// app.component('category-component', CategoryComponent);
// app.component('footer-component', FooterComponent);
// app.component('article-header', ArticleHeader);
// app.component('article-content', ArticleContent);
// app.component('scroll-navigation', ScrollNavigation);
// app.component('author-card', AuthorCard);
// app.component('author-description', AuthorDescription);
//
//
// app.mount("#vue-app");

//import 'bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})

