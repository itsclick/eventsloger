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
              <th>Username</th>
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

              <td>{{ data.username || '-' }}</td>

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
                        @click="getAccess.menu_details === 1 && viewEvent(data.id)"
                        title="View"
                      >View Details</i>
                    </span>

                     <!-- Add Form -->
                    <span  class="dropdown-item">
                      <i
                        class="ri-add-box-fill"
                        :class="{ 'text-muted': getAccess.addform !== 1 }"
                        :style="{ cursor: getAccess.addform === 1 ? 'pointer' : 'not-allowed' }"
                        @click="getAccess.addform === 1 && eventformbtn(data.eid)"
                        title="Add Form"
                      >Add Form</i>
                    </span>

                    <!-- Edit -->
                    <span  class="dropdown-item">
                      <i
                        class="ri ri-edit-box-line me-1"
                        :class="{ 'text-muted': getAccess.menu_edit !== 1 }"
                        :style="{ cursor: getAccess.menu_edit === 1 ? 'pointer' : 'not-allowed' }"
                        @click="getAccess.menu_edit === 1 && editEventbtn(data.eid)"
                        title="Edit"
                      >Edit Records</i>
                    </span>

                    <!-- Delete -->
                    <span class="dropdown-item">
                      <i class="ri-delete-bin-5-fill" :class="{ 'text-muted disabled-icon': getAccess.menu_delete !== 1 }"
                        :title="getAccess.menu_delete === 1 ? 'Delete' : 'No Permission'" @click="getAccess.menu_delete === 1 && deleteEvent(data.id)"
                      >Delete Record</i>
                    </span>

                  </div>
                </div>
              </td>
            </tr>
          </tbody>

        </table>
      </div>
        <nav class="dataTable-pagination">
          <Pagination :data="eventpaginate"  :limit="2" @pagination-change-page="fetchallevents">
            <template #prev-nav>Previous</template>
            <template #next-nav>Next</template>
          </Pagination>

              Showing {{ eventpaginate.current_page }} of {{ eventpaginate.last_page }}
              Pages [ {{ eventpaginate.total }} Entries ]
</nav>
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
const { eventlist,eventpaginate } = storeToRefs(useViewDataStore());
const { fetchallevents, editEventbtn,eventformbtn } = useViewDataStore();
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
