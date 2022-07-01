<template>
  <PageFrame>
    <v-card-title> Notatki </v-card-title>
    <v-container fluid>
      <v-card-subtitle>Filtry</v-card-subtitle>
      <v-row fluid>
        <v-col>
          <v-autocomplete
            v-model="filterCategory"
            :items="categories"
            label="Kategoria"
            clearable
          />
        </v-col>
        <v-col>
          <v-text-field
            v-model="startDate"
            type="date"
            label="Data start"
            clearable
          />
        </v-col>
        <v-col>
          <v-text-field
            v-model="endDate"
            type="date"
            label="Data koniec"
            clearable
          />
        </v-col>
      </v-row>
    </v-container>

    <v-card-text :style="{'max-height': `${windowHeight -210}px`, 'overflow-y':'scroll'}">
      <v-expansion-panels>
        <v-expansion-panel
          v-for="note of filteredNotes"
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
                  v-if="note.subCategoryName"
                  color="primary"
                  size="small"
                >
                  {{ note.subCategoryName }}
                </v-chip>
                <v-icon
                  class="mx-2"
                  color="error"
                  @click="deleteSelectedNote(note.id)"
                >
                  mdi-delete-outline
                </v-icon>
                <span>{{ note.created_at }}</span>
              </div>
            </div>
          </v-expansion-panel-title>
          <v-expansion-panel-text>
            <v-autocomplete
              v-model="note.status"
              style="max-width: 150px"
              :items="statuses"
              label="Status"
              @update:model-value="updateNoteStatus({id: note.id, status: $event})"
            />
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
import { ref, onBeforeMount, computed } from "vue";
import {getNotes, deleteNote, getStatuses, updateNoteStatus} from "../services"
import PageFrame from "../components/PageFrame.vue"

const filterCategory = ref(null);
const startDate = ref(null);
const endDate = ref(null);

const notes = ref([]);

const windowHeight = computed(()=>{
  return window.innerHeight
})

const categories = computed(()=>{
  if(notes && notes.value && notes.value.length){
    return notes.value.reduce((cats, note)=>{
      if(!cats.includes(note.categoryName)){
        cats.push(note.categoryName)
      }
      return cats;
    },[])
  }
  return []
})
const filteredNotes = computed(()=>{
  if(notes && notes.value && notes.value.length && (filterCategory.value || startDate.value || endDate.value)){
    return notes.value.filter((note)=>{
      const startDatePassed = startDate.value ? new Date(note.created_at) >= new Date(startDate.value) : true;
      const endDatePassed = endDate.value ? new Date(note.created_at) <= new Date(endDate.value) : true;
      const categoryPassed = filterCategory.value ? note.categoryName === filterCategory.value : true;
      return startDatePassed && endDatePassed && categoryPassed;
    })
  }
  return notes.value
})

const deleteSelectedNote = async (noteId) => {
  const noteIndx = notes.value.findIndex((note)=>note.id === noteId);
  notes.value.splice(noteIndx, 1);
  await deleteNote(noteId)
}
const statuses = ref([]);
onBeforeMount(async ()=>{
  statuses.value = await getStatuses();
  notes.value = await getNotes();
});
</script>
