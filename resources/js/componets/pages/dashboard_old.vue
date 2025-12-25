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
                        <canvas id="groupBarChart" height="320"></canvas>
                        <!--end row-->
                    </div>
                    
                </div>
                
            </div>


            <!--end col-->
        </div>
        

        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="card card-h-100">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Browser Used & Traffic Reports</h4>
                            </div>
                            
                        </div>
                       
                    </div>
                   
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
                                  
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chrome</td>
                                        <td>10853<small class="text-muted">(52%)</small></td>
                                        <td> 52.80%</td>
                                        <td>566<small class="text-muted">(92%)</small></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Microsoft
                                            Edge</td>
                                        <td>2545<small class="text-muted">(47%)</small></td>
                                        <td> 47.54%</td>
                                        <td>498<small class="text-muted">(81%)</small></td>
                                    </tr>
                                   
                                    <tr>
                                        <td>Internet-Explorer</td>
                                        <td>1836<small class="text-muted">(38%)</small></td>
                                        <td> 41.12%</td>
                                        <td>455<small class="text-muted">(74%)</small></td>
                                    </tr>
                                   
                                    <tr>
                                        <td>Opera</td>
                                        <td>1958<small class="text-muted">(31%)</small></td>
                                        <td> 36.82%</td>
                                        <td>361<small class="text-muted">(61%)</small></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Chrome</td>
                                        <td>10853<small class="text-muted">(52%)</small></td>
                                        <td> 52.80%</td>
                                        <td>566<small class="text-muted">(92%)</small></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                           
                        </div>
                       
                    </div>
                   
                </div>
             
            </div>
            
        </div> -->
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
                                © Membership Management System
                                <span class="text-muted d-none d-sm-inline-block float-end"> By Click with for General use</span>
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

import {
  Chart,
  // Controllers
  PieController,
  DoughnutController,
  BarController,
  LineController,
  PolarAreaController,
  RadarController,
  BubbleController,
  ScatterController,
  // Elements
  ArcElement,
  BarElement,
  LineElement,
  PointElement,
  // Scales
  CategoryScale,
  LinearScale,
  RadialLinearScale,
  LogarithmicScale,
  TimeScale,
  TimeSeriesScale,
  // Plugins
  Tooltip,
  Legend,
  Filler
} from "chart.js";

// ✅ Register ALL controllers, elements, scales, and plugins
Chart.register(
  PieController,
  DoughnutController,
  BarController,
  LineController,
  PolarAreaController,
  RadarController,
  BubbleController,
  ScatterController,
  ArcElement,
  BarElement,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
  RadialLinearScale,
  LogarithmicScale,
  TimeScale,
  TimeSeriesScale,
  Tooltip,
  Legend,
  Filler
);


// ✅ Pinia store
const store = useMemberStores();

const {
    countmembers,
  countmale,
  countfemale,
  malePercent,
  femalePercent,
  totalgroups,
  groupmStats
} = storeToRefs(store);

const { memberstats, groupstats,groupMemberStats } = store;

// ✅ Chart instances
const memberChart = ref(null);
const groupChart = ref(null);


// ================= PIE CHART =================
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

// ================= BAR CHART =================
// Predefined color palette
const colorPalette = [
  "#0d6efd", // blue
  "#b22b38", // red
  "#ffc107", // yellow
  "#198754", // green
  "#6f42c1", // purple
  "#fd7e14", // orange
  "#0dcaf0", // cyan
  "#d63384", // pink
  "#20c997", // teal
  "#6610f2"  // violet
];

// Function to get color by index
function getColor(index) {
  return colorPalette[index % colorPalette.length];
}

// Draw bar chart
function drawGroupBarChart(groups) {
  const canvas = document.getElementById("groupBarChart");
  if (!canvas || !groups || !groups.length) return;

  // Destroy old chart if it exists
  if (groupChart.value) {
    groupChart.value.destroy();
  }

  // Assign a color for each group based on its index
  const colors = groups.map((_, index) => getColor(index));

  groupChart.value = new Chart(canvas, {
    type: "bar", // bar chart
    data: {
      labels: groups.map(g => g.gname),
      datasets: [
        {
          label: "Members per Group",
          data: groups.map(g => g.total_members),
          backgroundColor: colors, // different color per bar
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: true },
        tooltip: {
          callbacks: {
            label(context) {
              return `${context.dataset.label}: ${context.raw}`;
            },
          },
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { precision: 0 },
        },
      },
    },
  });
}









// ================= LOAD DATA =================
// Draw initially after data loads
onMounted(async () => {
  await memberstats();
  await groupstats();
  await groupMemberStats();

  drawMemberPieChart(); // initial draw
  if (groupmStats.value.length) drawGroupBarChart(groupmStats.value); // draw bar chart
});

// Reactive watcher for pie chart
watch([countmale, countfemale], ([newMale, newFemale]) => {
  drawMemberPieChart();
});




</script>





<style scoped>
</style>