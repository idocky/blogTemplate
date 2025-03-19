<template>
    <div class="header-description mb-4 text-20" style="background-color: #0F1819; color: white; text-align: center; padding: 40px 0;">
        <div class="mb-4">
            <span class="hatton-semi-bold categories-section">{{ formattedCategories }}</span>
        </div>
        <h1 class="mb-3 primary-title title-section">
            {{ article.data.title }}
        </h1>
        <span class="primary-text mr-4" style="font-size: 1rem;">By {{ article.data.author.name }} {{ article.data.author.second_name }}</span>
        <span class="primary-text mr-4" style="font-size: 1rem;">Published - {{ article.data.created_at }}</span>
        <span class="primary-text" v-if="article.data.reading_duration" style="font-size: 1rem;">{{ article.data.reading_duration }} min read</span>
    </div>
</template>

<script>
export default {
    name: 'ArticleHeader',
    props: {
        article: {
            type: Object,
            required: true
        }
    },
    computed: {
        formattedCategories() {
            return this.article.data.categories.join(' ▪ ');
        }
    }

};
</script>

<style scoped>
.header-description {
    background-color: #FF5757;
    color: white;
    text-align: center;
    padding: 40px 0;
}

.title-section {
    font-size: 2.5rem;
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
}

.categories-section {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}
</style>
