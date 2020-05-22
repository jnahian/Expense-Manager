<template>
    <div class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center" v-if="show">
        <transition
                enter-active-class="ease-out duration-300"
                enter-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="ease-in duration-200"
                leave-class="opacity-100"
                leave-to-class="opacity-0"
        >
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-800 opacity-75" v-show="show"></div>
            </div>
        </transition>

        <transition
                enter-active-class="ease-out duration-300"
                enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                leave-active-class="ease-in duration-200"
                leave-class="opacity-100 translate-y-0 sm:scale-100"
                leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            <div
                    class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6"
                    v-show="show"
                    role="dialog"
                    v-click-outside="closeModal"
            >
                <form @submit.prevent="saveOrUpdate" @keydown="form.onKeydown($event)">
                    <h3 class="text-lg leading-6 font-medium text-center text-gray-900" id="modal-headline">{{title}}</h3>
                    <div class="mt-3 sm:mt-5">
                        <label for="name">{{$t('Account Name')}} <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative">
                            <input id="name"
                                   type="text"
                                   v-model="form.name"
                                   class="form-default"
                                   :class="{'error' : form.errors.has('name')}"
                                   :placeholder="$t('Account Name')"
                            />
                            <form-error-icon :form="form" field="name"/>
                        </div>
                        <form-error :form="form" field="name"/>
                    </div>

                    <div class="mt-3 sm:mt-5">
                        <label for="name">{{$t('Account Type')}} <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative flex">
                            <div class="mt-2 mr-4" v-if="accountTypes.length" v-for="type in accountTypes" :key="type.id">
                                <div class="flex items-center">
                                    <input
                                            :id="`account-type-${type.id}`"
                                            v-model="form.type"
                                            :value="type.id"
                                            :class="{'error' : form.errors.has('type')}"
                                            type="radio"
                                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                    <label :for="`account-type-${type.id}`" class="ml-3">
                                        <span class="block text-sm leading-5 font-medium text-gray-700 cursor-pointer">{{type.name}}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <form-error :form="form" field="type"/>
                    </div>

                    <div class="mt-3 sm:mt-5">
                        <label for="balance">{{$t('Initial Balance')}} <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative">
                            <input id="balance"
                                   type="number"
                                   :class="{'error' : form.errors.has('balance')}"
                                   v-model="form.balance"
                                   class="form-default"
                                   :placeholder="$t('Initial Balance')"
                                   :disabled="editMode"
                            />
                            <form-error-icon :form="form" field="balance"/>
                        </div>
                        <info-message v-if="editMode" msg="Not editable"/>
                        <form-error :form="form" field="balance"/>
                    </div>

                    <div class="mt-3 sm:mt-5">
                        <label for="name">{{$t('Status')}} <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative flex">
                            <div class="mt-2 mr-4">
                                <div class="flex items-center">
                                    <input
                                            id="active"
                                            v-model="form.status"
                                            value="1"
                                            type="radio"
                                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                    <label for="active" class="ml-3">
                                        <span class="block text-sm leading-5 font-medium text-gray-700 cursor-pointer">{{$t('Active')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-2 mr-4">
                                <div class="flex items-center">
                                    <input
                                            id="disabled"
                                            v-model="form.status"
                                            value="9"
                                            type="radio"
                                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                    <label for="disabled" class="ml-3">
                                        <span class="block text-sm leading-5 font-medium text-gray-700 cursor-pointer">{{$t('Disabled')}}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <form-error :form="form" field="type"/>
                    </div>

                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        <span class="flex w-full sm:col-start-2">
                            <submit-button>{{!editMode ? $t('Save') : $t('Update')}}</submit-button>
                        </span>
                        <span class="mt-3 flex w-full sm:mt-0 sm:col-start-1">
                            <button type="button"
                                    @click="closeModal"
                                    class="inline-flex justify-center w-full rounded-md border bg-gray-300 border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                              {{$t('Cancel')}}
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </transition>
    </div>
</template>

<script>
    import Form from "vform";
    import FormErrorIcon from "../../components/_elements/FormErrorIcon";
    import InfoMessage from "../../components/_elements/InfoMessage";

    export default {
        name: "ModalCreate",
        props: ['account', 'show', 'accountTypes'],
        components: {InfoMessage, FormErrorIcon},
        metaInfo() {
            return {title: this.$t(this.title)}
        },
        data: () => ({
            form: new Form({
                name: '',
                type: '',
                balance: null,
                status: ''
            }),
        }),
        computed: {
            editMode() {
                return !!this.account;
            },
            title() {
                return (!this.editMode ? this.$t('Add New') : this.$t('Update')) + ' ' + this.$t('Account');
            }
        },
        methods: {
            closeModal() {
                this.$emit('close');
            },
            async saveOrUpdate() {
                try {
                    if (!this.editMode) {
                        let {data: {message}} = await this.form.post('/api/account');
                        this.$toast.success(this.$t(message));
                    } else {
                        let {data: {message}} = await this.form.put(`/api/account/${this.account.id}`);
                        this.$toast.success(this.$t(message));
                    }

                    this.$emit('saved');
                    this.closeModal();
                } catch (e) {
                    this.showErrorMessage(e);
                }

            }
        },

        created() {
            if (this.account) {
                this.form.name = this.account.name;
                this.form.type = this.account.type.id;
                this.form.status = this.account.status.id;
                this.form.balance = this.account.balance;
            }
        }
    }
</script>

<style scoped>

</style>
