<template>
  <div class="container mx-auto flex justify-center items-center">
    <tw-card :title="$t('reset_password')">
      <form @submit.prevent="reset" @keydown="form.onKeydown($event)">
        <alert-success :form="form" :message="status" />

        <!-- Email -->
        <div class="mt-4">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
          <div class="col-md-7">
            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-input" type="email" name="email" readonly>
            <has-error :form="form" field="email" />
          </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('password') }}</label>
          <div class="col-md-7">
            <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-input" type="password" name="password">
            <has-error :form="form" field="password" />
          </div>
        </div>

        <!-- Password Confirmation -->
        <div class="mt-4">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('confirm_password') }}</label>
          <div class="col-md-7">
            <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-input" type="password" name="password_confirmation">
            <has-error :form="form" field="password_confirmation" />
          </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
          <div class="col-md-9 ml-md-auto">
            <tw-button :loading="form.busy">
              {{ $t('reset_password') }}
            </tw-button>
          </div>
        </div>
      </form>
    </tw-card>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      token: '',
      email: '',
      password: '',
      password_confirmation: ''
    })
  }),

  created () {
    this.form.email = this.$route.query.email
    this.form.token = this.$route.params.token
  },

  methods: {
    async reset () {
      const { data } = await this.form.post('/api/password/reset')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
