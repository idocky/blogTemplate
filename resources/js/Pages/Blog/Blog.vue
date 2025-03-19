<template>
    <div class="blog-content">
        <header-component :categories="categories"></header-component>
        <header-description></header-description>
        <article-list :articles="blogs.data"></article-list>
        <category-component v-for="category in categories.data" :key="category.id" :category="category"></category-component>
        <footer-component :categories="categories.data"></footer-component>
    </div>
</template>

<script>
import HeaderComponent from '../../components/HeaderComponent.vue';
import HeaderDescription from '../../components/HeaderDescription.vue';
import ArticleList from '../../components/ArticleList.vue';
import CategoryComponent from '../../components/CategoryComponent.vue';
import FooterComponent from '../../components/FooterComponent.vue';
export default {

    components: {
        HeaderComponent,
        HeaderDescription,
        ArticleList,
        CategoryComponent,
        FooterComponent
    },
    name: 'Blog',
    props: {
        blogs: {
            type: Array,
            required: true
        },
        categories: {
            type: Object,
            required: true
        }
    },
};
</script>

<style scoped>

</style>



