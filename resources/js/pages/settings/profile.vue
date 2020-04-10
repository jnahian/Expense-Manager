<template>
    <div class="py-4">
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-4 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{$t('your_info')}}</h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            Use a permanent address where you can receive mail.
                        </p>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <alert-success :form="form" :message="$t('info_updated')" class="mb-6"/>
                    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
                        <div class="shadow overflow-hidden rounded">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-1 gap-6">
                                    <div class="col-span-1 sm:col-span-1">
                                        <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Name</label>
                                        <input id="name" v-model="form.name"
                                               class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                        <form-error :form="form" field="name"/>
                                    </div>

                                    <div class="col-span-1 sm:col-span-1">
                                        <label for="email_address" class="block text-sm font-medium leading-5 text-gray-700">Email address</label>
                                        <input id="email_address" v-model="form.email"
                                               class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                        <form-error :form="form" field="email"/>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <submit-button :block="false" :loading="form.busy">
                                    {{ $t('update') }}
                                </submit-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from 'vform'
    import {mapGetters} from 'vuex'

    export default {
        scrollToTop: false,

        metaInfo() {
            return {title: this.$t('settings')}
        },

        data: () => ({
            form: new Form({
                name: '',
                email: ''
            })
        }),

        computed: mapGetters({
            user: 'auth/user'
        }),

        created() {
            // Fill the form with user data.
            this.form.keys().forEach(key => {
                this.form[key] = this.user[key]
            })
        },

        methods: {
            async update() {
                const {data} = await this.form.patch('/api/settings/profile');

                this.$store.dispatch('auth/updateUser', {user: data})
            }
        }
    }
</script>
