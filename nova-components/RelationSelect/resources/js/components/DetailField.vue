<template>
    <panel-item :field="field">
        <p slot="value">
            {{field.value.map(item => item[relationLabel]).join(',')}}
        </p>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    computed: {
        relationLabel() {
            return this.field.relationLabel ? this.field.relationLabel : 'id';
        }
    }
}
</script>
