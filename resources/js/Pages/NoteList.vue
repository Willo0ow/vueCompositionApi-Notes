<template>
  <PageFrame>
    <v-card-title> Notatki </v-card-title>
    <v-card-text>
      <v-expansion-panels>
        <v-expansion-panel
          v-for="note of notes"
          :key="note.id"
        >
          <v-expansion-panel-title>
            <div
              class="d-flex justify-space-between"
              style="width: 90%"
            >
              <span>{{ note.subject }}</span>
              <div>
                <v-chip
                  color="success"
                  size="small"
                  class="mr-2"
                >
                  {{ note.categoryName }}
                </v-chip>
                <v-chip
                  color="primary"
                  size="small"
                >
                  {{ note.subCategoryName }}
                </v-chip>
              </div>
            </div>
          </v-expansion-panel-title>
          <v-expansion-panel-text>
            <p
              v-for="(line, index) of note.content.split('\n')"
              :key="index"
            >
              {{ line }}
            </p>
          </v-expansion-panel-text>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-card-text>
  </PageFrame>
</template>
<script setup>
import { ref, onBeforeMount } from "vue";
import {getNotes} from "../services"
import PageFrame from "../components/PageFrame.vue"


const notes = ref([]);
onBeforeMount(async ()=>{
  notes.value = await getNotes();
});

const items = [
  {value: 1, text: "1111"}
]
</script>
