<template>
    <div>
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        {{$t('Income')}}
                    </h2>
                    <p>{{$t('List of incomes')}}</p>
                </div>
                <div class="flex md:mt-0 md:ml-4">
                      <router-link :to="{name: 'income.create'}" class="button button-purple">
                          <span class="icon"><fa icon="plus"></fa></span>
                          {{$t('Add New Income')}}
                      </router-link>
                </div>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-white">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 uppercase tracking-wider w-1/12">
                                {{$t('Date')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 uppercase tracking-wider w-3/12">
                                {{$t('Source')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 uppercase tracking-wider w-4/12">
                                {{$t('Remarks')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 uppercase tracking-wider w-2/12">
                                {{$t('Amount')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 uppercase tracking-wider w-1/12">
                                {{$t('Actions')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white" v-if="incomes.length">
                        <tr v-for="(income, key) in incomes">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{income.date}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{income.source}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{income.remarks}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{income.amount}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 leading-5 font-medium">
                                <action-button
                                        :action="{name: 'income.edit', params: {id: income.id}}"
                                        title="edit"
                                        icon="pencil-alt"
                                        type="info"
                                />
                                <action-button
                                        title="delete"
                                        icon="trash"
                                        type="danger"
                                        @click="deleteIncome(income, key)"
                                />
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from 'vform'

    export default {
        middleware: 'auth',
        components: {},
        data() {
            return {
                incomes: [],
                form: new Form({}),
            }
        },
        computed: {},

        methods: {
            async getData() {
                let {data} = await this.form.get('/api/income');
                this.incomes = data;
            },

            deleteIncome(income, key) {
                this.$vueConfirm.confirm(
                    {
                        message: `Are you sure?`,
                    },
                    function(confirm) {
                        if (confirm == true) {
                            console.log(income, key);
                        }
                    }
                )
            }
        },
        async created() {
            await this.getData();
            // this.$toast.warning('hellow man, what\'s up');
        }
    }
</script>
