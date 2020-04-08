<template>
  <div class="container mx-auto flex justify-center items-center">
    <tw-card :title="$t('reset_password')">
      <form @submit.prevent="send" @keydown="form.onKeydown($event)">
        <alert-success :form="form" :message="status" />

        <!-- Email -->
        <div class="mt-4">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
          <div class="col-md-7">
            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-input" type="email" name="email">
            <has-error :form="form" field="email" />
          </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
          <div class="col-md-9 ml-md-auto">
            <tw-button :loading="form.busy">
              {{ $t('send_password_reset_link') }}
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
      email: ''
    })
  }),

  methods: {
    async send () {
      const { data } = await this.form.post('/api/password/email')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
