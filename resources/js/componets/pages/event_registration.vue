<template>
  <div class="container mt-5">
    <div class="row align-items-center">

      <!-- LEFT IMAGE -->
      <div class="col-md-6 d-none d-md-block">
        <img
          src="@/assets/images/user-bg-pattern.png"
          class="img-fluid rounded object-fit-cover"
          alt="Event"
        />
      </div>

      <!-- RIGHT CONTENT -->
      <div class="col-md-6 d-none d-md-block">

        <!-- 🔍 VERIFICATION FORM -->
        <div v-if="step === 'verify'" class="card p-4 mb-4">
          <h4 class="mb-3">Verify Registration</h4>

        <input type="tel" v-model="identifier" class="form-control mb-3" placeholder="Phone number"
      maxlength="10" inputmode="numeric"  @input="identifier = identifier.replace(/[^0-9]/g, '').slice(0, 10)"/>


          <button
            class="btn btn-primary w-100"
            :disabled="loading"
            @click="verifyParticipant"
          >
            {{ loading ? "Verifying..." : "Verify" }}
          </button>
        </div>

        <!-- ✅ VERIFIED -->
        <div v-if="step === 'verified'" class="card p-4 text-center">
        <h3 class="text-success mb-3">Participant Verified</h3>

  <div class="mb-3">
    <p><strong>Full Name:</strong> {{ verifiedData.full_name }}<br>
    <strong>Phone:</strong> {{ verifiedData.phone_number }}<br>
   <strong>Gender:</strong> {{ verifiedData.gender }}<br>
   <strong>Verified?</strong> {{ verifiedData.attended===1?'Yes':'No' }}
   </p>
  </div>

  <div class="d-flex justify-content-center">
  <button
    v-if="Number(verifiedData.attended) === 1"
    class="btn btn-success"  @click="refreshPage"> Yeah!, you have been here
    </button>

  <button
    v-else
    class="btn btn-primary w-50"
    :disabled="loading"
    @click="confirmParticipant"
  >
    {{ loading ? "Confirming..." : "Yes, it's me" }}
  </button>
</div>

</div>

        <!-- 📝 REGISTRATION FORM -->
        <div v-if="step === 'register'" class="card p-4">
          <h4 class="mb-3">Register Participant</h4>

          <form @submit.prevent="submitForm">
            <div
              v-for="(field, index) in form.fields"
              :key="index"
              class="mb-3"
            >
              <label class="form-label">
                {{ field.label }}
                <span v-if="field.is_required">*</span>
              </label>

              <input
                v-if="field.type !== 'select'"
                :type="field.type === 'phone' ? 'text' : field.type"
                class="form-control"
                v-model="formData[field.name]"
                :required="field.is_required"
              />

              <select
                v-if="field.type === 'select'"
                class="form-select"
                v-model="formData[field.name]"
                :required="field.is_required"
              >
                <option value="">Select</option>
                <option
                  v-for="opt in field.options"
                  :key="opt"
                  :value="opt"
                >
                  {{ opt }}
                </option>
              </select>
            </div>

            <button
              type="submit"
              class="btn btn-success w-100"
              :disabled="loading"
            >
              {{ loading ? "Submitting..." : "Submit Registration" }}
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
    import { storeToRefs } from "pinia";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";
import { menustore } from "@/store/menus.js";
import Swal from "sweetalert2";

const route = useRoute();
const eventCode = route.params.id;
// Pinia store
const menuStore = menustore();
const { user_id } = storeToRefs(menuStore);

const step = ref("verify"); // verify | register | verified
const identifier = ref("");
const verifiedData = ref(null);
const loading = ref(false);

// Registration form data
const form = ref({ fields: [] });
const formData = ref({});




//refresh page
function refreshPage() {
  window.location.reload();
}



// Load registration form from backend
async function loadRegistrationForm() {
  try {
    const res = await axios.get(`/api/events/publicform/${eventCode}`);
    form.value.fields = res.data.fields;

    // Prefill identifier if phone/email exists
    formData.value = {};
    res.data.fields.forEach(f => {
      if (f.name === "phone_number" || f.name === "email_address") {
        formData.value[f.name] = identifier.value;
      } else {
        formData.value[f.name] = "";
      }
    });
  } catch (err) {
    Swal.fire("Error", "Registration form not found for this event", "error");
  }
}

// Verify participant
async function verifyParticipant() {
  if (!identifier.value) {
    Swal.fire("Error", "Enter phone or email", "error");
    return;
  }

  loading.value = true;

  try {
    const res = await axios.post(`/api/events/verify/${eventCode}`, {
      identifier: identifier.value
    });

  if (res.data.found) {
  verifiedData.value = {
    attended: res.data.data.attended,
    event_form_id: res.data.data.event_form_id,

    // 🔑 store the identifier used for verification
    identifier: identifier.value,

    full_name: res.data.data.full_name,
    phone_number: res.data.data.phone_number,
    email_address: res.data.data.email_address,
    gender: res.data.data.gender
  };

  step.value = "verified";
  Swal.fire("VERIFIED", "Hurray, we found you!", "success");
} else {
      step.value = "register";
      Swal.fire("Oops!", "Registration not found, register now!", "info");

      await loadRegistrationForm();
    }
  } catch {
    Swal.fire("Error", "Verification failed", "error");
  } finally {
    loading.value = false;
  }
}

async function confirmParticipant() {
  if (!verifiedData.value?.event_form_id || !verifiedData.value?.phone_number) {
    Swal.fire("Error", "Cannot confirm attendance. Missing data.", "error");
    return;
  }

  loading.value = true;

  try {
    const res = await axios.post(
      `/api/events/confirm/${verifiedData.value.event_form_id}`,
      {
        phone_number: verifiedData.value.phone_number
      }
    );

    Swal.fire("Confirmed", res.data.msg, "success");

    // Reset UI
    step.value = "verify";
    verifiedData.value = null;
    identifier.value = "";
  } catch (err) {
    Swal.fire("Error", "Failed to confirm attendance", "error");
  } finally {
    loading.value = false;
  }
}





// Submit registration
async function submitForm() {
  if (!formData.value) return;

  loading.value = true;

  // Build the payload
  const payload = {
    ...formData.value,
    user_id: user_id.value // from Pinia store
  };

  // Log payload to confirm user_id is included
  console.log("Submitting payload:", payload);

  try {
    const res = await axios.post(
      `/api/events/saveregistration/${eventCode}`,
      payload
    );

    Swal.fire("Success", "Registration completed", "success");

    // Reset form
    Object.keys(formData.value).forEach(k => formData.value[k] = "");
    step.value = "verify";
    identifier.value = "";
  } catch (err) {
    console.log("Error details:", err.response?.data || err);
    Swal.fire("Error", "Failed to submit registration", "error");
  } finally {
    loading.value = false;
  }
}




</script>

<style scoped>
.card {
  max-width: 800px;
  margin: 0 auto;
  border-radius: 8px;
}

</style>
