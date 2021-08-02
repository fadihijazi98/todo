<template>
    <div class="my-8">
        <div>
            <div class="relative inline-block">
                <div class="relative">
                    <input placeholder="type key to search"
                           v-model="keyword"
                           class="appearance-none rounded-none relative px-6 py-2 bg-gray-100
                                   border border-gray-300 placeholder-gray-600 text-purple-900 rounded-t-md tracking-widest
                                   focus:outline-none focus:ring-gray-600 focus:border-purple-600 sm:text-sm"/>
                    <div class="absolute top-0 bottom-0 right-3 flex items-center">
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="search" role="img"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                             class="w-4 text-purple-600">
                            <path fill="currentColor"
                                  d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z"
                                  class=""></path>
                        </svg>
                    </div>
                </div>
                <div class="bg-purple-800 text-white mt-1 rounded-b-md absolute left-0 right-0">
                    <div class="hover:bg-purple-900 px-4 p-2" v-for="item in result">
                        <a :href="`/${key_path}/${item.id}`" target="_blank">
                            <span v-if="item.name" v-text="item.name"></span>
                            <span v-else-if="item.title" v-text="item.title"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SearchBarComponent",
    props: {
        endpoint: {
            type: String,
            required: true
        },
        csrf: {
            type: String,
            default: ''
        },
        key_path: {
            type: String,
            default: 'board'
        }
    },
    data() {
        return {
            keyword: '',
            result: [],
        }
    },
    methods: {
        search() {
            axios.post(this.endpoint, {csrf_token: this.csrf, keyword: this.keyword})
                .then(resp => {
                    this.result = resp.data;
                })
                .catch(err => console.log(err));
        }
    },
    watch: {
        keyword() {
            if (!this.keyword) {
                this.result = [];
            } else
                this.debounceName();
        }
    },
    created() {
        this.debounceName = _.debounce(this.search, 1000);
    },

}
</script>

<style scoped>

</style>
