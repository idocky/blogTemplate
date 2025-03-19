<template>
    <div class="nav-wrapper">
        <div class="secondary-text mb-3">Content</div>
        <div
            class="scrollable-nav"
            ref="scrollNav"
        >
            <div v-for="(heading, index) in headings" :key="index" class="heading-wrapper">
                <div
                    class="heading-item secondary-text text-10"
                    :class="{ 'active-heading': activeHeading === heading.id }"
                    @click="scrollTo(heading.id)"
                >
                    {{ heading.text }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ScrollNavigation",
    props: {
        headings: {
            type: Array,
            required: true
        },
        contentSelector: {
            type: String,
            default: '.article-content'
        }
    },
    data() {
        return {
            activeHeading: null
        };
    },
    mounted() {
        this.highlightActiveHeading();
    },
    methods: {
        scrollTo(id) {
            const target = document.getElementById(id);
            if (target) {
                const targetPosition = target.offsetTop - 50;
                window.scrollTo({
                    top: targetPosition,
                    behavior: "smooth"
                });
            }
        },
        highlightActiveHeading() {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            this.activeHeading = entry.target.id;
                        }
                    });
                },
                {
                    root: null,
                    rootMargin: "-40% 0px -40% 0px",
                    threshold: 0.1
                }
            );

            this.headings.forEach((heading) => {
                const element = document.getElementById(heading.id);
                if (element) observer.observe(element);
            });
        }
    }
};
</script>

<style scoped>


.scrollable-nav {
    overflow-y: auto;
    max-height: calc(100vh - 150px);
}

.heading-item {
    padding: 5px;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 15px;
    text-align: left;
}

.heading-item:hover {
    background: rgba(195, 70, 70, 0.48);
}

.active-heading {
    background: rgba(195, 70, 70, 0.48);
    font-weight: bold;
    color: whitesmoke;
}

/* Стилизация скроллбара */
.scrollable-nav::-webkit-scrollbar {
    width: 6px;
}

.scrollable-nav::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.scrollable-nav::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.scrollable-nav::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
