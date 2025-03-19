<template>
    <div class="blog-content">
        <header-component :categories="categories"></header-component>
        <article-header :article="blog"></article-header>
        <article-content :article="blog"></article-content>
        <category-component :category="categories.data[0]"></category-component>
        <footer-component :categories="categories.data"></footer-component>
    </div>
</template>

<script>
import HeaderComponent from '../../components/HeaderComponent.vue';
import CategoryComponent from '../../components/CategoryComponent.vue';
import FooterComponent from '../../components/FooterComponent.vue';
import ArticleHeader from '../../components/ArticleHeader.vue';
import ArticleContent from '../../components/ArticleContent.vue';
export default {

    components: {
        HeaderComponent,
        ArticleContent,
        ArticleHeader,
        CategoryComponent,
        FooterComponent
    },
    name: 'Blog',
    props: {
        blog: {
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



