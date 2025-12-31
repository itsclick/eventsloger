<template>
  <div class="container-fluid">
    <div class="row g-0">

      <!-- LEFT IMAGE AS FULL BACKGROUND -->
      <div
        class="col-md-6 d-none d-md-block left-image"
      >
        <img
          v-if="formvalue?.image"
          :src="`/storage/${formvalue.image}`"
          class="img-fluid h-100 w-100"
          alt="Event"
        />
        <img
          v-else
          src="@/assets/images/user-bg-pattern.png"
          class="img-fluid h-100 w-100"
          alt="Event"
        />
      </div>

      <!-- RIGHT COLUMN WITH CENTERED CARD -->
      <div class="col-md-6 d-flex justify-content-center align-items-center p-4">

        <div class="w-100" style="">

          <!-- 🔍 VERIFY -->
          <div v-if="step === 'verify'" class="card p-4 shadow">
            <h4 class="mb-3 text-center">Verify Registration</h4>

            <input
              type="tel"
              v-model="identifier"
              class="form-control mb-3"
              placeholder="Phone number"
              maxlength="10"
              inputmode="numeric"
              @input="identifier = identifier.replace(/[^0-9]/g, '').slice(0, 10)"
            />

            <button
              class="btn btn-primary w-100"
              :disabled="loading"
              @click="verifyParticipant"
            >
              {{ loading ? "Verifying..." : "Verify" }}
            </button>
          </div>

          <!-- ✅ VERIFIED -->
          <div v-if="step === 'verified' && verifiedData" class="card p-4 text-center shadow">
            <h3 class="text-success mb-3">Participant Verified</h3>

            <p>
              <strong>Full Name:</strong> {{ verifiedData.full_name }}<br>
              <strong>Phone:</strong> {{ verifiedData.phone_number }}<br>
              <strong>Gender:</strong> {{ verifiedData.gender }}<br>
              <strong>Verified?</strong> {{ verifiedData.attended === 1 ? "Yes" : "No" }}
            </p>

            <div class="d-flex justify-content-center">
              <button
                v-if="Number(verifiedData.attended) === 1"
                class="btn btn-success"
                @click="refreshPage"
              >
                Yeah! You have been here
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

          <!-- 📝 REGISTER -->
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
                  class="form-control"
                  v-model="formData[field.name]"
                  :required="field.is_required"
                />

                <select
                  v-else
                  class="form-select"
                  v-model="formData[field.name]"
                  :required="field.is_required"
                >
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

        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
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

/* STATE */
const step = ref("verify");
const identifier = ref("");
const verifiedData = ref(null);
const loading = ref(false);
const form = ref({ fields: [] });
const formData = ref({});

/* LOAD EVENT */
onMounted(() => {
  viewDataStore.geteventbyid(eventCode);
});

/* REFRESH PAGE */
function refreshPage() {
  window.location.reload();
}

/* LOAD FORM */
async function loadRegistrationForm() {
  try {
    const res = await axios.get(`/api/events/publicform/${eventCode}`);
    form.value.fields = res.data.fields;

    formData.value = {};
    res.data.fields.forEach(f => {
      formData.value[f.name] =
        f.name === "phone_number" || f.name === "email_address"
          ? identifier.value
          : "";
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
    const res = await axios.post(`/api/events/verify/${eventCode}`, {
      identifier: identifier.value
    });

    if (res.data.found) {
      verifiedData.value = {
        ...res.data.data,
        identifier: identifier.value
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
    const res = await axios.post(
      `/api/events/confirm/${verifiedData.value.event_form_id}`,
      { phone_number: verifiedData.value.phone_number }
    );

    Swal.fire("Confirmed", res.data.msg, "success");
    refreshPage();
  } catch {
    Swal.fire("Error", "Confirmation failed", "error");
  } finally {
    loading.value = false;
  }
}

/* SUBMIT REGISTRATION */
async function submitForm() {
  loading.value = true;

  try {
    await axios.post(`/api/events/saveregistration/${eventCode}`, {
      ...formData.value,
      user_id: user_id.value
    });

    Swal.fire("Success", "Registration completed", "success");
    refreshPage();
  } catch (err) {
    Swal.fire("Error", "Registration failed", "error");
  } finally {
    loading.value = false;
  }
}
</script>

<style scoped>
.left-image {
  height: 100vh;
  overflow: hidden;
}

.left-image img {
  object-fit: cover;
  width: 100%;
  height: 100%;
}

.card {
  border-radius: 10px;
}
</style>
