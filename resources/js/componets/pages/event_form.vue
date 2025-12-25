<template>
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Event Registration Form Builder</h4>
      <small class="text-muted">Event ID: {{ id }}</small>
    </div>

    <div class="card-body">

      <!-- ================= ADD FIELD PANEL ================= -->
      <div class="border rounded p-3 mb-4 bg-light">
        <h6>Add Field</h6>

        <div class="row g-2 align-items-end">
          <div class="col-md-4">
            <label class="form-label">Field Type</label>
            <select v-model="newField.type" class="form-select">
              <option value="">Select type</option>
              <option value="text">Text</option>
              <option value="email">Email</option>
              <option value="phone">Phone</option>
              <option value="select">Dropdown</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Label</label>
            <input v-model="newField.label" class="form-control" />
          </div>

          <div class="col-md-2">
            <div class="form-check mt-4">
              <input class="form-check-input" type="checkbox" v-model="newField.required" />
              <label class="form-check-label">Required</label>
            </div>
          </div>

          <div class="col-md-2 text-end">
            <button class="btn btn-primary" @click="addField">Add Field </button>
          </div>
        </div>

        <!-- Dropdown options -->
        <div v-if="newField.type === 'select'" class="mt-3">
          <label class="form-label">Dropdown Options (comma separated)</label>
          <input v-model="newField.options" class="form-control"  placeholder="Male, Female" />
        </div>
      </div>

      <!-- ================= FORM PREVIEW ================= -->
      <h6 class="mb-3">Form Preview</h6>

      <div v-if="fields.length === 0" class="text-muted">
        No fields added yet.
      </div>

      <div
        v-for="(field, index) in fields"  :key="index" class="border rounded p-3 mb-3" >
        <div class="d-flex justify-content-between align-items-center mb-2">
          <strong>{{ field.label }}</strong>
          <button class="btn btn-sm btn-danger" @click="removeField(index)"> Remove </button>
        </div>

        <input
          v-if="field.type === 'text' || field.type === 'email' || field.type === 'phone'"
          :type="field.type === 'phone' ? 'text' : field.type" class="form-control" :required="field.required" />

        <select v-if="field.type === 'select'"  class="form-select"  :required="field.required" >
          <option value="">Select</option>
          <option v-for="opt in field.options" :key="opt">
            {{ opt }}
          </option>
        </select>

        <small class="text-muted">
          {{ field.required ? 'Required' : 'Optional' }}
        </small>
      </div>

      <!-- ================= SAVE BUTTON ================= -->
      <div class="text-end mt-4">
        <button
          class="btn btn-success" :disabled="saveStore.saveloader || fields.length === 0" @click="saveForm" >
          <span v-if="saveStore.saveloader">Saving...</span>
          <span v-else>Save Form</span>
        </button>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { storeToRefs } from "pinia";
import { useSaveDataStore } from "@/store/SaveDataStore.js";
import { menustore } from "@/store/menus.js";
import Swal from "sweetalert2";

const props = defineProps({
  id: {
    type: String,
    required: true,
  },
});

const router = useRouter();
const saveStore = useSaveDataStore();

// Pinia store
const menuStore = menustore();
const { user_id } = storeToRefs(menuStore);

const fields = ref([]);

const newField = ref({
  type: "",
  label: "",
  required: false,
  options: "",
});

function addField() {
  if (!newField.value.type || !newField.value.label) {
    Swal.fire("Missing data", "Field type and label are required", "warning");
    return;
  }

  fields.value.push({
    label: newField.value.label,
    name: newField.value.label.toLowerCase().replace(/\s+/g, "_"),
    type: newField.value.type,
    required: newField.value.required,
    options:
      newField.value.type === "select"
        ? newField.value.options.split(",").map(o => o.trim())
        : [],
  });

  newField.value = {
    type: "",
    label: "",
    required: false,
    options: "",
  };
}

function removeField(index) {
  fields.value.splice(index, 1);
}

function saveForm() {
  saveStore.saveEventForm(props.id, fields.value, user_id.value);
}
</script>


<style scoped>
.border {
  background: #fafafa;
}
</style>
