<template>

    


    <form>

        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-12">
            <div class="card">
              <div class="card-body pt-0">
  
                <!-- Member Info -->
                <div class="mb-3">
                  <label class="form-label">Member ID</label>
                  <input type="text" class="form-control" v-model="formvalue.mid">
                </div>
  
                
  
                <div class="mb-3">
                  <label class="form-label">Group ID</label>
                  <input type="text" class="form-control" v-model="formvalue.gid">
                </div>
  
                <!-- Dues Form -->
                <div class="mb-3">
                  <label class="form-label">Dues ID</label>
                  <input type="text" class="form-control" v-model="formvalue.did">
                </div>
  
                <div class="mb-3">
                  <label class="form-label">Amount</label>
                  <input type="text" class="form-control" v-model="formvalue.amt">
                  
                </div>
  
                <div class="mb-3">
                  <label class="form-label">Payment Date</label>
                  <input type="text" class="form-control" v-model="formvalue.pdate">
                  
                </div>
  
                <div class="mb-3">
                  <label class="form-label">Payment Month</label>
                  <input type="text" class="form-control" v-model="formvalue.pmonth">
                </div>
  
                <!-- Save Button -->
                <button
                  type="button"class="btn btn-primary" @click="updatedduesbtn">
                  Update Dues
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
const {  getduesid,updateduesbyid } = useMemberStores();


const props = defineProps({
        id:{
            type:String,
            default: ''
        }
     })
     onMounted(async () => {
       
        getduesid(props.id);
    })


    function updatedduesbtn(){
   
updateduesbyid(formvalue.value,formvalue.value.id);
  }


    
</script>


<style scop>
</style>