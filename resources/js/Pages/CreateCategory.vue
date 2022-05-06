<template>
  <v-app>
    <v-main>
      <v-card class="ma-4">
        <v-card-title>Utwórz Kategorię</v-card-title>
        <v-card-text>
          <v-checkbox
            v-model="isSubCategory"
            label="Podkategoria"
          />
          <v-text-field
            v-model="name"
            label="Nazwa Kategorii"
          />
          <v-select
            v-if="isSubCategory"
            v-model="category"
            :items="categories"
            item-label="name"
            item-value="id"
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
const name = ref("");
const  isSubCategory = ref(false);
const  categories = ref([]);
const  category = ref(null);
</script>
