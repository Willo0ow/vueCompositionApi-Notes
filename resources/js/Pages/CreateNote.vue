<template>
  <PageFrame>
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
      <v-container fluid>
        <v-row fluid>
          <v-col>
            <v-autocomplete
              v-if="categories.length"
              v-model="category"
              :items="categories"
              label="Kategoria"
              @update:modelValue="getCategorySubs"
            />
          </v-col>
          <v-col>
            <v-autocomplete
              v-if="subCategories.length"
              v-model="subCategory"
              :items="subCategories"
              label="Podkategoria"
            />
          </v-col>
          <v-col>
            <v-text-field
              v-model="created_at"
              type="datetime-local"
              label="Data utworzenia"
            />
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
    <v-card-actions>
      <v-btn
        class="ml-auto"
        color="success"
        @click="save"
      >
        Zapisz
      </v-btn>
    </v-card-actions>
  </PageFrame>
</template>
<script setup>
import axios from "axios";
import { ref, onBeforeMount, useAttrs } from "vue";
import {getSubcategories, getCategories, getNote} from "../services"
import PageFrame from "../components/PageFrame.vue"

const subject = ref("");
const content = ref("");
const category = ref(null);
const subCategory = ref(null);
const categories = ref([]);
const subCategories = ref([]);
const created_at = ref("");
const attrs = useAttrs()

const reset = () => {
  subject.value = "";
  content.value = "";
  created_at.value = "";
  category.value = null;
  subCategory.value = null;
}

const getCategorySubs= async () => {
  subCategories.value = await getSubcategories(category.value);
}

const save = async () =>{
  const form = {
      subject: subject.value, 
      content: content.value, 
      category: category.value, 
      subCategory: subCategory.value, 
    }
    if(created_at.value){
      form.created_at = created_at.value;
    }
    if(attrs.id){
      await axios.patch(`/api/note/${attrs.id}`,form)
      window.location.assign("/")
    } else {
      await axios.post("/api/note",form)
    }
  reset();
}

onBeforeMount(async ()=>{
  if(attrs.id){
    const retrievedNote = await getNote(attrs.id)
      subject.value = retrievedNote.subject;
      content.value = retrievedNote.content;
      created_at.value = retrievedNote.created_at.slice(0,16);
      category.value = retrievedNote.category;
      subCategory.value = retrievedNote.subCategory;
  }
  categories.value = await getCategories()
})
</script>
