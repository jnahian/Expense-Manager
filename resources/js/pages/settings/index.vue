<template>
  <div class="container mx-auto">
    
    <tw-card :title="$t('settings')" class="settings-card">
      <tw-nav-tabs :tabs="tabs"></tw-nav-tabs>
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </tw-card>
    
  </div>
</template>

<script>
import TwNavTabs from '~/components/TwNavTabs'

export default {
  middleware: 'auth',

  components: {
    TwNavTabs
  },

  computed: {
    tabs () {
      return [
        {
          icon: 'user',
          name: this.$t('profile'),
          route: 'settings.profile'
        },
        {
          icon: 'lock',
          name: this.$t('password'),
          route: 'settings.password'
        }
      ]
    }
  }
}
</script>