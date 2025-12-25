<template>
  <div class="container-xxl">
        <div class="row">
          <div class="col-xl-8">
            <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Adding New Event </h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="mb-3">
                <label class="form-label">Event Name / Title</label>
                <input type="text"  class="form-control" v-model="groupform.ename" placeholder="Event Name">
              </div>
              <div class="mb-3">

            

                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                <input type="date"  class="form-control" v-model="groupform.evsdate" placeholder="Start Date">
              </div>

              <div class="mb-3">
                <label class="form-label">End Date</label>
                <input type="date"  class="form-control" v-model="groupform.evendate" placeholder="End Date">
              </div>

              <div class="mb-3">
                <label class="form-label">Start Time</label>
                <input type="time"  class="form-control" v-model="groupform.evstime" placeholder="Start time">
              </div>
              <div class="mb-3">
                <label class="form-label">End Time</label>
                <input type="time"  class="form-control" v-model="groupform.evendtime" placeholder="End time">
              </div>

               <div class="mb-3">
                <label class="form-label">Event Venue</label>
                <input type="text"  class="form-control" v-model="groupform.evenue" placeholder="Event Venue">
              </div>

              <div class="mb-3">
              <label class="form-label">Event Logo</label>
              <input type="file"  class="form-control" accept="image/*"  @change="onImageChange"/>
              </div>

              

             
  
              <!-- Save Button -->
              <button  
                type="button"
                class="btn btn-success"  @click="saveeventbtn"> Save Event</button>
  
           

                                        
                                    </div>
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
  import { menustore } from "../../store/menus";
  import { storeToRefs } from 'pinia';
  import { useRouter } from "vue-router";
  



  //varibale here
const { saveloader, showErrro, Erromsg } = storeToRefs(useSaveDataStore());
    const { user_id} = storeToRefs(menustore());

  //functions below
  const {  saveevents } = useSaveDataStore();


 

  // FORM DATA
  const groupform = ref({
   
    ename: "",
    evsdate: "",
    evendate:'',
    evstime: "na",
    evenue: "",
    evendtime:"",
      image: null,

   
  });
  function onImageChange(e) {
  groupform.value.image = e.target.files[0];
}


function saveeventbtn() {
  const formData = new FormData();

  formData.append("ename", groupform.value.ename);
  formData.append("evsdate", groupform.value.evsdate);
  formData.append("evendate", groupform.value.evendate);
  formData.append("evstime", groupform.value.evstime);
  formData.append("evendtime", groupform.value.evendtime);
    formData.append("evenue", groupform.value.evenue);
  formData.append("username", user_id.value); // ✅ hidden but sent

  if (groupform.value.image) {
    formData.append("image", groupform.value.image);
  }

  saveevents(formData);
}


  
  

  
 
  </script>
  
  <style scoped>
  .text-danger {
    font-size: 0.875rem; /* smaller text for error */
  }
  </style>
  