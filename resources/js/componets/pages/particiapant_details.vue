<template>
  <div class="card">
    <div class="card-header justify-content-between">
      <h4 class="card-title">Participant details for event: {{ eid }}</h4>
     
    </div>
  <div>
    

    <!-- Debug raw event data -->
    <!-- <pre>{{ store.eventguest }}</pre> -->

    <!-- Loading -->
   <div class="col"  v-if="loading">
    <!-- Wave -->
    <div class="sk-wave mx-auto">
        <div class="sk-wave-rect"></div>
        <div class="sk-wave-rect"></div>
        <div class="sk-wave-rect"></div>
        <div class="sk-wave-rect"></div>
        <div class="sk-wave-rect"></div>
    </div>
</div>
    

    <!-- Table / Empty State -->
    <div v-else class="card-body">
      <div class="table-responsive">

        <!-- Participants Table -->
        <table
          v-if="store.participants.length"
          class="table table-striped mb-0"
        >
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Full Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Attended</th>
               <th>Print Tags</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(p, i) in store.participants" :key="p.id">
              <td>{{ i + 1 }}</td>
              <td>{{ p.full_name || "-" }}</td>
              <td>{{ p.phone_number || "-" }}</td>
              <td>{{ p.email_address || "-" }}</td>
              <td>
                <span :class="p.attended ? 'text-success' : 'text-danger'">
                  {{ p.attended ? 'Yes' : 'No' }}
                </span>
              </td>
               <td>
             <i v-if="p.attended" class="ri-printer-fill text-success" ></i>
               </td>

            </tr>
          </tbody>
        </table>

        <!-- Empty State -->
        <div v-else>
          No participants registered for this event.
        </div>

      </div>
    </div>
  </div>
  </div>
</template>


<script setup>
import { onMounted, ref } from "vue";
import { useViewDataStore } from "../../store/ViewDataStore.js";

const props = defineProps({
  eid: {
    type: String,
    required: true,
  },
});

// Pinia store
const store = useViewDataStore();
const loading = ref(false);

// Fetch event and participants
const fetchEvent = async () => {
  loading.value = true;
  try {
    await store.geteventguests(props.eid);
  } catch (err) {
    console.error("Error fetching event:", err);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchEvent();
});
</script>

<style scoped>
.text-success {
  color: green;
}
.text-danger {
  color: red;
}
</style>
