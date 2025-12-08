<template>
    <form>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8">
          <h5>Adding New Group </h5>
  
          <div class="card">
            <div class="card-body pt-0">
  <!-- {{ Erromsg }} -->

                    <div v-if="showErrro">
                        <div class="alert alert-danger border-0" role="alert">
                        <ul v-for="err in Erromsg.errors">
                            <li>{{ err }}</li>
                        </ul>
                        </div>
                        </div>
              <!-- Group ID Field -->
              
  
              <!-- Group Name Field -->
              <div class="mb-3">
                <label class="form-label">Group Name</label>
                <input type="text"  class="form-control" v-model="groupform.gname"  placeholder="Group Name">
                <!-- Inline error message -->
               
              </div>
  
              <!-- Save Button -->
              <button  
                type="button"
                class="btn btn-primary"  @click="savegroupbtn"> Save Group</button>
  
            </div>
          </div>
  
        </div>
      </div>
    </form>
  </template>
  
  <script setup>
import { onMounted,ref } from "vue";
import axios from "axios";
  import { useMemberStores } from "../../store/members_store";
  import { storeToRefs } from 'pinia';
  import { useRouter } from "vue-router";
  



  //varibale here
  const { saveloader,showErrro, Erromsg} = storeToRefs(useMemberStores());

  //functions below
  const {  savegroup } = useMemberStores();
  
  // FORM DATA
  const groupform = ref({
   
    gname: "",
  });
  
  
  function savegroupbtn(){

savegroup(groupform.value);
  }
  
 
  </script>
  
  <style scoped>
  .text-danger {
    font-size: 0.875rem; /* smaller text for error */
  }
  </style>
  