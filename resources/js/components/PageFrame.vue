<template>
  <v-app>
    <NavBar v-if="showSideBar" />
    <v-main>
      <slot />
    </v-main>
  </v-app>
</template>
<script setup>
import NavBar from "./NavBar.vue"
const props = defineProps({
  showSideBar: {type: Boolean, default: true}
})

</script>