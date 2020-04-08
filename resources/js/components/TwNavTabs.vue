<template>
  <ul class="flex border-b mt-4">
    <li v-for="tab in tabs" :key="tab.route" class="mr-1">
      <router-link :to="{ name: tab.route }" class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" active-class="border-t border-r border-l rounded-t border-b-0 -mb-px">
        <fa :icon="tab.icon" fixed-width />
        {{ tab.name }}
      </router-link>
    </li>
  </ul>
</template>


<script>
//import { mapGetters } from 'vuex'

export default {
  name: 'TwNavTabs',

  props: {
    tabs: {
      type: Array,
      default: null
    },
  }
}
</script>
