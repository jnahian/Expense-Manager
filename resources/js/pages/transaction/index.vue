<template>
    <div>
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        {{$t('Transactions')}}
                    </h2>
                    <p>{{$t('List of transactions')}}</p>
                </div>
                <div class="flex md:mt-0 md:ml-4">
                    <a href="javascript:"
                       class="button button-purple"
                       @click.prevent="showModal"
                    >
                        <span class="icon"><fa icon="plus"></fa></span>
                        {{$t('Add New Transaction')}}
                    </a>
                </div>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 relative">
                    <content-loader :show="contentLoading"/>
                    <table class="min-w-full">
                        <thead class="bg-white">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 capitalize tracking-wider w-2/12">
                                {{$t('Account')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 capitalize tracking-wider w-2/12">
                                {{$t('Date')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 capitalize tracking-wider w-3/12">
                                {{$t('Transaction Type')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 capitalize tracking-wider w-2/12">
                                {{$t('Balance')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 capitalize tracking-wider w-2/12">
                                {{$t('Last Update')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 capitalize tracking-wider w-1/12">
                                {{$t('Status')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 capitalize tracking-wider w-2/12">
                                {{$t('Actions')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white" v-if="transactions.length">
                        <tr v-for="(transaction, key) in transactions">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{transaction.account.name}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{transaction.date_formatted}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{transaction.type.name}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{transaction.amount_converted}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{transaction.updated_at}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="label"
                                      :class="{
                                          'success' : transaction.status.id == 1,
                                          'danger' : transaction.status.id == 9
                                      }"
                                >
                                    {{transaction.status.name}}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 leading-5 font-medium">
                                <action-button
                                        title="edit"
                                        icon="pencil-alt"
                                        type="info"
                                        @click="editModal(transaction)"
                                />
                                <action-button
                                        title="delete"
                                        icon="trash"
                                        type="danger"
                                        @click="deleteTransaction(transaction, key)"
                                />
                            </td>
                        </tr>
                        </tbody>
                    </table else>
                </div>
            </div>
        </div>

        <modal-create
                v-if="showCreateModal"
                :transaction="editTransaction"
                :meta="transactionMeta"
                :show="showCreateModal"
                @close="hideModal"
                @saved="getData"
        />
    </div>
</template>

<script>
    import Form from 'vform'
    import ModalCreate from "./ModalCreate";
    import ContentLoader from "../../components/_partials/ContentLoader";

    export default {
        middleware: 'auth',
        components: {ContentLoader, ModalCreate},
        metaInfo() {
            return {title: this.$t('Transactions')}
        },
        data() {
            return {
                transactions: [],
                form: new Form({}),
                showCreateModal: false,
                transactionMeta: [],
                editTransaction: null,
                contentLoading: true,
            }
        },
        computed: {},

        methods: {
            async getData() {
                this.contentLoading = true;
                let {data: {data: transactions}} = await this.form.get('/api/transaction');
                this.transactions = transactions;
                this.contentLoading = false;
            },

            async deleteTransaction(transaction, key) {
                try {
                    let res = await this.$dialog.confirm({
                        title: this.$t('Are you sure?'),
                        body: this.$t('You want to delete this item.'),
                    });

                    if (res !== false) {
                        let {data: {message}} = await this.form.delete(`/api/transaction/${transaction.id}`);
                        this.$toast.success(this.$t(message));
                        await this.getData();
                    }
                } catch (e) {
                    console.log(e);
                }
            },

            showModal() {
                this.showCreateModal = true;
            },

            editModal(transaction) {
                this.editTransaction = transaction;
                this.showModal();
            },
            hideModal() {
                this.editTransaction = null;
                this.showCreateModal = false;
            },
            async getTransactionMeta() {
                let {data} = await this.form.get('/api/transaction/meta');
                this.transactionMeta = data.data;
            },
        },
        async created() {
            await this.getData();
            await this.getTransactionMeta();
            // this.$toast.warning('hellow man, what\'s up', {
            //     duration: 100000
            // });
        }
    }
</script>
