<template>



<div class="container-xxl">
        <div class="row">
          <div class="col-xl-8">
            <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Editing Event {{ eid }}</h4>
                                    </div>

                                    <div class="card-body">
                            <div class="mb-3"> 
                            <span class="avatar-xl d-block mb-1">
                            <span class="mg-fluid rounded">
                            <img :src="`/storage/${formvalue.image}`" class="mg-fluid rounded" height="100" width="150px"/>
                            </span>
                            </span>
                            </div><br><br><br>

                                    


                <div class="mb-3">
                <label class="form-label">Event Name / Title</label>
                <input type="text"  class="form-control" v-model="formvalue.ename" >
              </div>
              <div class="mb-3">

            

                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                <input type="date"  class="form-control" v-model="formvalue.evsdate" >
              </div>

              <div class="mb-3">
                <label class="form-label">End Date</label>
                <input type="date"  class="form-control" v-model="formvalue.evendate" >
              </div>

              <div class="mb-3">
                <label class="form-label">Start Time</label>
                <input type="time"  class="form-control" v-model="formvalue.evstime" >
              </div>
              <div class="mb-3">
                <label class="form-label">End Time</label>
                <input type="time"  class="form-control" v-model="formvalue.evendtime" >
              </div>

               <div class="mb-3">
                <label class="form-label">Event Venue</label>
                <input type="text"  class="form-control" v-model="formvalue.evenue" >
              </div>

              <div class="mb-3">
              <label class="form-label">Event Logo</label>
            
              <input type="file"  class="form-control" accept="image/*"  @change="onImageChange"/>
               
              </div>

              

             
  
              <!-- Save Button -->
              <button  
                type="button"
                class="btn btn-success"  @click="updateeventbtn"> Save Event</button>
  
           </div>
                                </div>
          </div>
        </div>
      </div>
      </div>


</template>   

<script setup>
import { onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useViewDataStore } from "../../store/ViewDataStore.js";
import { useSaveDataStore } from "../../store/SaveDataStore.js";
import { menustore } from "../../store/menus.js";

// Access menu permissions
const { user_id} = storeToRefs(menustore());


// Access events from Pinia store
const { formvalue } = storeToRefs(useViewDataStore());

const { geteventbyid} = useViewDataStore();
const { updateevent} = useSaveDataStore();



const props = defineProps({
    eid: {
        type: String,
        default: ''
    }
});

onMounted(() => {
    geteventbyid(props.eid);
});



// Handle image change
function onImageChange(e) {
  const file = e.target.files[0];
  if (file) {
    formvalue.value.imageFile = file;
    previewImage.value = URL.createObjectURL(file);
  }
}


// Update event
function updateeventbtn() {
  const formData = new FormData();

  formData.append("eid", formvalue.value.eid);
  formData.append("ename", formvalue.value.ename);
  formData.append("evsdate", formvalue.value.evsdate);
  formData.append("evendate", formvalue.value.evendate);
  formData.append("evstime", formvalue.value.evstime);
  formData.append("evendtime", formvalue.value.evendtime);
  formData.append("evenue", formvalue.value.evenue);
  formData.append("username", user_id.value);

  // ✅ ONLY append if new image selected
  if (formvalue.value.imageFile instanceof File) {
    formData.append("image", formvalue.value.imageFile);
  }

  updateevent(formData, formvalue.value.id);
}


</script>

<style lang="css" scoped>

</style>