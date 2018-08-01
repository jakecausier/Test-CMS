<template lang="html">
    <div class="media-gallery">

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item" v-for="(folder, key) in media" :key="key">
                <a class="nav-link active" href="#">{{ folder.name }}</a>
            </li>
        </ul>

        <div class="card mb-4 search-bar">
            <div class="card-body">
                <div class="form-group">
                    <label for="searchFolder">Search folder</label>
                    <input v-model='search' type="text" class="form-control" id="searchFolder" placeholder="">
                </div>
            </div>
        </div>

        <div class="tab-content row">
            <div class="col-12 col-sm-6 col-lg-3" v-for="(content, key) in filteredMedia">
                <media-card :media="content" :on-delete="handleDelete" />
            </div>
        </div>

    </div>
</template>

<script>
    import MediaCard from './MediaCard'
    export default {
        name: 'MediaGallery',
        components: {
            MediaCard
        },
        props: {
            media: {
                type: Array,
                required: true
            },
            deleteUrl: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                currentTab: {},
                errors: {},
                search: '',
            }
        },
        computed: {
            filteredMedia() {
                return this.search ? this.currentTab.content.filter(content => content.name.toUpperCase().includes(this.search.toUpperCase())) : this.currentTab.content;
            }
        },
        mounted() {
            this.currentTab = this.media[0]
        },
        methods: {
            handleDelete(content) {
                axios.delete(`${this.deleteUrl}/${content.id}`)
                     .then((data) => {
                         this.currentTab.content.splice(this.currentTab.content.indexOf(content), 1)
                     })
                     .catch((error) => {
                         this.errors = error.response.data
                     })
            }
        }
    }
</script>

<style lang="css">
</style>
