<template>
  <div class="container mx-auto flex justify-center items-center">
    <tw-card :title="$t('login')" class="max-w-md">
      <form @submit.prevent="login" @keydown="form.onKeydown($event)">

        <!-- Email -->
        <div class="mt-4">
          <label class="col-md-3 col-form-label text-md-right mb-2" for="email">{{ $t('email') }}</label>
          <div class="col-md-7">
            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-input" type="email" name="email" id="email" placeholder="username@example.com" required autocomplete="email">
            <has-error :form="form" field="email" />
          </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
          <label class="col-md-3 col-form-label text-md-right" for="password">{{ $t('password') }}</label>
          <div class="col-md-7">
            <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-input" type="password" name="password" id="password" required autocomplete="current-password">
            <has-error :form="form" field="password" />
          </div>
        </div>

        <!-- Remember Me -->
        <div class="mt-4">
          <div class="flex items-center justify-between">
            <tw-checkbox v-model="remember" name="remember">{{ $t('remember_me') }}</tw-checkbox>
          </div>
        </div>

        <div class="mt-4 flex flex-col md:flex-row items-start md:items-center justify-between">
          <!-- Submit Button -->
          <tw-button :loading="form.busy">{{ $t('login') }}</tw-button>
          <div class="ml-0 md:ml-2 mb-2"><router-link :to="{ name: 'password.request' }" class="align-baseline font-bold text-gray-600 text-sm no-underline">
            {{ $t('forgot_password') }}
          </router-link></div>

          <!-- GitHub Login Button -->
          <login-with-github />
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
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.$router.push({ name: 'home' })
    }
  }
}
</script>
