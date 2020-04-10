<template>
    <div class="min-h-screen  flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h1 class="mt-6 text-center text-3xl leading-9 font-extrabold text-purple-900">{{appName}}</h1>
            <h2 class="mt-6 text-center text-xl leading-9 font-extrabold text-gray-900">
                {{$t('reset_password')}}
            </h2>
            <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
                Or
                <router-link :to="{name: 'login'}"
                             class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    {{$t('login')}}
                </router-link>
            </p>
        </div>


        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <alert-success :form="form" :message="status" class="mb-8" />

            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form @submit.prevent="send" @keydown="form.onKeydown($event)">
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
                        <span class="block w-full rounded shadow-sm">
                            <submit-button :loading="form.busy">{{ $t('send_password_reset_link') }}</submit-button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import basic from "../../../layouts/basic";
    import Form from "vform";

    export default {
        layout: 'basic',
        middleware: 'guest',
        components: {},
        metaInfo() {
            return {title: this.$t('reset_password')}
        },

        data: () => ({
            appName: window.config.appName,
            status: '',
            form: new Form({
                email: ''
            })
        }),

        methods: {
            async send() {
                const {data} = await this.form.post('/api/password/email');

                this.status = data.status;

                this.form.reset()
            }
        }
    }
</script>
