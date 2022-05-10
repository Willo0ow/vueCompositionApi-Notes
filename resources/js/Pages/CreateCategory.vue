<template>
  <PageFrame :show-side-bar="Object.keys(attrs).length && attrs.useNav">
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
      />
    </v-card-text>
    <v-card-actions>
      <v-btn
        color="success"
        class="ml-auto"
        @click="save"
      >
        Zapisz
      </v-btn>
    </v-card-actions>
  </PageFrame>
</template>
<script setup>
import { ref, onBeforeMount, useAttrs } from "vue";
import {getCategories} from "../services"
import axios from "axios";
import PageFrame from "../components/PageFrame.vue"

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
const attrs = useAttrs()

onBeforeMount(async ()=>{
  categories.value = await getCategories();
})
</script>
