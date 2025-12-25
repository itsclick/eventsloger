<template>

  



    <!-- {{ sysmenus }} -->
    <div class="col-md-12 col-lg-12">
      <div class="card">

        <div class="card-header">
          <h4 class="card-title">Listing System Menus</h4>
          <div class="col text-end">
             <router-link to="/addmenu">
                <button type="button" class="btn btn-success">+ Add Menu</button>
              </router-link>
          </div>
          </div>



        
          
  
        <div class="table-responsive">
                                    <table class="table table-custom table-centered table-select table-hover w-100 mb-0">
                                        <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                                            <tr class="text-uppercase fs-xxs">
                  
                  <th>#ID</th>
                  <th>Menu Name</th>
                  <th>Menu Route</th>
                  <th>Menu Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="m in sysmenus" :key="m.id">
                
                 
                  <td>{{ m.menu_id }}</td>
                  <td>{{ m.menu_name }}</td>
                  <td>{{ m.menu_link }}</td>
                  <td>{{ m.des }}</td>
                
                        <td>

                       
                          
                      
                        <i class="ri-delete-bin-5-fill" 
                        :class="{ 'text-muted': !getAccess.menu_delete }" 
                        :style="{ cursor: getAccess.menu_delete ? 'pointer' : 'not-allowed' }"
                        @click="getAccess.menu_delete && deletemenubtn(m.id)" title="Delete"></i>

                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          


          <div class="card-footer border-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div data-table-pagination-info="products"></div>
                                        <div data-table-pagination></div>
                                    </div>
                                </div>
  
          <!-- Pagination -->
          <nav class="d-flex justify-content-between align-items-center">
        <Pagination :data="sysmenuspaginate"  :limit="5" @pagination-change-page="getallsysmenus" class="d-flex justify-content-between align-items-center">
            <template #prev-nav>
                <span>Previous</span>
            </template>
            <template #next-nav>
                <span>Next</span>
               
            </template>
           
        </Pagination>
        Showing{{ sysmenuspaginate.current_page }} of {{ sysmenuspaginate.last_page }} Pages [ {{ sysmenuspaginate.total }} Entries ]
        </nav>
        </div>
      </div>
    
  </template>
  
 <script setup>
import { onMounted } from "vue";
import { storeToRefs } from "pinia";

import { useViewDataStore } from "../../store/ViewDataStore";
import { useDeleteDataStore } from "../../store/DeleteDataStore";
import { menustore } from "../../store/menus";

// store instances
const viewStore = useViewDataStore();
const deleteStore = useDeleteDataStore();
const menuStore = menustore();

// state / getters
const { sysmenus, sysmenuspaginate } = storeToRefs(viewStore);
const { getAccess } = storeToRefs(menuStore);

// actions
const { getallsysmenus } = viewStore;
const { deletemenubtn } = deleteStore;


// lifecycle
onMounted(() => {
  getallsysmenus();
});
</script>

  
  <style scoped>


  </style>
  