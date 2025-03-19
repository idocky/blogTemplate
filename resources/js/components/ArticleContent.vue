<template>
    <div class="container">
        <div class="row mb-5">
            <!-- Левая колонка -->
            <div class="col-md-2">
                <div class="navigation-container">
                    <ScrollNavigation
                        :headings="articleHeadings"
                        contentSelector=".content-block"
                    />
                </div>
            </div>

            <div class="col-md-8">
                <div class="content-block secondary-text">
                    <BlockRecognizer :blocks="this.article.data.content" />

                    <AuthorDescription :author="article.data.author" />
                </div>
            </div>

            <div class="col-md-2">
                <div class="navigation-container">
                    <div class="demo-block text-start">
                        <AuthorCard :author="article.data.author" />
                    </div>
<!--                    <div class="demo-block text-start">-->
<!--                        <img class="banner-image" src="https://ahrefs.com/blog/wp-content/themes/Ahrefs-4/images/promo/certification_b5.png" alt="">-->
<!--                    </div>-->
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import ScrollNavigation from "./ScrollNavigation.vue";
import AuthorCard from "./AuthorCard.vue";
import AuthorDescription from "./AuthorDescription.vue";
import BlockRecognizer from "./BlockRecognizer.vue";

export default {
    props: {
        article: {
            type: Object,
            required: true
        },
    },
    components: {BlockRecognizer, ScrollNavigation, AuthorCard, AuthorDescription },
    name: "ArticleContent",
    computed: {
        articleHeadings() {
            let headings = [];
            for (const key in this.article.data.content) {
                if (Object.prototype.hasOwnProperty.call(this.article.data.content, key)) {
                    if (this.article.data.content[key].type === "1" && this.article.data.content[key].data.content[0].blue_header) {
                        headings.push({
                            id: "article-header-" + (Number(key) + 1),
                            text: this.article.data.content[key].data.content[0].blue_header,
                        });
                    }
                }
            }

            return headings;
        },
    },
};
</script>

<style scoped>
.row {
    display: flex;
    justify-content: space-between;
    flex-wrap: nowrap; /* Убираем обтекание */
}

.navigation-container {
    position: sticky;
    top: 20px; /* Отступ от верха при закреплении */
}


.demo-block {
    margin-bottom: 20px;
}

.banner-image {
    max-width: 180px;
}
</style>
