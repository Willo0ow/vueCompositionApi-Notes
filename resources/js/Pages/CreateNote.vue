<template>
  <v-app>
    <v-main>
      <v-card>
        <v-card-title>Utwórz Notatkę</v-card-title>
        <v-card-text>
          <v-text-field
            v-model="subject"
            label="Temat"
          />
          <v-textarea
            v-model="content"
            label="Treść"
          />
        </v-card-text>
        <v-card-actions>
          <v-btn>Zapisz</v-btn>
        </v-card-actions>
        <Link href="/">
          Go Home
        </Link>
      </v-card>
    </v-main>
  </v-app>
</template>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
const subject = ref("");
const content = ref("");
</script>
