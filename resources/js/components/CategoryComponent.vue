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

        <div class="row no-wrap">
            <div class="col-md-4">
                <div v-if="filteredArticles.length" class="card">
                    <div class="card-body">
                        <a :href="'/blog/' + filteredArticles[0].slug" class="article-title secondary-title">
                            <img v-if="filteredArticles[0].images[0].src !== null" :src="storageUrl + filteredArticles[0].images[0].src" class="card-img-top" alt="Article Image">
                            <h5 class="card-title text-left hatton-semi-bold article-title">{{ filteredArticles[0].title }}</h5>
                        </a>
                        <p class="card-text text-left hatton-semi-bold">{{ filteredArticles[0].short_description }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div v-for="(article, index) in filteredArticles.slice(1, 4)" :key="article.id" class="card mb-3">
                    <div class="card-body">
                        <a :href="'/blog/' + article.slug" class="article-title secondary-title">
                            <h5 class="card-title text-left hatton-semi-bold article-title">{{ article.title }}</h5>
                        </a>

                        <p class="card-text text-left hatton-semi-bold">{{ article.short_description }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div v-for="(article, index) in filteredArticles.slice(4, 7)" :key="article.id" class="card mb-3">
                    <div class="card-body">
                        <a :href="'/blog/' + article.slug" class="article-title secondary-title">
                            <h5 class="card-title text-left hatton-semi-bold article-title">{{ article.title }}</h5>
                        </a>
                        <p class="card-text text-left hatton-semi-bold">{{ article.short_description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        category: Object
    },
    data() {
        return {
            selectedSubcategory: null,
            storageUrl: window.location.origin + '/storage/',
        };
    },
    computed: {
        filteredArticles() {
            if (!this.selectedSubcategory) return [];
            return this.category.articles.filter(article => {
                return Array.isArray(article.subcategories) &&
                    article.subcategories.some(subcatId =>
                        String(subcatId) === String(this.selectedSubcategory)
                    );
            });
        }
    },
    mounted() {
        this.selectedSubcategory = this.category.subcategories[0].id;
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
    text-align: left;
}

.article-title:hover {
    color: #FF5757;
}
</style>
