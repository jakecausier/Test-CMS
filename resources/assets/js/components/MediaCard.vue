<template lang="html">

    <div class="card mb-4">
        <img class="card-img-top bg-check" :src='thumb ? thumb.image_url : ""' alt="Card image cap">
        <div class="card-body">
            <p>Name: {{ media.name }}</p>
            <p>Size: {{ media.meta.size }}</p>
            <p>Type: {{ media.meta.mime }}</p>
            <ul class="list-group mb-4">
                <li class="list-group-item"><a :href="media.image_url">{{ media.name }}</a></li>
                <li class="list-group-item" v-for='(child, key) in media.children' :key='key'><a :href="child.image_url">{{child.name}}</a></li>
            </ul>
            <button @click="deleteMedia" class="btn btn-outline-danger btn-sm btn-block">Delete</button>
        </div>
    </div>

</template>

<script>
export default {
    name: 'MediaCard',
    props: {
        media: {
            type: Object,
            required: true
        },
        onDelete: {
            type: Function,
            required: false,
            default: () => { return function (content) {} }
        }
    },
    data() {
        return {
        }
    },
    computed: {
        thumb() {
            var thumb = null;
            this.media.children.forEach((child) => {
                if (child.child_type === 'thumb') {
                    thumb = child
                }
            })
            return thumb;
        }
    },
    methods: {
        deleteMedia() {
            this.onDelete(this.media)
        }
    }
}
</script>

<style lang="css">
</style>
