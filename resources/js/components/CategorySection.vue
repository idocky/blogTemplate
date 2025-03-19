<template>
    <div class="justify-content-center text-center container mt-4">
        <h2 class="secondary-text">{{ category.title }}</h2>
        <p class="hatton-semi-bold cat-description">{{ category.description }}</p>

        <div class="mb-3">
            <button v-for="subcategory in category.subcategories" :key="subcategory.id"
                    class="btn pagination-button me-2 m-2 hatton-semi-bold"
                    :class="{ 'active': selectedSubcategory === subcategory.id }"
                    @click="selectedSubcategory = subcategory.id">
                {{ subcategory.title }}
            </button>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-4">
                <div v-for="(article, index) in filteredArticles" :key="article.id" class="card mb-3">
                    <div class="card-body text-center"> <!-- Добавил text-center для выравнивания текста -->
                        <a :href="'/blog/' + article.slug" class="article-title secondary-title">
                            <h5 class="card-title hatton-semi-bold article-title">{{ article.title }}</h5>
                        </a>

                        <p class="card-text hatton-semi-bold">{{ article.short_description }}</p>
                    </div>
                </div>
            </div>
        </div>


        <!--        <div class="pagination-controls mt-4 d-flex justify-content-center">-->
<!--            <button @click="changePage(page)" v-for="page in totalPages" :key="page" :class="['btn', 'me-2', 'mr-2', 'pagination-button', { 'active': currentPage === page }]">{{ page }}</button>-->
<!--        </div>-->
    </div>
</template>

<script>
export default {
    props: {
        subCategory: Object,
        categories: Object,
        articles: Array,
    },
    data() {
        return {
            category: this.subCategory.data.category,
            selectedSubcategory: null,
            storageUrl: window.location.origin + '/storage/',
            currentPage: 1,
            perPage: 6
        };
    },
    computed: {
        filteredArticles() {
            if (!this.selectedSubcategory) return [];
            return this.category.articles.filter(article => {
                return Array.isArray(article.subcategories) && article.subcategories.includes(this.selectedSubcategory.toString());
            });
        },
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
    mounted() {
        this.selectedSubcategory = this.subCategory.data.id;
    },
    methods: {
        changePage(page) {
            this.currentPage = page;
        }
    }
};
</script>

<style scoped>
.card-img-top {
    height: 200px;
    object-fit: cover;
}

.cat-description {
    max-width: 400px;
    margin: 0 auto;
    white-space: normal;
    overflow-wrap: break-word;
}

.pagination-button {
    background-color: rgba(15, 24, 25, 0.11);;
    color: #0F1819;
    font-weight: 800;
}

.pagination-button.active{
    background-color: #0F1819;
    color: whitesmoke;

}
.row.no-wrap {
    display: flex;
    flex-wrap: nowrap;
}

@media (max-width: 768px) {
    .row.no-wrap {
        flex-wrap: wrap;
    }

}

.btn:focus,
.btn:active,
.btn:active:focus {
    outline: none !important;
    box-shadow: none !important;
}

.card {
    background-color: whitesmoke;
}

.card-body {
    padding-bottom: 1.5rem;
}
.article-title {
    color: #0F1819;
    font-size: 1.3rem;
    font-weight: bold;
    text-decoration: none;
}


.article-title:hover {
    color: #FF5757;
}
</style>
