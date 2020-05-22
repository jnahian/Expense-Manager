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
                    class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6 relative"
                    v-show="show"
                    role="dialog"
                    v-click-outside="closeModal"
            >
                <content-loader :show="contentLoading"/>
                <form @submit.prevent="saveOrUpdate" @keydown="form.onKeydown($event)">
                    <h3 class="text-lg leading-6 font-medium text-center text-gray-900" id="modal-headline">{{title}}</h3>

                    <div class="mt-3 sm:mt-5">
                        <label>{{$t('Account')}} <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative flex flex-wrap">
                            <div
                                    v-if="meta.accounts.length"
                                    v-for="account in meta.accounts" :key="account.id"
                                    class="w-1/2 px-1 mb-2"
                            >
                                <div class="flex items-center">
                                    <input
                                            :id="`transaction-account-${account.id}`"
                                            v-model="form.account"
                                            :value="account.id"
                                            :class="{'error' : form.errors.has('account')}"
                                            type="radio"
                                            class="form-radio hidden h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                    <label
                                            :for="`transaction-account-${account.id}`"
                                            class="w-full p-2 border border-gray-300 rounded bg-gray-100 cursor-pointer"
                                            :class="{'bg-green-200 border-green-500' : account.id === form.account}"
                                    >
                                        <span class="block text-sm leading-5 font-medium text-gray-700">{{account.name}}</span>
                                        <span class="block text-green-500 font-medium text-sm">{{$t('Bal')}}: {{account.balance}}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <form-error :form="form" field="account"/>
                    </div>

                    <div class="mt-3 sm:mt-5">
                        <label for="date">{{$t('Transaction Date')}} <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <datetime
                                    id="date"
                                    v-model="form.date"
                                    placeholder='dd/mm/yyyy'
                                    format="dd/MM/yyyy"
                                    input-class="form-default"
                            ></datetime>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <calender-icon classNames="h-5 w-5" fill="#999"/>
                            </div>
                        </div>
                        <form-error :form="form" field="date"/>
                    </div>

                    <div class="mt-3 sm:mt-5">
                        <label>{{$t('Transaction Type')}} <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative flex">
                            <div class="mt-2 mr-4" v-if="meta.types.length" v-for="type in meta.types" :key="type.id">
                                <div class="flex items-center">
                                    <input
                                            :id="`transaction-type-${type.id}`"
                                            v-model="form.type"
                                            :value="type.id"
                                            :class="{'error' : form.errors.has('type')}"
                                            type="radio"
                                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                    <label :for="`transaction-type-${type.id}`" class="ml-3">
                                        <span class="block text-sm leading-5 font-medium text-gray-700 cursor-pointer">{{type.name}}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <form-error :form="form" field="type"/>
                    </div>

                    <div class="mt-3 sm:mt-5">
                        <label for="amount">{{$t('Amount')}} <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative">
                            <input id="amount"
                                   type="number"
                                   :class="{'error' : form.errors.has('amount')}"
                                   v-model="form.amount"
                                   class="form-default"
                                   :placeholder="$t('Amount')"
                            />
                            <form-error-icon :form="form" field="amount"/>
                        </div>
                        <form-error :form="form" field="amount"/>
                    </div>

                    <div class="mt-3 sm:mt-5">
                        <label for="desc">{{$t('Details')}}</label>

                        <div class="mt-1 relative">
                            <textarea id="desc" v-model="form.desc" class="form-default" :placeholder="$t('Details')"/>
                            <form-error-icon :form="form" field="desc"/>
                        </div>
                        <form-error :form="form" field="desc"/>
                    </div>

                    <div class="mt-3 sm:mt-5">
                        <label>{{$t('Status')}} <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative flex">
                            <div class="mt-2 mr-4" v-if="meta.status.length" v-for="status in meta.status" :key="status.id">
                                <div class="flex items-center">
                                    <input
                                            :id="`status-${status.id}`"
                                            v-model="form.status"
                                            :value="status.id"
                                            :class="{'error' : form.errors.has('status')}"
                                            type="radio"
                                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                    <label :for="`status-${status.id}`" class="ml-3">
                                        <span class="block text-sm leading-5 font-medium text-gray-700 cursor-pointer">{{status.name}}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <form-error :form="form" field="status"/>
                    </div>

                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        <span class="flex w-full sm:col-start-2">
                            <submit-button :loading="form.busy">
                                {{!editMode ? $t('Save') : $t('Update')}}
                            </submit-button>
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
    import ContentLoader from "../../components/_partials/ContentLoader";
    import CalenderIcon from "../../components/_elements/CalenderIcon";
    import {Datetime} from 'vue-datetime';
    import 'vue-datetime/dist/vue-datetime.css';

    export default {
        name: "ModalCreate",
        props: ['transaction', 'show', 'meta'],
        components: {Datetime, CalenderIcon, ContentLoader, InfoMessage, FormErrorIcon},
        metaInfo() {
            return {title: this.$t(this.title)}
        },
        data: () => ({
            contentLoading: false,
            form: new Form({
                account: '',
                date: '',
                type: 'E',
                amount: null,
                desc: '',
                status: 1,
            }),
        }),
        computed: {
            editMode() {
                return !!this.transaction;
            },
            title() {
                return (!this.editMode ? this.$t('Add New') : this.$t('Update')) + ' ' + this.$t('Transaction');
            }
        },
        methods: {
            closeModal() {
                this.$emit('close');
            },
            async saveOrUpdate() {
                this.contentLoading = true;
                try {
                    if (!this.editMode) {
                        let {data: {message}} = await this.form.post('/api/transaction');
                        this.$toast.success(this.$t(message));
                    } else {
                        let {data: {message}} = await this.form.put(`/api/transaction/${this.transaction.id}`);
                        this.$toast.success(this.$t(message));
                    }

                    this.$emit('saved');
                    this.closeModal();
                } catch (e) {
                    this.showErrorMessage(e);
                }
                this.contentLoading = false;
            }
        },

        created() {
            if (this.transaction) {
                this.form.account = this.transaction.account.id;
                this.form.date = this.transaction.date;
                this.form.type = this.transaction.type.id;
                this.form.amount = this.transaction.amount;
                this.form.desc = this.transaction.desc;
                this.form.status = this.transaction.status.id;
            }
        }
    }
</script>

<style scoped>

</style>
