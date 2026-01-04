<template>
  <div class="container-fluid" :style="bgStyle">
    <div class="row g-0">

      <!-- LEFT BACKGROUND -->
      <div class="col-md-6 d-none d-md-block left-image"></div>

      <!-- RIGHT COLUMN -->
      <div class="col-md-4 d-flex justify-content-center align-items-center p-4">
        <div class="w-100">

          <!-- VERIFY -->
          <div v-if="step === 'verify'" class="card p-4 shadow">
            <h4 class="card-title">Participant Verification</h4>
            <hr />

            <input type="tel"  v-model="identifier" class="form-control mb-3" placeholder="Phone number"
              maxlength="10" inputmode="numeric"  @input="identifier = identifier.replace(/[^0-9]/g, '').slice(0, 10)"  />

            <button
              class="btn btn-primary w-100"
              :disabled="loading"
              @click="verifyParticipant"
            >
              {{ loading ? "Verifying..." : "Verify" }}
            </button>
          </div>

          <!-- VERIFIED -->
                <div v-if="step === 'verified' && verifiedData" class="card shadow border-0">

                <!-- Header -->
                <div class="card-header bg-success text-white text-center">
                <h5 class="mb-0">
                <i class="bi bi-check-circle-fill me-2"></i>
                Participant Verified
                </h5>
                </div>

                <!-- Body -->
                <div class="card-body">

                <!-- Info Tiles -->
                <div class="row g-3 mb-3">

                <div class="col-12">
                <div class="border rounded p-3 bg-light">
                <small class="text-muted">Full Name</small>
                <div class="fw-bold fs-5">
                {{ verifiedData.full_name || '—' }}
                </div>
                </div>
                </div>

                <div class="col-md-6">
                <div class="border rounded p-3 bg-light">
                <small class="text-muted">Phone Number</small>
                <div class="fw-semibold">
                {{ verifiedData.phone_number }}
                </div>
                </div>
                </div>

                <div class="col-md-6">
                <div class="border rounded p-3 bg-light">
                <small class="text-muted">Gender</small>
                <div class="fw-semibold">
                {{ verifiedData.gender || '—' }}
                </div>
                </div>
                </div>

                <div class="col-12">
                <div
                class="border rounded p-3 text-center"
                :class="verifiedData.attended === 1 ? 'bg-success text-white' : 'bg-warning-subtle'"
                >
                <strong>Status:</strong>
                {{ verifiedData.attended === 1 ? 'Attendance Confirmed' : 'Not Yet Confirmed' }}
                </div>
                </div>

                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-center gap-2">

                <button
                v-if="Number(verifiedData.attended) === 1"
                class="btn btn-success px-4"
                @click="refreshPage"
                >
                ✔ Already Confirmed
                </button>

                <button
                v-else
                class="btn btn-primary px-4"
                :disabled="loading"
                @click="confirmParticipant"
                >
                {{ loading ? "Confirming..." : "Yes, it’s me" }}
                </button>

                </div>

                </div>
                </div>


          <!-- REGISTER -->
          <div v-if="step === 'register'" class="card p-4 shadow">
            <h4 class="mb-3">Register Participant</h4>

            <form @submit.prevent="submitForm">
              <div v-for="(field, index) in form.fields" :key="index" class="mb-3">
                <label class="form-label">
                  {{ field.label }}
                  <span v-if="field.is_required">*</span>
                </label>

                <input
                  v-if="field.type !== 'select'"
                  :type="field.type === 'phone' ? 'text' : field.type"
                  class="form-control" v-model="formData[field.name]" :required="field.is_required" />

                <select  v-else class="form-select" v-model="formData[field.name]"  :required="field.is_required">
                  <option value="">Select</option>
                  <option v-for="opt in field.options" :key="opt" :value="opt">
                    {{ opt }}
                  </option>
                </select>
              </div>

              <button type="submit" class="btn btn-success w-100" :disabled="loading">
                {{ loading ? "Submitting..." : "Submit Registration" }}
              </button>
            </form>
          </div>



          <!-- OTP VERIFICATION -->
          <div v-if="step === 'otp'" class="card p-4 shadow">
          <h4 class="card-title">Enter OTP</h4>
          <hr />
          <p class="mb-3">Enter the 6-digit code sent to your phone</p>

          <div class="d-flex justify-content-between mb-3 otp-inputs">
          <input v-for="(digit, index) in otpDigits" :key="index" type="text" maxlength="1"
          class="form-control otp-box text-center"  v-model="otpDigits[index]" @input="onOtpInput(index, $event)"
          @keydown.backspace="onOtpBackspace(index, $event)" ref="otpInputs" />
          </div>

          <button
          class="btn btn-primary w-100"
          :disabled="otpDigits.includes('') || loading" @click="submitOtp" >
          {{ loading ? "Verifying..." : "Verify OTP" }}
          </button>

          <p v-if="otpMessage" :class="{'text-success': otpVerified, 'text-danger': !otpVerified}" class="mt-2">
          {{ otpMessage }}
          </p>
            <p class="mt-2 text-center">
          Didn't receive OTP?
          <button class="btn btn-link p-0" :disabled="resendingOtp" @click="resendOtp">
          Resend
          </button>
          </p>
          </div>


        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed ,reactive, nextTick} from "vue";
import { useRoute } from "vue-router";
import axios from "axios";
import Swal from "sweetalert2";
import { storeToRefs } from "pinia";

import { menustore } from "@/store/menus.js";
import { useViewDataStore } from "@/store/ViewDataStore.js";

/* ROUTE */
const route = useRoute();
const eventCode = route.params.id;

/* STORES */
const menuStore = menustore();
const viewDataStore = useViewDataStore();
const { formvalue } = storeToRefs(viewDataStore);
const { user_id } = storeToRefs(menuStore);

/*  OTP */

const otpDigits = reactive(["", "", "", "", "", ""]);
const otpInputs = ref([]);
const otpMessage = ref("");
const otpVerified = ref(false);

function onOtpInput(index, event) {
  const value = event.target.value.replace(/\D/g, ""); // only digits
  otpDigits[index] = value;
  if (value && index < otpDigits.length - 1) {
    nextTick(() => otpInputs.value[index + 1].focus());
  }
}

function onOtpBackspace(index, event) {
  if (!otpDigits[index] && index > 0) {
    nextTick(() => otpInputs.value[index - 1].focus());
  }
}


/* STATE */
const step = ref("verify");
const resendingOtp = ref(false);
const identifier = ref("");
const verifiedData = ref(null);
const loading = ref(false);
const form = ref({ fields: [] });
const formData = ref({});
const eventId = ref(null); 

/* BACKGROUND STYLE (VITE SAFE) */
const bgStyle = computed(() => {
  const defaultBg = new URL("@/assets/images/user-bg-pattern.png",
    import.meta.url
  ).href;

  return {
    backgroundImage: `url(${
      formvalue.value?.image
        ? `/storage/${formvalue.value.image}`
        : defaultBg
    })`,
    backgroundSize: "cover",
    backgroundPosition: "center",
    backgroundRepeat: "no-repeat",
    minHeight: "100vh"
  };
});

/* LOAD EVENT */
onMounted(() => {
  viewDataStore.geteventbyid(eventCode);
});

/* REFRESH */
function refreshPage() {
  window.location.reload();
}

/* LOAD FORM */
async function loadRegistrationForm() {
  try {
    const res = await axios.get(`/api/events/publicform/${eventCode}`);

    eventId.value = res.data.event_id; // ✅ capture event_id
    console.log("Loaded event_id:", eventId.value);

    form.value.fields = res.data.fields;

    formData.value = {};
    res.data.fields.forEach(f => {
      formData.value[f.name] =
        f.name === "phone_number" ? identifier.value : ""; // Only phone_number prefilled
    });
  } catch {
    Swal.fire("Error", "Registration form not found", "error");
  }
}

/* VERIFY */
async function verifyParticipant() {
  if (!identifier.value) {
    Swal.fire("Error", "Enter phone number", "error");
    return;
  }

  loading.value = true;

  try {
    // ✅ Send phone_number instead of identifier
    const res = await axios.post(`/api/events/verify/${eventCode}`, {
      phone_number: identifier.value
    });

    if (res.data.found) {
      verifiedData.value = {
        ...res.data.data,
        phone_number: identifier.value
      };
      step.value = "verified";
      Swal.fire("Verified", "Hurray, we found you!", "success");
    } else {
      step.value = "register";
      await loadRegistrationForm();
      Swal.fire("Info", "Registration not found. Register now!", "info");
    }
  } catch {
    Swal.fire("Error", "Verification failed", "error");
  } finally {
    loading.value = false;
  }
}


/* CONFIRM */
async function confirmParticipant() {
  loading.value = true;

  try {
     const res = await axios.post(`/api/events/confirm/${eventCode}`, {
      phone_number: identifier.value,
    });

    Swal.fire("Confirmed", res.data.msg, "success");
    refreshPage();
  } catch {
    Swal.fire("Error", "Confirmation failed", "error");
  } finally {
    loading.value = false;
  }
}

/* SUBMIT */
async function submitForm() {
  if (!eventId.value) {
    Swal.fire("Error", "Event ID not loaded", "error");
    return;
  }

  loading.value = true;

  const payload = {
    event_id: eventId.value,
    ...formData.value,
    user_id: user_id.value,
  };

  try {
    await axios.post(`/api/events/saveregistration/${eventCode}`, payload);

    Swal.fire("Success", "Enter the OTP to complete registration.", "success");
    
    // Switch to OTP step
    step.value = "otp";
  } catch (err) {
    console.error(err);
    Swal.fire("Error", "Registration failed", "error");
  } finally {
    loading.value = false;
  }
}




//SUBMIT OTP
async function submitOtp() {
  const otp_code = otpDigits.join("");
  if (!otp_code || otp_code.length !== 6) {
    otpMessage.value = "Enter the full 6-digit OTP";
    otpVerified.value = false;
    return;
  }

  loading.value = true;
  otpMessage.value = "";

  try {
    const res = await axios.get(`/api/events/events/${eventCode}/verify-otp`, {
      params: {
        phone_number: identifier.value,
        otp_code,
      },
    });

    if (res.data.verified) {
      otpMessage.value = res.data.msg || "OTP verified successfully";
      otpVerified.value = true;
      step.value = "verified"; // move to verified step
      verifiedData.value = {
        full_name: res.data.full_name || verifiedData.value?.full_name,
        phone_number: identifier.value,
        ...res.data,
      };
    } else {
      otpMessage.value = res.data.msg || "Verification failed";
      otpVerified.value = false;
    }
  } catch (err) {
    otpMessage.value = err.response?.data?.msg || "OTP verification failed";
    otpVerified.value = false;
  } finally {
    loading.value = false;
  }
}


async function resendOtp() {
  if (!identifier.value) {
    Swal.fire("Error", "Phone number not available to resend OTP", "error");
    return;
  }

  resendingOtp.value = true;

  try {
    const res = await axios.post(`/api/events/events/${eventCode}/resend-otp`, {
      phone_number: identifier.value,
    });

    Swal.fire("Success", res.data.msg || "OTP resent successfully", "success");

    // Optionally, reset OTP fields
    otpDigits.forEach((_, i) => (otpDigits[i] = ""));
    otpVerified.value = false;
    otpMessage.value = "";
  } catch (err) {
    Swal.fire("Error", err.response?.data?.msg || "Failed to resend OTP", "error");
  } finally {
    resendingOtp.value = false;
  }
}




</script>

<style scoped>
.left-image {
  height: 100vh;
}

.card {
  border-radius: 10px;
}

.otp-inputs {
  gap: 8px;
}
.otp-box {
  width: 50px;
  height: 50px;
  font-size: 24px;
  border-radius: 6px;
  border: 1px solid #ccc;
}
.otp-box:focus {
  outline: none;
  border-color: #1081e0;
  box-shadow: 0 0 5px rgba(16,129,224,0.5);
}

</style>
