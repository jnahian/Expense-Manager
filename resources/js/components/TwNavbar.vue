<template>
  <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6 mb-8">
    <div class="flex items-center flex-no-shrink text-white mr-6">
      <!-- Logo -->
      <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
      <router-link :to="{ name: user ? 'home' : 'welcome' }" class="font-semibold text-xl tracking-tight">{{ appName }}</router-link>
    </div>
    <div class="block sm:hidden">
      <button @click="toggleNav" class="flex items-center px-3 py-2 border rounded text-teal-300 border-teal-light hover:text-white hover:border-white">
        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
      </button>
    </div>
    <div :class="openNav ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">

      <!-- Top nav links -->
      <div class="text-sm sm:flex-grow font-bold">
        <a href="https://laravel.com/docs/5.8" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">Laravel</a>
        <a href="https://vuejs.org/" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">Vue.js</a>
        <a href="https://tailwindcss.com/" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">Tailwind CSS</a>
        <a href="https://github.com/shriker/laravel-vue-spa-tailwind" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">Github</a>
      </div>

      <!-- Authenticated -->
      <div v-if="user" class="bg-grey-lighter flex flex-col md:flex-row justify-between items-start md:items-center">
        <router-link :to="{ name: 'settings.profile' }">
          <img :src="user.photo_url" class="w-10 h-10 rounded-full mt-2 md:mt-0 lg:mt-0" :alt="$t('settings')" :title="$t('settings')">
        </router-link>
        <router-link :to="{ name: 'settings.profile' }" class="text-teal-200 px-2 font-semibold">{{ user.name }}</router-link>
        <a href="#" class="no-underline inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white mt-4 sm:mt-0" @click.prevent="logout"><fa icon="sign-out-alt" fixed-width />{{ $t('logout') }}</a>
      </div>

      <!-- Guest -->
      <template v-else>
        <div class="nav-item mr-4 font-semibold text-white">
          <router-link :to="{ name: 'login' }" class="">
            {{ $t('login') }}
          </router-link>
        </div>
        <div class="nav-item font-semibold text-white">
          <router-link :to="{ name: 'register' }" class="border rounded text-white border-white px-4 py-1 hover:bg-teal-600">
            {{ $t('register') }}
          </router-link>
        </div>
      </template>

    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

  data: () => ({
    appName: window.config.appName,
    openNav: false
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    },
    toggleNav: function() {
      this.openNav = !this.openNav
    }
  }
}
</script>
