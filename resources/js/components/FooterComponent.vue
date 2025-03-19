<template>
    <footer id="footer" class="main-footer mt-5">
        <div class="footer-wrap">
            <div class="footer-column-1">
                <div>
                    <div class="flex">
                        <iframe src="/assets/images/home-new/logo.svg" width="150"></iframe>
                    </div>

                    <div class="footer-copyright copyright">
                        © {{ currentYear }} Mediapeachy Ltd.
                    </div>
                </div>
            </div>

            <div class="footer-column">
                <div>
                    <div class="footer-block-header text-white">Pick a topic</div>
                    <div class="footer-block-columns">
                        <div class="links-block" v-for="(category, index) in categories" :key="index">
                            <div class="footer-block-header ">{{ category.title }}</div>
                            <ul class="no-marker">
                                <li v-for="(subcategory, subIndex) in category.subcategories" :key="subIndex">
                                    <a :href="subcategory.link">{{ subcategory.title }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    props: {
        categories: Array
    },
    data() {
        return {
            currentYear: new Date().getFullYear(),
        }
    }
}
</script>

<style scoped>
.main-footer {
    background-color: #0F1819;
    color: white;
    padding: 40px 0;
}

.footer-wrap {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.footer-column-1,
.footer-column-2,
.footer-column-3 {
    flex: 1;
    padding: 0 15px;
    min-width: 250px;
}

.footer-block-header {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #E84A5F;
}

.footer-block-columns {
    display: flex;
    flex-wrap: wrap;
}

.links-block {
    margin-right: 30px;
    margin-bottom: 20px;
}

.links-column-header {
    font-weight: 500;
    margin-bottom: 10px;
}

.no-marker {
    list-style: none;
    padding: 0;
    margin: 0;
}

.no-marker li {
    margin-bottom: 8px;
}

.no-marker a {
    color: #fff;
    text-decoration: none;
    transition: opacity 0.2s;
}

.no-marker a:hover {
    opacity: 0.8;
}

.searching {
    width: 100%;
    padding: 10px;
    border: 1px solid #333;
    border-radius: 4px;
    background-color: #1a2425;
    color: white;
    margin-bottom: 15px;
}

.btn-submit {
    position: absolute;
    right: 10px;
    top: 10px;
    background: none;
    border: none;
    color: #fff;
    cursor: pointer;
}

.languages-picker {
    margin-bottom: 15px;
    position: relative;
}

.languages-picker-toggle {
    background-color: transparent;
    border: 1px solid #333;
    padding: 8px 15px;
    color: white;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.caret {
    float: right;
    margin-top: 8px;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #1a2425;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 5px 0;
    z-index: 1;
    list-style: none;
}

.dropdown-menu li a {
    color: white;
    padding: 8px 15px;
    text-decoration: none;
    display: block;
}

.dropdown-menu li a:hover {
    background-color: #233335;
}

.languages-picker-mobile {
    display: none;
    position: relative;
    margin-bottom: 15px;
}

.lang-select {
    width: 100%;
    padding: 8px;
    background-color: #1a2425;
    border: 1px solid #333;
    color: white;
    appearance: none;
}

.select-button {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
}

.footer-copyright {
    margin-top: 20px;
    font-size: 14px;
    color: #bbb;
}

@media (max-width: 768px) {
    .footer-wrap {
        flex-direction: column;
    }

    .footer-column-1,
    .footer-column-2,
    .footer-column-3 {
        width: 100%;
        margin-bottom: 30px;
    }

    .languages-picker {
        display: none;
    }

    .languages-picker-mobile {
        display: block;
    }
}
</style>
