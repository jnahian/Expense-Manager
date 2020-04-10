<template>
    <div class="min-h-screen  flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h1 class="mt-6 text-center text-3xl leading-9 font-extrabold text-purple-900">{{appName}}</h1>
            <h2 class="mt-6 text-center text-xl leading-9 font-extrabold text-gray-900">
                {{$t('reset_password')}}
            </h2>
            <p class="mt-2 text-center text-sm leading-5 text-indigo-600 max-w">
                {{$t('Already have account?')}}
                <router-link :to="{name: 'login'}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    {{$t('Login')}}
                </router-link>
            </p>
        </div>


        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <alert-success :form="form" :message="status" class="mb-8"/>

            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form @submit.prevent="reset" @keydown="form.onKeydown($event)">
                    <div>
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                            {{ $t('Email address') }}
                        </label>
                        <div class="mt-1 rounded shadow-sm">
                            <input
                                    id="email"
                                    type="email"
                                    v-model="form.email"
                                    :class="{ 'is-invalid': form.errors.has('email') }"
                                    autocomplete="email"
                                    placeholder="username@example.com"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            />
                            <form-error :form="form" field="email"/>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                            {{ $t('password') }}
                        </label>
                        <div class="mt-1 rounded shadow-sm">
                            <input
                                    id="password"
                                    type="password"
                                    v-model="form.password"
                                    :class="{ 'is-invalid': form.errors.has('password') }"
                                    autocomplete="current-password"
                                    :placeholder="$t('password')"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            />
                            <form-error :form="form" field="password"/>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                            {{ $t('confirm_password') }}
                        </label>
                        <div class="mt-1 rounded shadow-sm">
                            <input
                                    id="password_confirmation"
                                    type="password"
                                    v-model="form.password_confirmation"
                                    :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                                    autocomplete="current-password_confirmation"
                                    :placeholder="$t('confirm_password')"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            />
                            <form-error :form="form" field="password_confirmation"/>
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded shadow-sm">
                            <submit-button :loading="form.busy">{{ $t('reset_password') }}</submit-button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from 'vform'
    import basic from "../../../layouts/basic";

    export default {
        layout: 'basic',
        middleware: 'guest',

        components: {
            basic
        },

        metaInfo() {
            return {title: this.$t('reset_password')}
        },

        data: () => ({
            appName: window.config.appName,
            status: '',
            form: new Form({
                token: '',
                email: '',
                password: '',
                password_confirmation: ''
            })
        }),

        created() {
            this.form.email = this.$route.query.email;
            this.form.token = this.$route.params.token
        },

        methods: {
            async reset() {
                const {data} = await this.form.post('/api/password/reset');

                this.status = data.status;

                this.form.reset()
            }
        }
    }
</script>
