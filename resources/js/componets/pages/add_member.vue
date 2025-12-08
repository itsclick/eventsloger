<template>
  <form>
    <div class="row justify-content-center">
      <div class="col-md-12 col-lg-12">
        <h5 class="mb-3">Adding New Member</h5>

        <!-- Error Alert -->
        <div v-if="showErrro" class="alert alert-danger border-0" role="alert">
          <ul>
            <li v-for="err in Erromsg.errors" :key="err">{{ err }}</li>
          </ul>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="row">

              <!-- Left Column -->
              <div class="col-md-6">
                <!-- First Name -->
                <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" v-model="memberform.fname" placeholder="First Name">
                </div>

                <!-- Last Name -->
                <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" v-model="memberform.lname" placeholder="Last Name">
                </div>

                <!-- Group Name -->
                <div class="mb-3">
                  <label class="form-label">Group Name</label>
                  <select class="form-control" v-model="memberform.gid">
                    <option value="" disabled>Select Group</option>
                    <option v-for="g in getgroups" :key="g.gid" :value="g.gid">
                      {{ g.gname }}
                    </option>
                  </select>
                </div>
              </div>

              <!-- Right Column -->
              <div class="col-md-6">
                <!-- Telephone -->
                <div class="mb-3">
                  <label class="form-label">Telephone</label>
                  <input type="text" class="form-control" v-model="memberform.tele" placeholder="Telephone">
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label class="form-label">Email Address</label>
                  <input type="email" class="form-control" v-model="memberform.email" placeholder="Email Address">
                </div>

                <!-- Address -->
                <div class="mb-3">
                  <label class="form-label">Address</label>
                  <input type="text" class="form-control" v-model="memberform.address" placeholder="Address">
                </div>

                <!-- Gender -->
                <div class="mb-3">
                  <label class="form-label">Gender</label>
                  <select class="form-control" v-model="memberform.gender">
                    <option value="" disabled>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>

            </div>

            <!-- Save Button Row -->
            <div class="row mt-3">
              <div class="col text-end">
                <button type="button" class="btn btn-primary" @click="savememberbtn">
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
import { onMounted,ref } from "vue";
import axios from "axios";
  import { useMemberStores } from "../../store/members_store";
  import { storeToRefs } from 'pinia';
  import { useRouter } from "vue-router";
  


 



  //varibale here
  const { saveloader,showErrro, Erromsg,getgroups} = storeToRefs(useMemberStores());

  //functions below
  const { getgrouplist,savemembers } = useMemberStores();


 

  
  
  
  
  // FORM DATA
  const memberform = ref({
    
    fname: "",
    lname: "",
    tele: "",
    email: "",
    address: "",
    gender: "",
    gid: "",
  });
  
  
  function savememberbtn(){
    const formData = new FormData()

formData.append("fname", memberform.value.fname)
formData.append("lname", memberform.value.lname)
formData.append("tele", memberform.value.tele)
formData.append("email", memberform.value.email)
formData.append("address", memberform.value.address)
formData.append("gender", memberform.value.gender)
formData.append("gid", memberform.value.gid)
savemembers(formData);
  }
  
  

  onMounted(() => {
    getgrouplist();
});
  
  </script>
  
  <style scoped>
  .text-danger {
    font-size: 0.875rem; /* smaller text for error */
  }
  </style>
  