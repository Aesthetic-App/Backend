<template>
    <v-select @input="change" :label="field.optionTextKey" :options="field.options"
              v-model="selectedOption" class="w-full form-control"
              :get-option-key="(opt) => opt.id"
              placeholder="Select original image"
              :clearable="false"
              v-if="field.editOnIndex" @focus="showOptions  = true" @blur="showOptions = false"
    >
        <template #selected-option="option">
            <div style="display: flex;align-items: center;">
                <img v-if="field.optionImage && option[field.optionImage] && option[field.optionImage].length > 0" style="margin-right: 15px;height: 26px;width: 26px;object-fit: cover;border-radius: 2px;" :src="option[field.optionImage]" alt="">
                <p>{{option[field.optionTextKey]}}</p>
            </div>
        </template>
        <template #option="option">
            <div style="display: flex;align-items: center;">
                <img v-if="field.optionImage && option[field.optionImage] && option[field.optionImage].length > 0" style="margin-right: 15px;height: 26px;width: 26px;object-fit: cover;border-radius: 2px;" :src="option[field.optionImage]" alt="">
                <p>{{option[field.optionTextKey]}}</p>
            </div>
        </template>
    </v-select>
    <span v-else>{{ field.value.map(item => item[relationLabel]).join(',') }}</span>
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

export default {
    components: {vSelect},
    props: ['resourceName', 'field', 'resource'],
    data() {
        return {
            showOptions: false,
            selectedOption: this.field.options.find(opt => opt.id == this.field.value)
        }
    },
    created() {

    },
    methods: {
        change() {
            Nova.request().put(`/api/admin/icons/${this.resource.id.value}`, {
                original_id: this.selectedOption.id
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
