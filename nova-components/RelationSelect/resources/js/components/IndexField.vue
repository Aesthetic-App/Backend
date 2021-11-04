<template>
    <select @change="change" v-model="field.value" class="w-full form-control form-select" v-if="field.editOnIndex" @focus="showOptions  = true" @blur="showOptions = false">
        <option :value="0" disabled>Select a original</option>
        <option v-if="showOptions || option[field.optionValueKey] == field.value" v-for="(option, index) in field.options" :key="index" :value="option[field.optionValueKey]">
            {{option[field.optionTextKey]}}
        </option>
    </select>
    <span v-else>{{ field.value.map(item => item[relationLabel]).join(',') }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field', 'resource'],
    data() {
        return {
            showOptions: false
        }
    },
    created() {},
    methods: {
        change() {
            Nova.request().put(`/api/admin/icons/${this.resource.id.value}`, {
                original_id: this.field.value
            })
        }
    },
    computed: {
        relationLabel() {
            return this.field.relationLabel ? this.field.relationLabel : 'id';
        }
    }
}
</script>
