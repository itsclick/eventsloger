<template>
  <div class="container-xxl">
        <div class="row">
          <div class="col-xl-8">
            <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Add system menu</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="mb-3">
                
                <input type="text"  class="form-control" v-model="groupform.menu_name" placeholder="Menu Name">
              </div>
              <div class="mb-3">
                
                <input type="text"  class="form-control" v-model="groupform.menu_link" placeholder="Menu Link / Route">
              </div>

              <div class="mb-3">
               
                <input type="text"  class="form-control" v-model="groupform.menu_icon" placeholder="Menu Icon">
              </div>

              <div class="mb-3">
                
                <input type="text"  class="form-control" v-model="groupform.des" placeholder="Description">
              </div>
  
              <!-- Save Button -->
              <button  
                type="button"
                class="btn btn-success"  @click="savemenubtn"> Save Menu</button>
  
           

                                        
                                    </div>
                                </div>
          </div>
        </div>
      </div>
    
  </template>
  
  <script setup>
import { onMounted,ref } from "vue";
import axios from "axios";
  import { useMemberStores } from "../../store/members_store";
  import { useSaveDataStore } from "../../store/SaveDataStore";
  import { storeToRefs } from 'pinia';
  import { useRouter } from "vue-router";
  



  //varibale here
  const { saveloader,showErrro, Erromsg} = storeToRefs(useSaveDataStore());

  //functions below
  const {  savemenus } = useSaveDataStore();
  
  // FORM DATA
  const groupform = ref({
   
    menu_name: "",
    menu_link: "",
    menu_icon: "na",
    des: "",
   
  });
  
  
  function savemenubtn(){

    savemenus(groupform.value);
  }
  
 
  </script>
  
  <style scoped>
  .text-danger {
    font-size: 0.875rem; /* smaller text for error */
  }
  </style>
  