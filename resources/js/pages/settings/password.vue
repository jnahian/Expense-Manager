<template>
    <div class="py-4">
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-4 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{$t('your_password')}}</h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            Change your password here
                        </p>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <alert-success :form="form" :message="$t('password_updated')" class="mb-6"/>
                    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
                        <div class="shadow overflow-hidden rounded">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-1 gap-6">
                                    <div class="col-span-1 sm:col-span-1">
                                        <label for="old_password" class="block text-sm font-medium leading-5 text-gray-700">{{ $t('password') }}</label>
                                        <input id="old_password" v-model="form.old_password" type="password" :class="{'is-invalid' : form.errors.has('old_password')}"
                                               class="form-default"/>
                                        <form-error :form="form" field="old_password"/>
                                    </div>
                                    <div class="col-span-1 sm:col-span-1">
                                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">{{ $t('new_password') }}</label>
                                        <input id="password" v-model="form.password" type="password" :class="{'is-invalid' : form.errors.has('password')}"
                                               class="form-default"/>
                                        <form-error :form="form" field="password"/>
                                    </div>
                                    <div class="col-span-1 sm:col-span-1">
                                        <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">{{ $t('confirm_password') }}</label>
                                        <input id="password_confirmation" v-model="form.password_confirmation" type="password" :class="{'is-invalid' : form.errors.has('password_confirmation')}"
                                               class="form-default"/>
                                        <form-error :form="form" field="password_confirmation"/>
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

    export default {
        scrollToTop: false,

        metaInfo() {
            return {title: this.$t('settings')}
        },

        data: () => ({
            form: new Form({
                old_password: '',
                password: '',
                password_confirmation: ''
            })
        }),

        methods: {
            async update() {
                await this.form.patch('/api/settings/password');

                this.form.reset()
            }
        }
    }
</script>
