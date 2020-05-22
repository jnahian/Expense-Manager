<template>
    <div>
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        {{$t('Add income')}}
                    </h2>
                    <p>{{$t('Add new incomes form')}}</p>
                </div>
                <div class="flex md:mt-0 md:ml-4">
                    <router-link :to="{name: 'income'}" class="button button-purple">
                        <span class="icon"><fa icon="list"></fa></span>
                        {{$t('Incomes')}}
                    </router-link>
                </div>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <form @submit.prevent="save" @keydown="form.onKeydown($event)">
                    <div class="shadow overflow-hidden rounded">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="col-span-1 sm:col-span-1">
                                    <label for="date" class="block text-sm font-medium leading-5 text-gray-700">{{$t('Date')}}</label>
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

                                <div class="col-span-1 sm:col-span-1">
                                    <label for="source" class="block text-sm font-medium leading-5 text-gray-700">{{$t('Source of Income')}}</label>
                                    <input id="source" v-model="form.source" type="text" class="form-default" :placeholder="$t('Source of Income')"/>
                                    <form-error :form="form" field="source"/>
                                </div>

                                <div class="col-span-1 sm:col-span-1">
                                    <label for="amount" class="block text-sm font-medium leading-5 text-gray-700">{{$t('Amount')}}</label>
                                    <input id="amount" v-model="form.amount" type="number" class="form-default" :placeholder="$t('Amount')"/>
                                    <form-error :form="form" field="amount"/>
                                </div>

                                <div class="col-span-1 sm:col-span-2">
                                    <label for="remarks" class="block text-sm font-medium leading-5 text-gray-700">{{$t('Remarks')}}</label>
                                    <textarea id="remarks" v-model="form.remarks" class="form-default" :placeholder="$t('Remarks')"/>
                                    <form-error :form="form" field="remarks"/>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-100 text-right sm:px-6">
                            <submit-button :block="false" :loading="form.busy">
                                {{ $t('save') }}
                            </submit-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from 'vform'
    import {mapGetters} from 'vuex'
    import CalenderIcon from "../../components/_elements/CalenderIcon";
    import {Datetime} from 'vue-datetime';
    import 'vue-datetime/dist/vue-datetime.css';

    export default {
        components: {CalenderIcon, Datetime},
        scrollToTop: false,

        metaInfo() {
            return {title: this.$t('Add Income')}
        },

        data: () => ({
            form: new Form({
                date: new Date(),
                source: '',
                amount: '',
                remarks: '',
            }),
            dateAttributes: [
                {
                    key: 'today',
                    highlight: true,
                    dates: new Date()
                }
            ]
        }),

        computed: mapGetters({
            user: 'auth/user'
        }),

        methods: {
            async save() {
                let {data} = await this.form.post('/api/income');
                this.$toast.success(this.$t('Income saved successfully.'));
                this.$router.push({name: 'income'});
            }
        }
    }
</script>
