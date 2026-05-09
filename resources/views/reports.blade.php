<x-layouts::app :title="__('Reports Dashboard')">

    <div class="flex flex-col gap-6 px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Attendance Reports Dashboard
        </x-reusables.header>

        <!-- SUMMARY STATS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="bg-white border border-amber-100 rounded-xl p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Total Students</p>
                <h2 class="text-2xl font-black text-amber-900">{{ $totalStuent }}</h2>
            </div>

            <div class="bg-white border border-amber-100 rounded-xl p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Average Age</p>
                <h2 class="text-2xl font-black text-amber-900">{{ number_format($avgAge, 1) }}</h2>
            </div>

            <div class="bg-white border border-amber-100 rounded-xl p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Present Today</p>
                <h2 class="text-2xl font-black text-green-600">{{ $presentCount }}</h2>
            </div>

            <div class="bg-white border border-amber-100 rounded-xl p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Absent Today</p>
                <h2 class="text-2xl font-black text-red-500">{{ $absentCount }}</h2>
            </div>

        </div>

        <!-- CHARTS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            <!-- Location -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-amber-100">
                <h2 class="text-sm font-bold uppercase text-amber-900 mb-3">
                    Students per Location
                </h2>
                <canvas id="locationChart"></canvas>
            </div>

            <!-- Attendance -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-amber-100">
                <h2 class="text-sm font-bold uppercase text-amber-900 mb-3">
                    Overall Attendance
                </h2>
                <canvas id="attendancePieChart"></canvas>
            </div>

            <!-- Gender -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-amber-100">
                <h2 class="text-sm font-bold uppercase text-amber-900 mb-3">
                    Gender Ratio
                </h2>
                <canvas id="gender"></canvas>
            </div>

            <!-- Group -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-amber-100">
                <h2 class="text-sm font-bold uppercase text-amber-900 mb-3">
                    Group-wise Attendance
                </h2>
                <canvas id="groupChart"></canvas>
            </div>

            <!-- Daily -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-amber-100 md:col-span-2 xl:col-span-2">
                <h2 class="text-sm font-bold uppercase text-amber-900 mb-3">
                    Daily Attendance Trend
                </h2>
                <canvas id="dailyChart"></canvas>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // DATA FROM LARAVEL
    const locLabels = @json($locationLabels);
    const locCounts = @json($locationCounts);

    const presentCount = @json($presentCount);
    const absentCount = @json($absentCount);

    const maleGender = @json($maleGender);
    const femaleGender = @json($femaleGender);

    const groupLabels = @json($groupLabels);
    const groupPresent = @json($groupPresent);
    const groupAbsent = @json($groupAbsent);

    const dailyLabels = @json($dailyLabels);
    const dailyPresent = @json($dailyPresent);
    const dailyAbsent = @json($dailyAbsent);

    // -----------------------------
    // LOCATION CHART (Doughnut)
    // -----------------------------
    new Chart(document.getElementById('locationChart'), {
        type: 'doughnut',
        data: {
            labels: locLabels,
            datasets: [{
                data: locCounts,
                backgroundColor: ['#f59e0b', '#10b981', '#3b82f6', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            cutout: '65%'
        }
    });

    // -----------------------------
    // ATTENDANCE PIE
    // -----------------------------
    new Chart(document.getElementById('attendancePieChart'), {
        type: 'pie',
        data: {
            labels: ['Present', 'Absent'],
            datasets: [{
                data: [presentCount, absentCount],
                backgroundColor: ['#10b981', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true
        }
    });

    // -----------------------------
    // GENDER PIE
    // -----------------------------
    new Chart(document.getElementById('gender'), {
        type: 'pie',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [maleGender, femaleGender],
                backgroundColor: ['#3b82f6', '#ec4899'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true
        }
    });

    // -----------------------------
    // GROUP BAR CHART
    // -----------------------------
    new Chart(document.getElementById('groupChart'), {
        type: 'bar',
        data: {
            labels: groupLabels,
            datasets: [
                {
                    label: 'Present',
                    data: groupPresent,
                    backgroundColor: '#10b981'
                },
                {
                    label: 'Absent',
                    data: groupAbsent,
                    backgroundColor: '#ef4444'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // -----------------------------
    // DAILY LINE CHART
    // -----------------------------
    new Chart(document.getElementById('dailyChart'), {
        type: 'line',
        data: {
            labels: dailyLabels,
            datasets: [
                {
                    label: 'Present',
                    data: dailyPresent,
                    borderColor: '#10b981',
                    tension: 0.3,
                    fill: false
                },
                {
                    label: 'Absent',
                    data: dailyAbsent,
                    borderColor: '#ef4444',
                    tension: 0.3,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true
        }
    });

});
</script>



</x-layouts::app>
