<template>
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-xl-8 col-lg-10">
        <div class="card shadow-sm">
          <!-- Header -->
          <div class="card-header">
            <h4 class="card-title mb-0">Add System User</h4>
          </div>

          <!-- Body -->
          <div class="card-body p-4">
            <!-- Error message -->
            <div v-if="showErrro" class="alert alert-danger">
              {{ Erromsg }}
            </div>

            <!-- Full Name -->
            <div class="mb-3">
              <label class="form-label">
                Full Name <span class="text-danger">*</span>
              </label>
              <input type="text"  class="form-control"  v-model="groupform.name" placeholder="David Dev" />
            </div>

            <!-- Username -->
            <div class="mb-3">
              <label class="form-label">
                Username <span class="text-danger">*</span>
              </label>
              <input  type="text" class="form-control" v-model="groupform.username" placeholder="david.dev" />
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label class="form-label">
                Email Address
              </label>
              <input  type="email"  class="form-control" v-model="groupform.email"  placeholder="you@example.com"  />
            </div>

            <!-- User Type -->
            <div class="mb-3">
              <label class="form-label">
                Account Type <span class="text-danger">*</span>
              </label>
              <select class="form-select" v-model="groupform.utype">
                <option disabled value="">Select user type</option>
                <option value="1">Super Admin</option>
                <option value="2">Admin</option>
                <option value="3">User</option>
              </select>
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label class="form-label">
                Password <span class="text-danger">*</span>
              </label>
              <input type="password"  class="form-control" v-model="groupform.password" placeholder="••••••••" />

              <!-- Strength Bar -->
              <div class="password-bar mt-2">
                <div v-for="n in 4" :key="n" class="strong-bar" :class="{ active: passwordStrength >= n }">

                </div>
              </div>

              <small class="text-muted"> Strength:
                <strong>{{ strengthText }}</strong>
              </small>
            </div>

            <!-- Submit -->
            <div class="d-grid mt-4">
              <button  type="button" class="btn btn-success fw-semibold py-2" :disabled="saveloader || passwordStrength < 3"  @click="saveuserbtn">
                <span v-if="saveloader">
                  <span class="spinner-border spinner-border-sm me-2"></span>
                  Saving...
                </span>
                <span v-else> Create Account</span>
              </button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { storeToRefs } from "pinia";
import { useSaveDataStore } from "../../store/SaveDataStore";

/* Store */
const store = useSaveDataStore();
const { saveloader, showErrro, Erromsg } = storeToRefs(store);
const { saveuser } = store;

/* Form */
const groupform = ref({
  name: "",
  username: "",
  email: "",
  password: "",
  utype: "",
});

/* Submit */
function saveuserbtn() {
  const formData = new FormData();
  Object.entries(groupform.value).forEach(([key, value]) => {
    formData.append(key, value);
  });

  saveuser(formData);
}

/* Password strength */
const passwordStrength = computed(() => {
  let score = 0;
  const val = groupform.value.password;

  if (!val) return 0;
  if (val.length >= 8) score++;
  if (/[A-Z]/.test(val)) score++;
  if (/[0-9]/.test(val)) score++;
  if (/[^A-Za-z0-9]/.test(val)) score++;

  return score;
});

const strengthText = computed(() => {
  return ["Very Weak", "Weak", "Fair", "Strong", "Very Strong"][passwordStrength.value];
});
</script>

<style scoped>
.password-bar {
  display: flex;
  gap: 6px;
}

.strong-bar {
  flex: 1;
  height: 6px;
  background: #e0e0e0;
  border-radius: 3px;
  transition: background-color 0.3s ease;
}

.strong-bar.active {
  background-color: #28a745;
}
</style>
