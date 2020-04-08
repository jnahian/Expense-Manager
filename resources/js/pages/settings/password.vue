<template>
  <tw-card :title="$t('your_password')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('password_updated')" />

      <!-- Current (old) Password -->
      <div class="mt-4">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('password') }}</label>
        <div class="col-md-7">
          <input v-model="form.old_password" :class="{ 'is-invalid': form.errors.has('old_password') }" class="form-input" type="password" name="old_password" autocomplete="current-password">
          <has-error :form="form" field="old_password" />
        </div>
      </div>

      <!-- Password -->
      <div class="mt-4">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('new_password') }}</label>
        <div class="col-md-7">
          <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-input" type="password" name="password" autocomplete="new-password">
          <has-error :form="form" field="password" />
        </div>
      </div>

      <!-- Password Confirmation -->
      <div class="mt-4">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('confirm_password') }}</label>
        <div class="col-md-7">
          <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-input" type="password" name="password_confirmation" autocomplete="new-password">
          <has-error :form="form" field="password_confirmation" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="mt-4">
        <div class="col-md-9 ml-md-auto">
          <tw-button :loading="form.busy">
            {{ $t('update') }}
          </tw-button>
        </div>
      </div>
    </form>
  </tw-card>
</template>

<script>
import Form from 'vform'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      old_password: '',
      password: '',
      password_confirmation: ''
    })
  }),

  methods: {
    async update () {
      await this.form.patch('/api/settings/password')

      this.form.reset()
    }
  }
}
</script>
