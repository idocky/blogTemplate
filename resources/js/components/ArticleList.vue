<template>
    <div class="articles-list container pb-5">
        <div class="row mt-4" v-for="(chunk, index) in paginatedChunks" :key="index">
            <div v-for="(article, idx) in chunk" :key="article.id" class="col-md-6 article-column">
                <Article :article="article" :index="idx" />
                <div v-if="idx === 0" class="vertical-divider"></div>
            </div>
        </div>

        <div class="pagination-controls mt-4 d-flex justify-content-center">
            <button @click="changePage(page)" v-for="page in totalPages" :key="page" :class="['btn', 'me-2', 'mr-2', 'pagination-button', { 'active': currentPage === page }]">{{ page }}</button>
        </div>
    </div>
</template>

<script>
import Article from './Article.vue';

export default {
    props: {
        articles: Array,
    },
    data() {
        return {
            currentPage: 1,
            perPage: 6
        };
    },
    components: {
        Article
    },
    computed: {
        totalPages() {
            return Math.ceil(this.articles.length / this.perPage);
        },
        paginatedArticles() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.articles.slice(start, start + this.perPage);
        },
        paginatedChunks() {
            return Array.from({ length: Math.ceil(this.paginatedArticles.length / 2) }, (_, index) => {
                return this.paginatedArticles.slice(index * 2, index * 2 + 2);
            });
        }
    },
    methods: {
        changePage(page) {
            this.currentPage = page;
        }
    }
};
</script>

<style scoped>
.row {
    display: flex;
    justify-content: space-between;
    flex-wrap: nowrap; /* Убираем обтекание */
}

.mt-4 {
    margin-top: 1.5rem;
}

.col-md-6 {
    display: flex;
    flex-direction: column;
    max-width: 50%; /* Ограничиваем ширину, чтобы элементы не выходили за пределы */
}

.article-column {
    position: relative;
}

a {
    color: #0F1819; /* основной цвет */
    text-decoration: none;
}

a:hover {
    color: #FF5757; /* оранжевый цвет при наведении */
}

.category span {
    background-color: #FF5757;
    padding: 5px 10px;
    border-radius: 0; /* убираем закругление */
    border: 2px solid #FF5757;
}

.article-container {
    border: none;
}

.summary {
    margin-top: 10px;
}
.row {
    position: relative;
    display: flex;
    justify-content: space-between;
    flex-wrap: nowrap; /* Убираем обтекание */
}

.row::after {
    content: "";
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 1px; /* Толщина линии */
    background-color: #ccc; /* Серый цвет линии */
    transform: translateX(-50%);
}

.pagination-button {
    background-color: #0F1819;
    color: white;
    border: 2px solid #0F1819;
}

.pagination-button.active{
    background-color: whitesmoke;
    color: #0F1819;
}

.btn:focus,
.btn:active,
.btn:active:focus {
    outline: none !important;
    box-shadow: none !important;
}

</style>
