<template>
    <div class="blog-content">
        <header-component :categories="categories"></header-component>
        <header-description></header-description>
        <category-section :subCategory="subCategory" :categories="categories" :articles="articles"></category-section>
        <footer-component :categories="categories.data"></footer-component>
    </div>
</template>

<script>
import HeaderComponent from '../../components/HeaderComponent.vue';
import HeaderDescription from '../../components/HeaderDescription.vue';
import ArticleList from '../../components/ArticleList.vue';
import CategoryComponent from '../../components/CategoryComponent.vue';
import FooterComponent from '../../components/FooterComponent.vue';
import CategorySection from "../../components/CategorySection.vue";
export default {

    components: {
        CategorySection,
        HeaderComponent,
        HeaderDescription,
        ArticleList,
        CategoryComponent,
        FooterComponent
    },
    name: 'Blog',
    props: {
        articles: {
            type: Array,
            required: true
        },
        subCategory: {
            type: Object,
            required: true
        },
        categories: {
            type: Array,
            required: true
        }
    },
};
</script>

<style scoped>

</style>



