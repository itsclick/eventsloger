<template>
   
  <form>
    <div class="row justify-content-center">
      <div class="col-md-12 col-lg-12">
        <h5 class="mb-3">Editing Record for - {{ formvalue.fname }} {{ formvalue.lname }}</h5>

      
        

        <div class="card">
          <div class="card-body">
            <div class="row">

              
              <div class="col-md-6">
               
                <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" v-model="formvalue.fname" placeholder="First Name">
                </div>

               
                <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" v-model="formvalue.lname" placeholder="Last Name">
                </div>

                
                <div class="mb-3">
                  <label class="form-label">Group Name</label>
                  <select class="form-control" v-model="formvalue.gid">
                    <option value="" disabled>Select Group</option>
                   
                    <option v-for="g in getgroups" :key="g.gid" :value="g.gid">
                      {{ g.gname }}
                    </option>
                  </select>
                </div>
                <div class="mb-3">
              <label class="form-label">Member Image</label>
              
              <input type="file"  class="form-control" accept="image/*"  @change="onImageChange"/><br>
              <img :src="`/storage/${formvalue.image}`" class="thumb-xxl rounded-circle"/>
              </div>

                
              </div>

             
              <div class="col-md-6">
               
                <div class="mb-3">
                  <label class="form-label">Telephone</label>
                  <input type="text" class="form-control" v-model="formvalue.tele" placeholder="Telephone">
                </div>

               
                <div class="mb-3">
                  <label class="form-label">Email Address</label>
                  <input type="email" class="form-control" v-model="formvalue.email" placeholder="Email Address">
                </div>

              
                <div class="mb-3">
                  <label class="form-label">Address</label>
                  <input type="text" class="form-control" v-model="formvalue.address" placeholder="Address">
                </div>

                
                <div class="mb-3">
                  <label class="form-label">Gender</label>
                  <select class="form-control" v-model="formvalue.gender">
                    <option value="" disabled>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>

            </div>

           
            <div class="row mt-3">
              <div class="col text-end">
                <button type="button" class="btn btn-primary" @click="updatedmemberbtn">
                  <span v-if="!saveloader">Save Member</span>
                  <span v-if="saveloader">Saving...</span>
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </form>
</template>

  

<script setup>
import { onMounted } from "vue";
import { useMemberStores } from "../../store/members_store";
import { storeToRefs } from "pinia";

// ALWAYS create store ONCE
const memberStore = useMemberStores();

// Reactive state
const { formvalue,saveloader,showErrro, Erromsg ,getgroups} = storeToRefs(memberStore);

// Actions
const { getmemberid, updatedmember,getgrouplist } = memberStore;

function onImageChange(e) {
  formvalue.value.image = e.target.files[0];
}


// Props
const props = defineProps({
    id: {
        type: String,
        default: ''
    }
});

onMounted(() => {
    getmemberid(props.id);
});

// Update button
function updatedmemberbtn() {
  const formData = new FormData();

  formData.append("fname", formvalue.value.fname);
  formData.append("lname", formvalue.value.lname);
  formData.append("gid", formvalue.value.gid);
  formData.append("tele", formvalue.value.tele);
  formData.append("email", formvalue.value.email);
  formData.append("address", formvalue.value.address);
  formData.append("gender", formvalue.value.gender);

  // ✅ Append image ONLY if user selected a new one
  if (formvalue.value.image instanceof File) {
    formData.append("image", formvalue.value.image);
  }

  updatedmember(formData, formvalue.value.id);
}



getgrouplist();
</script>


  
  <style scoped>
  .text-danger {
    font-size: 0.875rem;
  }
  </style>




  