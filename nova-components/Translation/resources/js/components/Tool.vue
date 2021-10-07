<template>
    <div>
        <heading class="mb-6">Translation</heading>

        <div class="mb-2">
            <small class="badge">İngilizceleri girilmeyen kelimeler diğer dillerde gözükmeyecektir.</small>
        </div>

        <div class="w-100 py-2 flex mb-2" style="align-items: stretch;justify-content: space-between">
            <div class="flex mr-2" style="align-items: stretch;width: 100%">
                <input class="form-control form-input" style="flex: 2;margin-right: 5px" type="text" v-model="search"
                       placeholder="Search for a message or key">
                <select class="form-control form-select" style="flex:1;margin-right: 5px" v-model="showFilter">
                    <option value="all">All</option>
                    <option value="missings">Only Missings</option>
                </select>

                <select class="form-control form-select" style="flex:1" v-model="selectedLocale">
                    <option v-for="locale in locales" :key="locale.code" :value="locale.code">
                        {{ locale.name }}({{ locale.code }})
                    </option>
                </select>
            </div>

            <div style="flex:1">
                <button class="btn btn-default btn-primary" @click="save">Save</button>
            </div>
        </div>
        <div class="flex w-full" style="align-items: stretch">
            <input type="text" style="flex: 3;margin-right: 5px;" class="form-control form-input" placeholder="New Key" v-model="newKey">
            <input type="text" style="flex: 3;margin-right: 5px;" class="form-control form-input" placeholder="Message(en)" v-model="newKeyMessage">
            <button class="btn btn-default text-white" :disabled="!((newKey && newKey.length > 0) && (newKeyMessage && newKeyMessage.length > 0))"
                    style="background: #39c739;flex: 1" @click="addNew">New
            </button>
        </div>
        <div class="mb-6"></div>

        <div class="flex flex-wrap flex-row translation-messages" style="justify-content: center">
            <div v-for="(_, index) in messagesModel"
                 :key="index" style="flex: 1;min-width: 18rem;max-width: 20px;position: relative"
                 :style="{'display': showMessage(index) ? 'block': 'none'}"
            >
                <div class="card"
                     style="margin-right: 5px;margin-bottom: 5px;position: relative"
                >
                    <p class="delete-message" @click="deleteMessage(messagesModel[index].key)" v-if="selectedLocale === 'en'">X</p>
                    <div class="card-body py-3 d-flex flex-col" style="border: 1px solid #ddd;"
                         :class="{'new-message': !messages[index]}"
                    >
                        <div class="mb-3 d-flex flex-col px-2" v-if="selectedLocale === 'en'">
                            <label>Key</label>
                            <input type="text" placeholder="Key"
                                   class="w-full form-control"
                                   v-model="messagesModel[index].key">
                        </div>
                        <div class="mb-3 d-flex flex-col px-2"
                             v-if="selectedLocale !== 'en' && messagesModel[index].messages['en']">
                            <label>English</label>
                            <p style="padding-left: .75rem; padding-right: .75rem;">
                                {{ messagesModel[index].messages['en'] }}
                            </p>
                        </div>
                        <div class="d-flex flex-col px-2">
                            <label>{{ selectedLocale }}</label>
                            <input type="text" placeholder="Message" class="w-full form-control"
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
            newKeyMessage: null,
            deletedKeys: [],
        }
    },
    methods: {
        save() {
            Nova.request()
                .post(this.apiUrl + 'save', {data: this.messagesModel, deletedKeys: this.deletedKeys})
                .then(() => {
                    this.deletedKeys = []
                    this.$toasted.show('Saved', {type: 'success'});
                    this.messages = JSON.parse(JSON.stringify(this.messagesModel))
                }).catch(error => {
                this.$toasted.show(error, {type: 'error'});
            });
        },
        deleteMessage(key) {
            this.messagesModel = this.messagesModel.filter(msg => msg.key !== key)
            this.deletedKeys.push(key)
        },
        addNew() {
            if (this.messages.find(message => message.key === this.newKey)) {
                return this.$toasted.show('Key already exists', {type: 'error'});
            }
            this.messagesModel.push({
                key: this.newKey,
                messages: {
                    en: this.newKeyMessage
                }
            })
            this.newKey = null
            this.newKeyMessage = null
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

<style lang="scss">
/* Scoped Styles */
.new-message {
    border: 2px solid #8fc15d !important;
}
.badge {
    font-size: 0.75rem;
    background: yellow;
    color: black;
    padding: 2px 10px;
    font-weight: bold;
    border-radius: 4px;
}
.translation-messages {
    label {
        font-size: 1.10rem;
    }
    input {
        font-size: 1rem;
        border-bottom: 1px solid #d6d8da;
        padding-left: 5px;
    }
}
.delete-message {
    position: absolute;
    top: 5px;
    right: 5px;
    font-weight: bold;
    font-size: 0.95rem;
    cursor: pointer;
    color: #f37272;
}
</style>
