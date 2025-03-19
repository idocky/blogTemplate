<template>
    <div class="author-card">
        <div class="author-info">
            <div class="mb-3">
                <img
                    v-if="author.image"
                    :src="authorImageUrl"
                    :alt="author.image.alt"
                    class="author-photo"
                />

                <div v-else class="author-placeholder">
                    {{ initials }}
                </div>
            </div>
            <h3 class="author-name">{{ author.name }} {{ author.second_name }}</h3>
            <p class="author-bio text-left">{{ author.description }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "AuthorCard",
    props: {
        author: {
            type: Object,
            required: true,
        }
    },
    computed: {
        initials() {
            if (!this.author.name) return "?";
            return this.author.name
                .split(" ")
                .map(word => word[0])
                .join("")
                .toUpperCase();
        },
        authorImageUrl() {
            if (!this.author.image || !this.author.image.src) return '';

            // Если путь уже полный, ничего не добавляем
            if (this.author.image.src.startsWith('http')) {
                return this.author.image.src;
            }

            return `${window.location.origin}/storage/${this.author.image.src.replace(/^\/+/, '')}`;
        }
    }
};
</script>


<style scoped>
.author-card {
    display: flex;
    align-items: center;
    max-width: 400px;
}

.author-photo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 15px;
}

.author-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #555;
    margin-right: 15px;
}

.author-info {
    flex: 1;
}

.author-name {
    margin: 0;
    font-size: 18px;
    font-weight: bold;
}

.author-bio {
    margin: 5px 0 0;
    font-size: 14px;
    color: #666;
}
</style>
