<x-layouts::app :title="__('Reports Dashboard')">

    <div class="flex flex-col gap-6 px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Reports
        </x-reusables.header>

        <!-- SUMMARY STATS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="bg-white border border-amber-100 rounded-xl p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Attendance Rate</p>
                <h2 class="text-2xl font-black text-amber-900">{{ $attendanceRate }}%</h2>
            </div>

            <div class="bg-white border border-amber-100 rounded-xl p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Average Age</p>
                <h2 class="text-2xl font-black text-amber-900">{{ round($avgAge) }}</h2>
            </div>

            <div class="bg-white border border-amber-100 rounded-xl p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Students Turning Youth</p>
                <h2 class="text-2xl font-black text-amber-900">{{ $turningYouth }}</h2>
            </div>

            <div class="bg-white border border-amber-100 rounded-xl p-4 shadow-sm">
                <p class="text-xs text-gray-500 uppercase">Youth Students</p>
                <h2 class="text-2xl font-black text-amber-900">{{ $alreadyYouth }}</h2>
            </div>

        </div>

        <!-- CHARTS GRID (CLEANED LAYOUT) -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            <!-- LOCATION -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-amber-100">
                <h2 class="text-sm font-bold uppercase text-amber-900 mb-4">
                    Students per Location
                </h2>

                <div class="h-[280px]">
                    <canvas id="locationChart"></canvas>
                </div>
            </div>

            <!-- ATTENDANCE -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-amber-100">
                <h2 class="text-sm font-bold uppercase text-amber-900 mb-4">
                    Overall Attendance
                </h2>

                <div class="h-[280px]">
                    <canvas id="attendancePieChart"></canvas>
                </div>
            </div>

            <!-- AGE -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-amber-100">
                <h2 class="text-sm font-bold uppercase text-amber-900 mb-4">
                    Students By Age
                </h2>

                <div class="h-[280px]">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>

            <!-- ABSENCE LOCATION -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-red-100 md:col-span-2 xl:col-span-3">
                <h2 class="text-sm font-bold uppercase text-red-900 mb-4">
                    Locations with Highest Absences
                </h2>

                <div class="h-[320px]">
                    <canvas id="absenceLocationChart"></canvas>
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            Object.values(Chart.instances).forEach(chart => chart.destroy());

            const locLabels = @json($locationLabels);
            const locCounts = @json($locationCounts);

            const presentCount = @json($presentCount);
            const absentCount = @json($absentCount);

            const tourists = @json($tourists);
            const sightseers = @json($sightseers);
            const wayfarers = @json($wayfarers);
            const youth = @json($youth);

            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false
            };

            // LOCATION
            new Chart(document.getElementById('locationChart'), {
                type: 'doughnut',
                data: {
                    labels: locLabels,
                    datasets: [{
                        data: locCounts,
                        backgroundColor: ['#f59e0b','#10b981','#3b82f6','#ef4444'],
                        borderWidth: 0
                    }]
                },
                options: {...commonOptions, cutout: '65%'}
            });

            // ATTENDANCE
            new Chart(document.getElementById('attendancePieChart'), {
                type: 'pie',
                data: {
                    labels: ['Present', 'Absent'],
                    datasets: [{
                        data: [presentCount, absentCount],
                        backgroundColor: ['#10b981','#ef4444'],
                        borderWidth: 0
                    }]
                },
                options: commonOptions
            });

            // AGE
            new Chart(document.getElementById('ageChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Tourists','Sightseers','Wayfarers','Youth'],
                    datasets: [{
                        data: [tourists, sightseers, wayfarers, youth],
                        backgroundColor: ['#f59e0b','#3b82f6','#10b981','#8b5cf6'],
                        borderWidth: 0
                    }]
                },
                options: commonOptions
            });

            // ABSENCE BY LOCATION (FOCUS CHART)
            new Chart(document.getElementById('absenceLocationChart'), {
                type: 'bar',
                data: {
                    labels: @json($locationAbsenceLabels),
                    datasets: [{
                        label: 'Total Absences',
                        data: @json($locationAbsentCounts),
                        backgroundColor: '#ef4444',
                        borderRadius: 6
                    }]
                },
                options: {
                    ...commonOptions,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        });
    </script>

</x-layouts::app>
