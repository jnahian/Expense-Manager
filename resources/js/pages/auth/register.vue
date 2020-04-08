<template>
  <div class="container mx-auto flex justify-center items-center">
    <tw-card v-if="mustVerifyEmail" :title="$t('register')">
      <div class="alert alert-success" role="alert">
        {{ $t('verify_email_address') }}
      </div>
    </tw-card>
    <tw-card v-else :title="$t('register')">
      <form @submit.prevent="register" @keydown="form.onKeydown($event)">

        <!-- Name -->
        <div class="mt-4">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
          <div class="col-md-7">
            <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-input" type="text" name="name" required autocomplete="username">
            <has-error :form="form" field="name" />
          </div>
        </div>

        <!-- Email -->
        <div class="mt-4">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
          <div class="col-md-7">
            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-input" type="email" name="email" required autocomplete="email">
            <has-error :form="form" field="email" />
          </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('password') }}</label>
          <div class="col-md-7">
            <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-input" type="password" name="password" required autocomplete="new-password">
            <has-error :form="form" field="password" />
          </div>
        </div>

        <!-- Password Confirmation -->
        <div class="mt-4">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('confirm_password') }}</label>
          <div class="col-md-7">
            <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-input" type="password" required name="password_confirmation" autocomplete="new-password">
            <has-error :form="form" field="password_confirmation" />
          </div>
        </div>

        <div class="mt-4">
          <div class="col-md-7 offset-md-3 d-flex">
            <!-- Submit Button -->
            <tw-button :loading="form.busy">
              {{ $t('register') }}
            </tw-button>

            <!-- GitHub Register Button -->
            <login-with-github />
          </div>
        </div>
      </form>
    </tw-card>
  </div>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  middleware: 'guest',

  components: {
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
