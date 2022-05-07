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
          <v-autocomplete
            v-if="isSubCategory && categories.length"
            v-model="category"
            :items="categories"
            item-text="name"
            item-value="id"
          />
        </v-card-text>
        <v-card-actions>
          <v-btn @click="save">
            Zapisz
          </v-btn>
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
import { ref, onBeforeMount, reactive } from "vue";
import {getCategories} from "../services"
import axios from "axios";

const name = ref("");
const  isSubCategory = ref(false);
const  categories = ref([]);
const  category = ref(null);

const reset = async () => {
  isSubCategory.value = false;
  name.value = "";
  category.value = null;
  categories.value = await getCategories();
}
const save = async () => {
  if(!isSubCategory.value){
    await axios.post("/api/category", {name: name.value});
  } else {
    await axios.post("/api/subcategory", {name: name.value, category: category.value});
  }
  await reset();
}

onBeforeMount(async ()=>{
  categories.value = await getCategories();
})
</script>
