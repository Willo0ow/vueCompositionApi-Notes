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
          <v-autocomplete
            v-if="categories.length"
            v-model="category"
            :items="categories"
            item-text="name"
            item-value="id"
            @update:modelValue="getCategorySubs"
          />
          <v-autocomplete
            v-if="subCategories.length"
            v-model="subCategory"
            :items="subCategories"
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
import axios from "axios";
import { ref, onBeforeMount } from "vue";
import {getSubcategories, getCategories} from "../services"

const subject = ref("");
const content = ref("");
const category = ref(null);
const subCategory = ref(null);
const categories = ref([]);
const subCategories = ref([]);
const reset = () => {
  subject.value = "";
  content.value = "";
  category.value = null;
  subCategory.value = null;
}

const getCategorySubs= async () => {
  subCategories.value = await getSubcategories(category.value);
}

const save = async () =>{
  await axios.post("/api/note", 
  {subject: subject.value, content: content.value, category: category.value, subCategory: subCategory.value}
  )
  reset();
}

onBeforeMount(async ()=>{
  categories.value = await getCategories()
})
</script>
