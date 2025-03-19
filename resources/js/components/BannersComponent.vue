<template>
    <div class="container banner-container py-4 pl-5 pr-5">
        <div class="justify-content-center text-center mb-3">
            <div style="font-size: 2rem">MediaPeachy</div>
            <div>Actionable digital marketing tutorials on SEO and YouTube marketing.</div>
        </div>
        <div class="row justify-content-center no-wrap">
            <div v-for="(banner, index) in banners" :key="index" class="col-12 col-md-4 d-flex flex-column align-items-center text-center position-relative">
                <img :src="banner.image" :alt="banner.text" class="img-fluid banner-image" />
                <p class="banner-text">{{ banner.text }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            banners: [
                { image: 'https://i.ytimg.com/vi/eXQo1i0z190/mqdefault.jpg', text: 'Реклама 1' },
                { image: 'https://i.ytimg.com/vi/eXQo1i0z190/mqdefault.jpg', text: 'Реклама 2' },
                { image: 'https://i.ytimg.com/vi/eXQo1i0z190/mqdefault.jpg', text: 'Реклама 3' }
            ]
        };
    }
};
</script>

<style scoped>
.banner-container {
    background-color: #FF5757;
}

.banner-image {
    max-width: 300px;
    height: auto;
}
.banner-text {
    font-size: 16px;
    font-weight: bold;
    margin-top: 10px;
}
.vertical-divider {
    width: 100%;
    height: 2px;
    background-color: #ccc;
    margin: 10px 0;
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
</style>
