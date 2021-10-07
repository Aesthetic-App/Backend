<template>
    <span>{{ field.value.map(item => item[relationLabel]).join(',') }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
    created() {

    },
    computed: {
        relationLabel() {
            return this.field.relationLabel ? this.field.relationLabel : 'id';
        }
    }
}
</script>
