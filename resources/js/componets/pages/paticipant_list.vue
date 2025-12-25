<template>
  <div class="card">
    <div class="card-header justify-content-between">
      <h4 class="card-title">List of All Events</h4>
      <router-link to="addeventbtn">
        <button type="button" class="btn btn-success">+ Add Event</button>
      </router-link>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th>#Event Code</th>
              <th>Event Name</th>
              <th>Started Date</th>
              <th>End Date</th>
              <th>Start Time</th>
              <th>Venue</th>
              <th>Logo</th>
            
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="data in eventlist" :key="data.id">
              <td>{{ data.eid }}</td>
              <td>{{ data.ename }}</td>
              <td>{{ data.evsdate }}</td>
              <td>{{ data.evendate }}</td>
              <td>{{ data.evstime }}</td>
              <td>{{ data.evenue }}</td>

              <!-- Event Image -->
              <td>
                <img :src="`/storage/${data.image}`"  class="rounded avatar-xl"/>
               
              </td>

             

              <!-- Actions -->
              <td class="text-end">
                <div class="dropdown text-muted">
                  <span
                    
                    class="dropdown-toggle drop-arrow-none fs-xxl link-reset p-0"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <i class="ri ri-more-2-fill"></i>
                  </span>

                  <div class="dropdown-menu dropdown-menu-end">

                    <!-- View -->
                    <span  class="dropdown-item">
                      <i
                        class="ri ri-eye-line me-1"
                        :class="{ 'text-muted': getAccess.menu_details !== 1 }"
                        :style="{ cursor: getAccess.menu_details === 1 ? 'pointer' : 'not-allowed' }"
                        @click="getAccess.menu_details === 1 && viewparticipantbtn(data.id)"
                        title="View Paticipants"
                      >View Paticipants</i>
                    </span>

                     <!-- Add Form -->
                    

                    <!-- Edit -->
                   

                    <!-- Delete -->
                    

                  </div>
                </div>
              </td>
            </tr>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useViewDataStore } from "../../store/ViewDataStore.js";
import { menustore } from "../../store/menus.js";
import { useDeleteDataStore } from "../../store/DeleteDataStore.js";

// Access menu permissions
const { getAccess } = storeToRefs(menustore());


// Access events from Pinia store
const { eventlist } = storeToRefs(useViewDataStore());
const { fetchallevents, viewparticipantbtn,editEventbtn,eventformbtn } = useViewDataStore();
const { deleteEvent } = useDeleteDataStore();

// Load events on mount
onMounted(() => {
  fetchallevents();
});





</script>

<style scoped>
/* Grey out and disable icon when permission denied */
.disabled-icon {
  color: #adb5bd;      /* grey */
  cursor: not-allowed; /* no pointer */
  pointer-events: none; /* prevent clicking */
}
</style>
