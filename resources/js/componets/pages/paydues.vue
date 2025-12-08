<template>
    <div>
      <!-- Heading -->
      <h5 v-if="paydues">
        Paying dues for Member: {{ paydues.mid }} {{ paydues.fname }} {{ paydues.lname }}
      </h5>
      <h4 v-else>Loading member...</h4>
  
      <!-- Form -->
      <form v-if="paydues">
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-12">
            <div class="card">
              <div class="card-body pt-0">
  
                <!-- Member Info -->
                <div class="mb-3">
                  <label class="form-label">Member ID</label>
                  <input type="text" class="form-control" :value="paydues.mid" readonly>
                </div>
  
                <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" :value="paydues.fname" readonly>
                </div>
  
                <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" :value="paydues.lname" readonly>
                </div>
  
                <div class="mb-3">
                  <label class="form-label">Group ID</label>
                  <input type="text" class="form-control" :value="paydues.gid" readonly>
                </div>
  
                <!-- Dues Form -->
                <div class="mb-3">
                  <label class="form-label">Dues ID</label>
                  <input type="text" class="form-control" v-model="duesform.did" placeholder="Dues ID">
                </div>
  
                <div class="mb-3">
                  <label class="form-label">Amount</label>
                  <input type="text" class="form-control" v-model="duesform.amt" placeholder="Amount">
                  <div v-if="errors.amt" class="text-danger mt-1">{{ errors.amt }}</div>
                </div>
  
                <div class="mb-3">
                  <label class="form-label">Payment Date</label>
                  <input type="date" class="form-control" v-model="duesform.pdate">
                  <div v-if="errors.pdate" class="text-danger mt-1">{{ errors.pdate }}</div>
                </div>
  
                <div class="mb-3">
                  <label class="form-label">Payment Month</label>
                  <input type="month" class="form-control" v-model="duesform.pmonth">
                </div>
  
                <!-- Save Button -->
                <button
                  type="button"
                  class="btn btn-primary"
                  @click="saveduesbtn"
                >
                  Save Dues
                </button>
  
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, reactive, onMounted } from "vue";
  import { useRoute, useRouter } from "vue-router";
  import axios from "axios";
  import Swal from "sweetalert2";
  
  // Router & Route
  const route = useRoute();
  const router = useRouter();
  const id = route.params.id;
  
  // Member info
  const paydues = ref(null);
  
  // Toast notification
  const toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
  });
  
  // Form errors
  const errors = ref({});
  
  // Reactive dues form
  const duesform = reactive({
    did: "",
    mid: "",
    gid: "",
    amt: "",
    pdate: "",
    pmonth: "",
  });
  
  // Fetch member info from API
  const getmemberidfrapi = async () => {
    try {
      const res = await axios.get(`/api/membership/memberbyid/${id}`);
      paydues.value = res.data.data;
  
      // Pre-fill form fields
      duesform.mid = paydues.value.mid;
      duesform.gid = paydues.value.gid;
    } catch (err) {
      console.error(err);
      Swal.fire("Error", "Failed to load member info", "error");
    }
  };
  
  // Form validation
  const validateForm = () => {
    errors.value = {};
    let valid = true;
  
    if (!duesform.amt) {
      errors.value.amt = "Amount is required";
      valid = false;
    }
  
    if (!duesform.pdate) {
      errors.value.pdate = "Payment Date is required";
      valid = false;
    }
  
    return valid;
  };
  
  // Save dues
  const saveduesbtn = async () => {
    if (!validateForm()) return;
  
    console.log("Submitting data:", duesform); // ✅ Reactive object
  
    try {
      const res = await axios.post("/api/dues/savedues", duesform);
  
      toast.fire({
        icon: "success",
        title: res.data.msg,
      });
  
      router.push("/dues");
    } catch (err) {
      if (err.response && err.response.status === 422) {
        errors.value = err.response.data.errors; // Laravel validation errors
        console.log("Validation errors:", errors.value);
      } else {
        console.error(err);
        Swal.fire("Error", "Failed to save dues", "error");
      }
    }
  };
  
  onMounted(() => {
    getmemberidfrapi();
  });
  </script>
  
  <style scoped>
  .text-danger {
    font-size: 0.875rem;
  }
  </style>
  