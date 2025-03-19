<template>
    <div class="article-container">
        <!-- Категории над тайтлом -->
        <div class="category secondary-text">
            <span v-for="(category, index) in article.categories" :key="index">
                {{ category }}
            </span>
        </div>

        <!-- Тайтл как ссылка -->
        <a :href="'/blog/' + article.slug" class="article-title secondary-title">
            <h2>{{ article.title }}</h2>
        </a>

        <!-- Краткое содержание -->
        <p class="summary secondary-text">{{ article.description }}</p>

        <!-- Автор и дата публикации -->
        <span class="mr-3 secondary-text">{{ article.author.name + ' ' + article.author.second_name }}</span>
        <span class="secondary-text">{{ article.created_at }}</span>
    </div>
</template>

<script>
export default {
    props: {
        article: Object,
        index: Number
    }
};
</script>

<style scoped>
.article-container {
    padding: 20px;
}

.article-title {
    color: #0F1819;
    font-size: 1.5rem;
    font-weight: bold;
    text-decoration: none;
    text-align: left;
}

.article-title:hover {
    color: #FF5757;
}

.summary {
    font-size: 1rem;
    text-align: left;
    color: #0F1819;
}

.category span {
    padding-right:10px;
}
</style>
