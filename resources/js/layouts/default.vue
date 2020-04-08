<template>
  <div class="main-layout">
    <tw-navbar />
    <main>
      <child />
    </main>
    <locale-switcher />
  </div>
</template>

<script>
import TwNavbar from '~/components/TwNavbar'
import LocaleSwitcher from '~/components/LocaleSwitcher'

export default {
  name: 'MainLayout',

  components: {
    TwNavbar,
    LocaleSwitcher
  }
}
</script>
