<template>
  <div class="card bg-white shadow-md rounded px-8 py-8 mb-8 sm:w-full">
    <img v-if="image" class="w-full" :src="image" :alt="imageAlt" :title="imageAlt">
    <div v-if="title" class="card-header font-hairline text-xl">
      {{ title }}
    </div>
    <div class="card-body">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: 'TwCard',

  props: {
    title: { type: String, default: null },
    image: { type: String, default: null },
    imageAlt: { type: String, default: null },
  }
}
</script>
