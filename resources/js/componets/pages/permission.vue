<template>




    
<!-- <code>updated :{{ selectedPermissions }}</code> -->


<div class="card-body pt-0">
  <div class="table-responsive">
    <table class="table table-striped mb-0">
      
      <!-- TABLE HEADER -->
      <thead class="table-dark">
        <tr>
          <th>Menu id</th>
          <th>Menu name</th>
          <th>Description</th>
          <th>Add</th>
          <th>Edit</th>
          <th>Delete</th>
          <th>Details</th>
           <th>Add Form</th>
           <th>Print</th>
        </tr>
      </thead>

      <!-- TABLE BODY -->
      <tbody>
        <!-- CHECK ALL ROW -->
        <tr>
          <td colspan="3"></td>

          <td>
            <input type="checkbox" v-model="allAdd" :true-value="1" :false-value="0" id="allAdd" class="form-check-input"/>  <label for="allAdd">Check All</label>
          </td>

          <td>
            <input type="checkbox" v-model="allEdit" :true-value="1" :false-value="0" id="allEdit" class="form-check-input" /> <label for="allEdit">Check All</label>
          </td>

          <td>
            <input type="checkbox" v-model="allDelete" :true-value="1" :false-value="0" id="allDelete" class="form-check-input" /> <label for="allDelete">Check All</label>
          </td>

          <td>
            <input type="checkbox" v-model="alldetails" :true-value="1" :false-value="0" id="alldetails"  class="form-check-input"/> <label for="alldetails">Check All</label>
          </td>
          <td>
            <input type="checkbox" v-model="alladdform" :true-value="1" :false-value="0" id="alladdform"  class="form-check-input"/> <label for="alladdform">Check All</label>
          </td>
          <td> <input type="checkbox" v-model="allprintbtn" :true-value="1" :false-value="0" id="allprintbtn"  class="form-check-input"/> <label for="allprintbtn">Check All</label></td>
        </tr>

        <!-- PERMISSION ROWS -->
        <tr v-for="m in userpermission" :key="m.id">
          <td>{{ m.menu_id }}</td>
          <td>{{ m.menu_name }}</td>
          <td>{{ m.des }}</td>

          <td>
            <input type="checkbox"  v-model="m.menu_add" :true-value="1" :false-value="0"  :id="`1_${m.menu_id}`" class="form-check-input"/>
          </td>

          <td>
            <input type="checkbox" v-model="m.menu_edit" :true-value="1" :false-value="0"  :id="`2_${m.menu_id}`" class="form-check-input"/>
          </td>

          <td>
            <input type="checkbox"  v-model="m.menu_delete" :true-value="1" :false-value="0" :id="`3_${m.menu_id}`" class="form-check-input"/>
          </td>

          <td><input type="checkbox" v-model="m.menu_details" :true-value="1" :false-value="0" :id="`4_${m.menu_id}`" class="form-check-input" />
          </td>
          <td><input type="checkbox" v-model="m.addform" :true-value="1" :false-value="0" :id="`5_${m.menu_id}`" class="form-check-input" />
          </td>
          <td><input type="checkbox" v-model="m.printbtn" :true-value="1" :false-value="0" :id="`6_${m.printbtn}`" class="form-check-input" />
          </td>
        </tr>
      </tbody>

    </table>
  </div>
</div>


<br><br>
<div align="right"><button @click="setpermitionbtn" class="btn btn-success">Update </button></div>


</template>


<script setup>
import { onMounted ,computed,watch,ref} from "vue";
  import { useMemberStores } from "../../store/members_store";
  import { storeToRefs } from 'pinia';



  //varibale here
const { userpermission } = storeToRefs(useMemberStores());

//functions below
const {  getuserpermission,updatepermision } = useMemberStores();

const alldetails = ref(0);
const allAdd = ref(0);
const allEdit = ref(0);
const allDelete = ref(0);
const alladdform = ref(0);
const allprintbtn = ref(0);



const props = defineProps({
        user_id:{
            type:String,
            default: ''
        }
     })


     onMounted(async () => {
       
        getuserpermission(props.user_id);
    })


    //using computed means that you will the changes in real time
    //its is monitoring the permision with the condition only when the permission is equal 1
    const selectedPermissions = computed(() => {
        return userpermission.value.filter(row =>
            row.menu_details === 1 ||
            row.menu_add === 1 ||
            row.menu_edit === 1 ||
          row.menu_delete === 1 ||
          row.addform === 1 ||
            row.printbtn===1
        );
    });


watch(allAdd, (newVal) => {
userpermission.value.forEach(row => row.menu_add = newVal);
});
watch(allEdit, (newVal) => {
userpermission.value.forEach(row => row.menu_edit = newVal);
});
watch(allDelete, (newVal) => {
userpermission.value.forEach(row => row.menu_delete = newVal);
});
watch(alldetails, (newVal) => {
userpermission.value.forEach(row => row.menu_details = newVal);
});
watch(alladdform, (newVal) => {
userpermission.value.forEach(row => row.addform = newVal);
});
watch(allprintbtn, (newVal) => {
userpermission.value.forEach(row => row.printbtn = newVal);
});

function setpermitionbtn(){
   
    let formMain = new FormData();
    formMain.append("user_id", props.user_id ); 
    formMain.append("permdata", JSON.stringify(selectedPermissions.value) );
    updatepermision(formMain);



    
}
   





</script>

<style lang="css" scoped>

</style>