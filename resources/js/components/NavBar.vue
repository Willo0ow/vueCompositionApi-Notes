<template>
  <v-navigation-drawer
    theme="dark"
    permanent
    width="200"
  >
    <v-list theme="dark">
      <v-list-item
        v-for="item in links"
        :key="item.title"
        link
      >
        <v-list-item-avatar start>
          <v-icon :icon="item.icon" />
        </v-list-item-avatar>
        <Link :href="item.path">
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </Link>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
const links = [
  {title: "Lista", icon: "mdi-format-list-bulleted", path: "/"},
    {title: "Nowa Notatka", icon: "mdi-file-plus", path: "/newNote"},
      {title: "Kategorie", icon: "mdi-table-column-plus-after", path: "/newCategory"},
]
</script>