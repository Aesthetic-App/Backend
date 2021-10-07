<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">
            <tagify-input :id="field.name" :placeholder="field.name"
                          :name="field.name" :value="selecteds"
                          @tags-changed="updateTags"
                          :items="field.options.map(item => item[relationLabel])"/>
        </template>
    </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'
import TagifyInput from "./TagifyInput";

export default {
    mixins: [FormField, HandlesValidationErrors],
    components: {
        TagifyInput
    },
    data() {
        return {
            selecteds: this.field.value.map(item => item[this.field.relationLabel]),
        }
    },
    props: ['resourceName', 'resourceId', 'field'],
    computed: {
        relationLabel() {
            return this.field.relationLabel ? this.field.relationLabel : 'id';
        }
    },

    methods: {
        updateTags(tags) {
            this.selecteds = tags;
        },
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            const selecteds = this.selecteds.join(",");
            formData.append(this.field.attribute, selecteds)
        },
    },
}
</script>
