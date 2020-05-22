<template>
    <div>
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        {{$t('Accounts')}}
                    </h2>
                    <p>{{$t('List of accounts')}}</p>
                </div>
                <div class="flex md:mt-0 md:ml-4">
                    <a href="javascript:"
                       class="button button-purple"
                       @click.prevent="showModal"
                    >
                        <span class="icon"><fa icon="plus"></fa></span>
                        {{$t('Add New Account')}}
                    </a>
                </div>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-white">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 capitalize tracking-wider w-4/12">
                                {{$t('Account Name')}}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left leading-4 font-medium text-gray-500 capitalize tracking-wider w-3/12">
                                {{$t('Account Type')}}
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
                        <tbody class="bg-white" v-if="accounts.length">
                        <tr v-for="(account, key) in accounts">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{account.name}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{account.type.name}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{account.balance_converted}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{account.updated_at}}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="label"
                                      :class="{
                                          'success' : account.status.id == 1,
                                          'danger' : account.status.id == 9
                                      }"
                                >
                                    {{account.status.name}}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 leading-5 font-medium">
                                <action-button
                                        title="edit"
                                        icon="pencil-alt"
                                        type="info"
                                        @click="editModal(account)"
                                />
                                <action-button
                                        title="delete"
                                        icon="trash"
                                        type="danger"
                                        @click="deleteAccount(account, key)"
                                />
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <modal-create
                v-if="showCreateModal"
                :account="editAccount"
                :account-types="accountTypes"
                :show="showCreateModal"
                @close="hideModal"
                @saved="getData"
        />
    </div>
</template>

<script>
    import Form from 'vform'
    import ModalCreate from "./ModalCreate";

    export default {
        middleware: 'auth',
        components: {ModalCreate},
        metaInfo() {
            return {title: this.$t('Accounts')}
        },
        data() {
            return {
                accounts: [],
                form: new Form({}),
                showCreateModal: false,
                accountTypes: [],
                editAccount: null,
            }
        },
        computed: {},

        methods: {
            async getData() {
                let {data: {data: accounts}} = await this.form.get('/api/account');
                this.accounts = accounts;
            },

            async deleteAccount(account, key) {
                try {
                    let res = await this.$dialog.confirm({
                        title: this.$t('Are you sure?'),
                        body: this.$t('You want to delete this item.'),
                    });

                    if (res !== false) {
                        let {data: {message}} = await this.form.delete(`/api/account/${account.id}`);
                        this.$toast.success(this.$t(message));
                        this.getData();
                    }
                } catch (e) {
                    console.log(e);
                }
            },

            showModal() {
                this.showCreateModal = true;
            },

            editModal(account) {
                this.editAccount = account;
                this.showModal();
            },
            hideModal() {
                this.editAccount = null;
                this.showCreateModal = false;
            },
            async getAccountTypes() {
                let {data} = await this.form.get('/api/account/types');
                this.accountTypes = data.data;
            },
        },
        async created() {
            await this.getData();
            await this.getAccountTypes();
            // this.$toast.warning('hellow man, what\'s up', {
            //     duration: 100000
            // });
        }
    }
</script>
