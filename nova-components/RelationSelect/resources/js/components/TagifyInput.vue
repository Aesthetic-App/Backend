<template>
    <input
        class='form-control'
        ref='inputRef'
        :value='inputValue'
        type='text'
        @change='change'
    >
</template>

<script>
import Tagify from '@yaireo/tagify'
import '@yaireo/tagify/dist/tagify.css'

export default {
    name: 'TagifyInput',
    props: {
        items: {
            type: Array,
            default: [],
        },
        value: {
            required: true,
            type: Array,
        },
    },
    data() {
        return {
            inputRef: null,
            tagify: null,
            inputValue: this.value.join(", ")
        }
    },
    computed: {},
    mounted() {
        this.tagify = new Tagify(this.$refs.inputRef, {
            whitelist: this.items,
            maxTags: 10,
            dropdown: {
                maxItems: 20,
                classname: "tags-look",
                enabled: 0,
                closeOnSelect: false
            }
        })
    },
    watch: {
        items(items) {
            this.tagify = items
        }
    },
    methods: {
        change(e) {
            if (!e.target.value.length) {
                return this.$emit('tags-changed', [])
            }
            try {
                this.$emit('tags-changed', JSON.parse(e.target.value).map(tag => tag.value))
            } catch (e) {
                console.error(e)
            }
        }
    }
}
</script>

<style lang='scss' scoped>

</style>
