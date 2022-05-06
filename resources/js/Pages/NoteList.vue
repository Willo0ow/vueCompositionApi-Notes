<template>
  <v-card class="ma-4">
    <v-card-title> Home </v-card-title>
    <v-card-text>
      <v-expansion-panels>
        <v-expansion-panel
          v-for="i in 3"
          :key="i"
          title="Item"
          text="text"
        />
      </v-expansion-panels>
    </v-card-text>
    <v-card-actions>
      <v-btn>
        <Link href="/newNote">
          Create Note
        </Link>
      </v-btn>
      <v-btn>
        <Link href="/newCategory">
          Create Note
        </Link>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>
