<template>

    <div class="container-xxl">
        <div class="row justify-content-center">


            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-9">
                                <p class="text-dark mb-0 fw-semibold fs-14">Total Member</p>
                                <h3 class="mt-2 mb-0 fw-bold">{{ countmembers }}</h3>
                            </div>
                            <!--end col-->
                            <div class="col-3 align-self-center">
                                <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="iconoir-book-stack h1 align-self-center mb-0 text-secondary"></i>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                        <p class="mb-0 text-truncate text-muted mt-3"><span class="text-success"></span>
                           Overall Membership</p>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>



            <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-9">
                                <p class="text-dark mb-0 fw-semibold fs-14">Total Male</p>
                                <h3 class="mt-2 mb-0 fw-bold">{{ countmale }}</h3>
                            </div>
                            <!--end col-->
                            <div class="col-3 align-self-center">
                                <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="iconoir-user h1 align-self-center mb-0 text-secondary"></i>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                        <p class="mb-0 text-truncate text-muted mt-3"><span class="text-success">{{ malePercent }}%</span>
                            of total membership</p>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>




            <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-9">
                                <p class="text-dark mb-0 fw-semibold fs-14">Total Female</p>
                                <h3 class="mt-2 mb-0 fw-bold">{{ countfemale }}</h3>
                            </div>
                            <!--end col-->
                            <div class="col-3 align-self-center">
                                <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="iconoir-user h1 align-self-center mb-0 text-secondary"></i>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                        <p class="mb-0 text-truncate text-muted mt-3"><span class="text-success">{{ femalePercent }}%</span>
                           of total membership</p>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>



            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                            <div class="col-9">
                                <p class="text-dark mb-0 fw-semibold fs-14">Total Groups</p>
                                <h3 class="mt-2 mb-0 fw-bold">{{ totalgroups }}</h3>
                            </div>
                            <!--end col-->
                            <div class="col-3 align-self-center">
                                <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                                    <i class="iconoir-user h1 align-self-center mb-0 text-secondary"></i>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                        <p class="mb-0 text-truncate text-muted mt-3"><span class="text-success"></span> All groups</p>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>





            <!--end col-->
        </div>
        <!--end row-->
        <div class="row justify-content-center">


            <div class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Membership Overview</h4>
                            
                            </div>
                        </div>
                     <canvas id="memberPieChart"></canvas>
                        <!--end row-->
                    </div>
                    <!--end card-header-->
                    <div class="card-body pt-0">
                        <div id="audience_overview" class="apex-charts"></div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>


            <!--end col-->
            <div class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Groups Overview</h4>
                            </div>
                        </div>
                <canvas id="memberPieChart"></canvas>
                        <!--end row-->
                    </div>
                    <!--end card-header-->
                    <div class="card-body pt-0">
                        <div id="audience_overview" class="apex-charts"></div>
                        
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-lg-6">
                <div class="card card-h-100">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Browser Used & Traffic Reports</h4>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-header-->
                    <div class="card-body pt-0">
                        <div class="table-responsive browser_users">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-top-0">Browser</th>
                                        <th class="border-top-0">Sessions</th>
                                        <th class="border-top-0">Bounce Rate</th>
                                        <th class="border-top-0">Transactions</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chrome</td>
                                        <td>10853<small class="text-muted">(52%)</small></td>
                                        <td> 52.80%</td>
                                        <td>566<small class="text-muted">(92%)</small></td>
                                    </tr>
                                    <!--end tr-->
                                    <tr>
                                        <td>Microsoft
                                            Edge</td>
                                        <td>2545<small class="text-muted">(47%)</small></td>
                                        <td> 47.54%</td>
                                        <td>498<small class="text-muted">(81%)</small></td>
                                    </tr>
                                    <!--end tr-->
                                    <tr>
                                        <td>Internet-Explorer</td>
                                        <td>1836<small class="text-muted">(38%)</small></td>
                                        <td> 41.12%</td>
                                        <td>455<small class="text-muted">(74%)</small></td>
                                    </tr>
                                    <!--end tr-->
                                    <tr>
                                        <td>Opera</td>
                                        <td>1958<small class="text-muted">(31%)</small></td>
                                        <td> 36.82%</td>
                                        <td>361<small class="text-muted">(61%)</small></td>
                                    </tr>
                                    <!--end tr-->
                                    <tr>
                                        <td>Chrome</td>
                                        <td>10853<small class="text-muted">(52%)</small></td>
                                        <td> 52.80%</td>
                                        <td>566<small class="text-muted">(92%)</small></td>
                                    </tr>
                                    <!--end tr-->
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                        <!--end /div-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            
            <!--end col-->
        </div>
        <!--end row-->
        
        <!--end row-->
    </div><!-- container -->

    <!--Start Rightbar-->
    <!--Start Rightbar/offcanvas-->
  
    <!--end Rightbar/offcanvas-->
    <!--end Rightbar-->
    <!--Start Footer-->
    
    <footer class="footer text-center text-sm-start d-print-none">
        <div class="container-xxl">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0 rounded-bottom-0">
                        <div class="card-body">
                            <p class="text-muted mb-0">
                                ©
                               
                                Rizz
                                <span
                                    class="text-muted d-none d-sm-inline-block float-end">
                                    Crafted with
                                    <i class="iconoir-heart text-danger"></i>
                                    by Mannatthemes</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--end footer-->

<!-- end page content -->
</template>

<script setup>
import { onMounted, ref, watch } from "vue";
import { useMemberStores } from "../../store/members_store";
import { storeToRefs } from "pinia";
import { Chart, PieController, ArcElement, Tooltip, Legend } from "chart.js";

// ✅ Register PieController along with ArcElement, Tooltip, Legend
Chart.register(PieController, ArcElement, Tooltip, Legend);

// ✅ Pinia store
const store = useMemberStores();
const { countmembers,countmale, countfemale, malePercent, femalePercent,totalgroups } = storeToRefs(store);
const { memberstats, groupstats } = store;

// ✅ Chart instance
const memberChart = ref(null);

// ✅ Draw Pie Chart
function drawMemberPieChart() {
  const canvas = document.getElementById("memberPieChart");
  if (!canvas) return;

  if (memberChart.value) {
    memberChart.value.destroy();
  }

  memberChart.value = new Chart(canvas, {
    type: "doughnut",
    data: {
      labels: ["Male", "Female"],
      datasets: [
        {
          data: [countmale.value, countfemale.value],
          backgroundColor: ["#0d6efd", "#b22b38"],
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: "bottom" },
        tooltip: {
          callbacks: {
            label(context) {
              const percent =
                context.label === "Male"
                  ? malePercent.value
                  : femalePercent.value;
              return `${context.label}: ${context.raw} (${percent}%)`;
            },
          },
        },
      },
    },
  });
}

// ✅ Load data
onMounted(async () => {
  await memberstats();
  await groupstats();
  drawMemberPieChart(); // draw after data loaded
});

// ✅ Watch for reactive updates (optional)
watch([countmale, countfemale], () => {
  drawMemberPieChart();
});
</script>




<style scoped>
</style>