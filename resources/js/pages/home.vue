<template>
  <div class="container mx-auto">
    <tw-card :title="$t('home')">
      {{ $t('you_are_logged_in') }}
    </tw-card>
  </div>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
