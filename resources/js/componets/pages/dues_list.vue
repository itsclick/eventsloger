<template>





   <div class="col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">                      
              <h4 class="card-title">Due list</h4>                      
            </div>
            <div class="col text-end">                      
              <router-link to="/adddues">
                <button type="button" class="btn btn-success">+ Pay Dues</button>
              </router-link>                     
            </div>
          </div>                                  
        </div>
  
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table table-striped mb-0">
                {{ duesid }}
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Dues ID</th>
                  <th>Members ID</th>
                  <th>Group ID</th>
                  <th>Amount Paid</th>
                  <th>Payment Date</th>
                  <th>Payment Month</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="m in duesmodel" :key="m.id">
                  <td>{{ m.id }}</td>
                  <td>{{ m.did }}</td>
                  <td>{{ m.mid }}</td>
                  <td>{{ m.gid }}</td>
                  <td>{{ parseFloat(m.amt).toFixed(2) }}</td>
                  <td>{{ m.pdate }}</td>
                  <td>{{ m.pmonth }}</td>
                  <td>
                    <button type="button" class="btn btn-warning" @click="editdues(m.id)">Edit</button>
                    <button type="button" class="btn btn-danger" @click="deletedues(m.id)">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        <nav class="dataTable-pagination">
        <Pagination :data="duesmodelpgin"  :limit="5" @pagination-change-page="getalldues" class="dataTable-pagination">
            <template #prev-nav>
                <span>Previous</span>
            </template>
            <template #next-nav>
                <span>Next</span>
               
            </template>
           
        </Pagination>
        Showing{{ duesmodelpgin.current_page }} of {{ duesmodelpgin.last_page }} Pages [ {{ duesmodelpgin.total }} Entries ]
        </nav>


          </div>
  </div>
          
        </div>
   
 

  </template>
  
  <script setup>
  import { onMounted } from "vue";
  import { useMemberStores } from "../../store/members_store";
  import { storeToRefs } from 'pinia';
  



  //varibale here
  const { duesmodel ,duesmodelpgin,duesid } = storeToRefs(useMemberStores());

  //functions below
  const {  getalldues,deletedues,editdues } = useMemberStores();


  getalldues();

  </script>
  
  <style scoped>
  </style>
  