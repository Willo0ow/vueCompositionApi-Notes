<template>
  <v-card class="ma-4">
    <v-card-title> Home </v-card-title>
    <v-card-text>
      <v-expansion-panels>
        <v-expansion-panel
          v-for="note of notes"
          :key="note.id"
          :title="note.subject"
          :text="note.content"
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
          Create Category
        </Link>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref, onBeforeMount } from "vue";
import {getNotes} from "../services"

const notes = ref([]);
onBeforeMount(async ()=>{
  notes.value = await getNotes();
});
</script>
