<template>

<form>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8">
          <h5>Editing Groups -  {{ formvalue.gname }}</h5>
  
          <div class="card">
            <div class="card-body pt-0">
  
              <!-- Group ID Field -->
              <div class="mb-3">
                <label class="form-label">Group ID</label>
                <input type="text"  class="form-control" v-model="formvalue.gid"  placeholder="Group ID">
                <!-- Inline error message -->
                
              </div>
  
              <!-- Group Name Field -->
              <div class="mb-3">
                <label class="form-label">Group Name</label>
                <input type="text"  class="form-control" v-model="formvalue.gname"  placeholder="Group Name">
                <!-- Inline error message -->
               
              </div>
  
              <!-- Save Button -->
              <button  
                type="button"
                class="btn btn-primary"  @click="updatedduesbtn"> 
                <span v-if="!saveloader"> Update Group </span>
                <span v-if="saveloader"> Updating... </span>
            
            </button>
  
            </div>
          </div>
  
        </div>
      </div>
    </form>
</template>



<script setup>


import { onMounted } from "vue";
  import { useMemberStores } from "../../store/members_store";
  import { storeToRefs } from 'pinia';


//varibale here
const { formvalue } = storeToRefs(useMemberStores());

//functions below
const {  getgroupid,updatedgroupbyid } = useMemberStores();


const props = defineProps({
        id:{
            type:String,
            default: ''
        }
     })
     onMounted(async () => {
       
        getgroupid(props.id);
    })


    function updatedduesbtn(){
   
    updatedgroupbyid(formvalue.value,formvalue.value.id);
  }




</script>

<style lang="css" scoped>
</style>

