<template>
  <ul class="locale-switcher">
    <li v-for="(value, key) in locales" :key="key">
      <a href="" @click.prevent="setLocale(key)" :class="value === locales[locale] ? 'is-active-locale' : ''">
        {{ value }}
      </a>
    </li>
  </ul>
</template>

<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'

export default {
  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales'
  }),

  methods: {
    setLocale (locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)
        this.$store.dispatch('lang/setLocale', { locale })
      }
    }
  }
}
</script>
