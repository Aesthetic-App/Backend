<template>
    <div>
        <heading class="mb-6">Translation</heading>

        <div class="py-2 flex" style="align-items: center;justify-content: space-between">
            <div class="d-flex">
                <input class="form-control form-input" style="flex: 1" type="text" v-model="search"
                       placeholder="Search for a message or key">
                <select class="form-control form-select" v-model="showFilter">
                    <option value="all">All</option>
                    <option value="missings">Only Missings</option>
                </select>

                <select class="form-control form-select" v-model="selectedLocale">
                    <option v-for="locale in locales" :key="locale.code" :value="locale.code">
                        {{ locale.language }}({{ locale.code }})
                    </option>
                </select>
            </div>

            <div>
                <input type="text" class="form-control form-input" placeholder="New Key" v-model="newKey">
                <button class="btn btn-default text-white" :disabled="!newKey || newKey.length < 1"
                        style="background: #39c739;" @click="addNew">New
                </button>
                <button class="btn btn-default btn-primary" @click="save">Save</button>
            </div>
        </div>

        <div class="flex flex-wrap flex-row">
            <div v-for="(_, index) in messagesModel"
                 :key="index" style="flex: 1;min-width: 18rem;max-width: 20px"
                 :style="{'display': showMessage(index) ? 'block': 'none'}"
            >
                <div class="card"
                     style="margin-right: 5px;margin-bottom: 5px"
                >
                    <div class="card-body py-3 d-flex flex-col" style="border: 1px solid #ddd;"
                         :class="{'new-message': !messages[index]}"
                    >
                        <div class="mb-3 d-flex flex-col px-2" v-if="selectedLocale === 'en'">
                            <label class="font-bold">Key</label>
                            <input type="text" placeholder="Key"
                                   class="w-full form-control form-input"
                                   v-model="messagesModel[index].key">
                        </div>
                        <div class="mb-3 d-flex flex-col px-2"
                             v-if="selectedLocale !== 'en' && messagesModel[index].messages['en']">
                            <label class="font-bold">English</label>
                            <p style="padding-left: .75rem; padding-right: .75rem;">
                                {{ messagesModel[index].messages['en'] }}
                            </p>
                        </div>
                        <div class="d-flex flex-col px-2">
                            <label class="font-bold">{{ selectedLocale }}</label>
                            <input type="text" placeholder="Message" class="w-full form-control form-input"
                                   v-model="messagesModel[index].messages[selectedLocale]">
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="clearfix"></div>
    </div>
</template>

<script>
import SelectButton from 'primevue/selectbutton';

export default {
    components: {
        SelectButton,
    },
    metaInfo() {
        return {
            title: 'Translation',
        }
    },
    data() {
        return {
            apiUrl: '/nova-vendor/translation-editor/',
            locales: [],
            messages: [],
            messagesModel: [],
            loaded: false,
            selectedLocale: 'en',
            search: null,
            showFilter: 'all',
            newKey: null,
        }
    },
    methods: {
        save() {
            Nova.request()
                .post(this.apiUrl + 'save', {data: this.messagesModel})
                .then(() => {
                    this.$toasted.show('Saved', {type: 'success'});
                    this.messages = JSON.parse(JSON.stringify(this.messagesModel))
                }).catch(error => {
                this.$toasted.show(error, {type: 'error'});
            });
        },
        addNew() {
            if (this.messages.find(message => message.key === this.newKey)) {
                return this.$toasted.show('Key already exists', {type: 'error'});
            }
            this.messagesModel.push({
                key: this.newKey,
                messages: {}
            })
            this.newKey = null
        },
        showMessage(index) {
            if (!this.messages[index]) {
                return true;
            }
            const key = this.messages[index].key.toLowerCase()
            const message = this.messages[index].messages[this.selectedLocale]

            if (this.selectedLocale !== 'en' && !this.messagesModel[index].messages['en']) {
                return false;
            }

            if (this.showFilter === 'missings' && message !== undefined) {
                return false;
            }

            if (this.search) {
                if (!message) {
                    return false;
                }
                if (!(message.toLowerCase().includes(this.search.toLowerCase()) || key.includes(this.search.toLowerCase()))) {
                    return false;
                }
            }

            return true;
        }
    },
    mounted() {
        Nova.request().get(this.apiUrl + 'index').then(response => {
            this.loaded = true;
            if (response.data && response.data.messages) {
                this.messages = response.data.messages;
                this.messagesModel = JSON.parse(JSON.stringify(response.data.messages))
                this.locales = response.data.locales;
            }
        });
    },
}
</script>

<style>
/* Scoped Styles */
.new-message {
    border: 2px solid #8fc15d !important;
}
</style>
