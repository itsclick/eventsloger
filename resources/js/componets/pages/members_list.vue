<template>
   
   <div class="col-md-12 col-lg-12">
    <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">                      
                                            <h4 class="card-title">Membership List</h4>                      
                                        </div><!--end col-->

                                        <div class="col" align="right">                      
                                            <router-link to="/addmember"><h4 class="card-title"><button type="button" class="btn btn-success">+ Add Member</button></h4>   </router-link>                    
                                        </div>
                                    </div>  <!--end row-->                                  
                                </div><!--end card-header-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th>#ID</th>
                                               
                                                
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Gender</th>
                                                <th>Telephone</th>
                                                <th>Email Address</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="m in membersmodel" :key="id">
                                             
                                              <td>{{ m.mid }}</td>
                                              
                                              <td>{{ m.fname }}</td>
                                              <td>{{ m.lname }}</td>
                                              <td>{{ m.gender }}</td>
                                              <td>{{ m.tele }}</td>
                                              <td>{{ m.email }}</td>
                                              <td>{{ m.address }}</td>
                                             
                                              

                                                
                                              <td>
                                                <i class="fas fa-wallet fs-16 me-1 " @click="paddues(m.id)" title="Pay dues"></i>&nbsp;

                                                <i class="fas fa-pen fs-16 me-1 " @click="editmember(m.id)" title="Edit"></i>  &nbsp;

                                                <i class="fas fa-trash 16-18 me-1 " @click="deletemember(m.id)" title="Delete"></i> 

                                                
                                            </td>
                                            </tr>
                                            
                                            </tbody>
                                        </table><!--end /table--> 
                                    </div><!--end /tableresponsive-->  
                                    
                                    
                                    <nav class="dataTable-pagination">
        <Pagination :data="duesmodelpgin"  :limit="5" @pagination-change-page="getmembers" class="dataTable-pagination">
            <template #prev-nav>
                <span>Previous</span>
            </template>
            <template #next-nav>
                <span>Next</span>
               
            </template>
           
        </Pagination>
        Showing{{ duesmodelpgin.current_page }} of {{ duesmodelpgin.last_page }} Pages [ {{ duesmodelpgin.total }} Entries ]
        </nav>



                                </div><!--end card-body--> 
                            </div>
                            </div>
                            
</template>







<script setup>



import { onMounted } from "vue";
  import { useMemberStores } from "../../store/members_store";
  import { storeToRefs } from 'pinia';



   //varibale here
   const { membersmodel ,duesmodelpgin} = storeToRefs(useMemberStores());

//functions below
const {deletemember,getmembers,paddues,editmember } = useMemberStores();





getmembers();







</script>

<style lang="css" scoped>
</style>