<template>
<div class="row g-2 mb-2">
                    <div class="col-xxl-5">
                        <div class="row g-2">

                            <!-- Total Orders -->
                            <div class="col-xl-6">
                                <div class="card m-0">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">Total Orders</h4>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2 py-1">
                                            <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title text-bg-primary rounded-circle">
                                                    <i class="ri-shopping-bag-3-line fs-xxl"></i>
                                                </span>
                                            </div>
                                            <h3 class="mb-0 fw-bold"><span data-target="687.3">0</span>k</h3>
                                        </div>
                                        <p class="mb-0 text-muted">
                                            <span class="text-success me-2"><i class="ti ti-caret-up-filled"></i> 5.42%</span>
                                            <span class="text-nowrap">Since last month</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Revenue -->
                            <div class="col-xl-6">
                                <div class="card m-0">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">Total Revenue</h4>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2 py-1">
                                            <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title text-bg-success rounded-circle">
                                                    <i class="ri-money-dollar-circle-line fs-xxl"></i>
                                                </span>
                                            </div>
                                            <h3 class="mb-0 fw-bold">$<span data-target="2.5">0</span>M</h3>
                                        </div>
                                        <p class="mb-0 text-muted">
                                            <span class="text-success me-2"><i class="ti ti-caret-up-filled"></i> 8.76%</span>
                                            <span class="text-nowrap">Since last month</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Customers -->
                            <div class="col-xl-6">
                                <div class="card m-0">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">Active Customers</h4>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2 py-1">
                                            <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title text-bg-warning rounded-circle">
                                                    <i class="ri-user-3-line fs-xxl"></i>
                                                </span>
                                            </div>
                                            <h3 class="mb-0 fw-bold"><span data-target="54.6">0</span>k</h3>
                                        </div>
                                        <p class="mb-0 text-muted">
                                            <span class="text-danger me-2"><i class="ti ti-caret-down-filled"></i> 2.13%</span>
                                            <span class="text-nowrap">Since last month</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Conversion Rate -->
                            <div class="col-xl-6">
                                <div class="card m-0">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">Conversion Rate</h4>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2 py-1">
                                            <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title text-bg-info rounded-circle">
                                                    <i class="ri-pie-chart-2-line fs-xxl"></i>
                                                </span>
                                            </div>
                                            <h3 class="mb-0 fw-bold"><span data-target="4.87">0</span>%</h3>
                                        </div>
                                        <p class="mb-0 text-muted">
                                            <span class="text-success me-2"><i class="ti ti-caret-up-filled"></i> 1.28%</span>
                                            <span class="text-nowrap">Since last week</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xxl-7">
                        <div class="card h-100 mb-0">
                            <div class="card-header border-0 justify-content-between">
                                <h4 class="card-title">Business Performance Overview</h4>
                                <div>
                                    <a href="#" class="btn btn-sm btn-default">Export</a>
                                    <a href="#" class="btn btn-sm btn-default">Import</a>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div dir="ltr">
                                    <div id="revenue-chart" class="apex-charts"></div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row-->



                 <div class="row mb-2 g-2">
                    <div class="col-xl-4">
                        <div class="card h-100 mb-0">
                            <div class="card-header">
                                <h4 class="card-title">Customer Engagement Overview</h4>
                            </div>
                            <div class="card-body">
                                <div dir="ltr">
                                    <div id="simple-bubble" class="apex-charts"></div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-xl-4">
                        <div class="card h-100 mb-0">
                            <div class="card-header">
                                <h4 class="card-title">Goal Achievement Metrics</h4>
                            </div>
                            <div class="card-body pt-0">
                                <div dir="ltr">
                                    <div id="multiple-radialbar" class="apex-charts"></div>
                                </div>
                                <div class="mt-2">
                                    <div class="table-responsive mb-n1">
                                        <table class="table table-sm fs-xs table-nowrap table-borderless table-centered mb-0">
                                            <thead class="bg-light bg-opacity-50 thead-sm">
                                                <tr class="text-uppercase fs-xxs">
                                                    <th>Goal</th>
                                                    <th>Completed</th>
                                                    <th>Target</th>
                                                    <th>Progress</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Sales Target</td>
                                                    <td>82,450</td>
                                                    <td>100,000</td>
                                                    <td>82%</td>
                                                </tr>
                                                <tr>
                                                    <td>Marketing Reach</td>
                                                    <td>66,200</td>
                                                    <td>100,000</td>
                                                    <td>66%</td>
                                                </tr>
                                                <tr>
                                                    <td>Product Launch Readiness</td>
                                                    <td>74%</td>
                                                    <td>Final QA Pending</td>
                                                    <td>74%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-xl-4">
                        <div class="card h-100 mb-0">
                            <div class="card-header">
                                <h4 class="card-title">Regional Sales Distribution</h4>
                            </div>
                            <div class="card-body">
                                <div id="usa-vector-map" style="height: 251px"></div>

                                <ul class="list-unstyled mt-4 mb-0 d-flex flex-wrap">
                                    <li class="w-50 mb-2"><i class="ri-checkbox-blank-circle-fill text-primary me-1"></i> New York: 890</li>
                                    <li class="w-50 mb-2"><i class="ri-checkbox-blank-circle-fill text-success me-1"></i> California: 650</li>
                                    <li class="w-50"><i class="ri-checkbox-blank-circle-fill text-warning me-1"></i> Texas: 320</li>
                                    <li class="w-50"><i class="ri-checkbox-blank-circle-fill text-info me-1"></i> Florida: 470</li>
                                </ul>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row-->




                <div class="row g-2">
                    <div class="col-xl-9">
                        <div data-table data-table-rows-per-page="5" class="card">
                            <div class="card-header border-light justify-content-between">
                                <h4 class="card-title">Page Analytics Overview</h4>

                                <div class="d-flex align-items-center gap-2">

                                    <!-- Delete Selected -->
                                    <button data-table-delete-selected class="btn btn-danger d-none">Delete Selected</button>

                                    <!-- Search -->
                                    <div class="app-search">
                                        <input data-table-search type="text" class="form-control" placeholder="Search pages..." />
                                        <i class="ri ri-search-line app-search-icon text-muted"></i>
                                    </div>

                                    <!-- Rows Per Page -->
                                    <div>
                                        <select data-table-set-rows-per-page class="form-select form-control my-1 my-md-0">
                                            <option value="5">5 rows</option>
                                            <option value="10" selected>10 rows</option>
                                            <option value="15">15 rows</option>
                                            <option value="20">20 rows</option>
                                            <option value="50">50 rows</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-custom table-centered table-hover w-100 mb-0">
                                    <thead class="bg-light bg-opacity-25 thead-sm">
                                        <tr class="text-uppercase fs-xxs">
                                            <th scope="col" style="width: 1%">
                                                <input data-table-select-all class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" />
                                            </th>
                                            <th data-table-sort>Page Path</th>
                                            <th data-table-sort>Top Referral Source</th>
                                            <th data-table-sort>Page Views</th>
                                            <th data-table-sort>Avg Time on Page</th>
                                            <th data-table-sort>Bounce Rate</th>
                                            <th data-table-sort>Conversion Rate</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Row 1 -->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/dashboard</td>
                                            <td>Direct</td>
                                            <td><i class="ti ti-eye me-1"></i> 3,980</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 02m:12s</td>
                                            <td>19.5%</td>
                                            <td>4.3%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 2 -->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/pricing</td>
                                            <td>Google</td>
                                            <td><i class="ti ti-eye me-1"></i> 1,742</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 01m:49s</td>
                                            <td>22.1%</td>
                                            <td>6.7%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 3 -->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/features</td>
                                            <td>LinkedIn</td>
                                            <td><i class="ti ti-eye me-1"></i> 2,310</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 02m:05s</td>
                                            <td>17.8%</td>
                                            <td>5.4%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 4 -->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/blog/how-to-boost-sales</td>
                                            <td>Twitter</td>
                                            <td><i class="ti ti-eye me-1"></i> 1,128</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 03m:14s</td>
                                            <td>14.9%</td>
                                            <td>2.2%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 5 -->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/docs/get-started</td>
                                            <td>Reddit</td>
                                            <td><i class="ti ti-eye me-1"></i> 2,540</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 04m:01s</td>
                                            <td>11.2%</td>
                                            <td>7.9%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 6 -->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/signup</td>
                                            <td>Newsletter</td>
                                            <td><i class="ti ti-eye me-1"></i> 3,780</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 02m:29s</td>
                                            <td>28.5%</td>
                                            <td>9.1%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 7 -->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/account/settings</td>
                                            <td>Instagram</td>
                                            <td><i class="ti ti-eye me-1"></i> 1,690</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 01m:36s</td>
                                            <td>16.3%</td>
                                            <td>3.9%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 8-->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/reports/weekly-performance</td>
                                            <td>Direct</td>
                                            <td><i class="ti ti-eye me-1"></i> 2,245</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 02m:08s</td>
                                            <td>17.2%</td>
                                            <td>4.1%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 9-->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/help/faq</td>
                                            <td>Google</td>
                                            <td><i class="ti ti-eye me-1"></i> 3,015</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 01m:23s</td>
                                            <td>23.9%</td>
                                            <td>2.8%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 10-->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/products</td>
                                            <td>Instagram</td>
                                            <td><i class="ti ti-eye me-1"></i> 4,680</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 02m:51s</td>
                                            <td>18.4%</td>
                                            <td>6.3%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 11-->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/downloads</td>
                                            <td>Referral</td>
                                            <td><i class="ti ti-eye me-1"></i> 1,395</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 03m:22s</td>
                                            <td>13.6%</td>
                                            <td>7.4%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Row 12-->
                                        <tr>
                                            <td><input class="form-check-input form-check-input-light fs-14 mt-0" type="checkbox" /></td>
                                            <td>/contact</td>
                                            <td>Facebook</td>
                                            <td><i class="ti ti-eye me-1"></i> 2,920</td>
                                            <td><i class="ti ti-clock-hour-4 me-1"></i> 01m:41s</td>
                                            <td>21.7%</td>
                                            <td>3.6%</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-eye-line fs-lg"></i></a>
                                                    <a href="javascript:void(0);" data-table-delete-row class="btn btn-light btn-icon btn-sm rounded-circle"><i class="ri ri-delete-bin-line fs-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div data-table-pagination-info="entries"></div>

                                    <div data-table-pagination></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Top Countries</h4>
                            </div>
                            <div class="card-body p-0">
                                <div style="max-height: 388px" data-simplebar class="p-3">
                                    <!-- 1 -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div>
                                            <img src="@/assets/images/flags/us.svg" class="me-1 rounded-circle" height="18">
                                            <span class="align-middle">United States</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="me-2"><i class="ri-arrow-up-s-line text-success"></i> 2.3%</span>
                                            <span>1,450</span>
                                        </div>
                                    </div>

                                    <!-- 2 -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div>
                                            <img src="@/assets/images/flags/gb.svg" class="me-1 rounded-circle" height="18">
                                            <span class="align-middle">United Kingdom</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="me-2"><i class="ri-arrow-down-s-line text-danger"></i> 1.2%</span>
                                            <span>980</span>
                                        </div>
                                    </div>

                                    <!-- 3 -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div>
                                            <img src="@/assets/images/flags/in.svg" class="me-1 rounded-circle" height="18">
                                            <span class="align-middle">India</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="me-2"><i class="ri-arrow-up-s-line text-success"></i> 3.8%</span>
                                            <span>2,340</span>
                                        </div>
                                    </div>

                                    <!-- 4 -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div>
                                            <img src="@/assets/images/flags/ca.svg" class="me-1 rounded-circle" height="18">
                                            <span class="align-middle">Canada</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="me-2"><i class="ri-arrow-up-s-line text-success"></i> 1.5%</span>
                                            <span>740</span>
                                        </div>
                                    </div>

                                    <!-- 5 -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div>
                                            <img src="@/assets/images/flags/au.svg" class="me-1 rounded-circle" height="18">
                                            <span class="align-middle">Australia</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="me-2"><i class="ri-arrow-down-s-line text-danger"></i> 0.8%</span>
                                            <span>560</span>
                                        </div>
                                    </div>

                                    <!-- 6 -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div>
                                            <img src="@/assets/images/flags/de.svg" class="me-1 rounded-circle" height="18">
                                            <span class="align-middle">Germany</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="me-2"><i class="ri-arrow-up-s-line text-success"></i> 2.9%</span>
                                            <span>1,120</span>
                                        </div>
                                    </div>

                                    <!-- 7 -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div>
                                            <img src="@/assets/images/flags/fr.svg" class="me-1 rounded-circle" height="18">
                                            <span class="align-middle">France</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="me-2"><i class="ri-arrow-down-s-line text-danger"></i> 1.0%</span>
                                            <span>845</span>
                                        </div>
                                    </div>

                                    <!-- 8 -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div>
                                            <img src="@/assets/images/flags/jp.svg" class="me-1 rounded-circle" height="18">
                                            <span class="align-middle">Japan</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="me-2"><i class="ri-arrow-up-s-line text-success"></i> 4.1%</span>
                                            <span>1,980</span>
                                        </div>
                                    </div>

                                    <!-- 9 -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div>
                                            <img src="@/assets/images/flags/sa.svg" class="me-1 rounded-circle" height="18">
                                            <span class="align-middle">Saudi Arabia</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="me-2"><i class="ri-arrow-down-s-line text-danger"></i> 0.7%</span>
                                            <span>610</span>
                                        </div>
                                    </div>

                                    <!-- 10 -->
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <img src="@/assets/images/flags/ae.svg" class="me-1 rounded-circle" height="18">
                                            <span class="align-middle">UAE</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="me-2"><i class="ri-arrow-up-s-line text-success"></i> 3.6%</span>
                                            <span>1,305</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row-->
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