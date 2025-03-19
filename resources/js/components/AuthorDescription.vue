<template>
    <div class="author-card">
        <img
            v-if="author.image"
            :src="imageSrc"
            :alt="author.image.alt"
            class="author-photo"
        />

        <div v-else class="author-placeholder">
            {{ initials }}
        </div>

        <div class="author-info">
            <div class="mb-2 author-bio">Article By</div>
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
        },
        baseUrl: {
            type: String,
            default: () => window.location.origin
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
        imageSrc() {
            if (!this.author.image?.src) return "";
            return `${this.baseUrl}/storage/${this.author.image.src.replace(/^\/+/, '')}`;
        }
    }
};
</script>


<style scoped>
.author-card {
    height: 320px;
    padding: 0 40px;
    display: flex;
    align-items: center;
    background-color: rgba(204, 196, 196, 0.37);
}

.author-photo {
    width: 250px;
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
    color: #000000;
}
</style>
