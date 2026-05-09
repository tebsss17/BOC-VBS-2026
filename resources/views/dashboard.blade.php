<x-layouts::app :title="__('Dashboard')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- HEADER (EARTH THEME) -->
        <x-reusables.header>
            Dashboard
        </x-reusables.header>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Total Students -->
            <div class="bg-amber-50 border border-amber-200 p-6 shadow-lg rounded-2xl hover:scale-[1.02] transition">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-amber-800">
                            Total Students
                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-amber-900">
                            {{ $totalStudent }}
                        </h2>
                    </div>

                    <i data-lucide="circle-user-round" class="size-14 text-amber-700"></i>

                </div>

            </div>

            <!-- Present Today -->
            <div class="bg-green-50 border border-green-200 p-6 shadow-lg rounded-2xl hover:scale-[1.02] transition">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-green-800">
                            Students Present Today
                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-green-800">
                            {{ $presentToday }}
                        </h2>
                    </div>

                    <i data-lucide="badge-check" class="size-14 text-green-600"></i>

                </div>

            </div>

            <!-- Perfect Attendance -->
            <div class="bg-orange-50 border border-orange-200 p-6 shadow-lg rounded-2xl hover:scale-[1.02] transition">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-orange-800">
                            Perfect Attendance
                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-orange-900">
                            {{ $perfectAttendanceCount }}
                        </h2>
                    </div>

                    <i data-lucide="trophy" class="size-14 text-orange-700"></i>

                </div>

            </div>

        </div>

        <!-- Attendance Chart -->
        <div class="bg-white border border-amber-100 p-6 shadow-lg rounded-2xl">

            <h2 class="text-xl font-bold mb-6 text-amber-900">
                Attendance Per Day
            </h2>

            <div class="h-[400px]">
                <canvas id="dailyAttendanceChart"></canvas>
            </div>

        </div>

        <!-- Bottom Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Gender Distribution -->
            <div class="bg-white border border-amber-100 p-6 shadow-lg rounded-2xl">

                <h2 class="text-xl font-bold mb-6 text-amber-900">
                    Gender Distribution
                </h2>

                <div class="h-[300px]">
                    <canvas id="genderChart"></canvas>
                </div>

            </div>

            <!-- Attendance By Group -->
            <div class="bg-white border border-amber-100 p-6 shadow-lg rounded-2xl">

                <h2 class="text-xl font-bold mb-6 text-amber-900">
                    Attendance by Group
                </h2>

                <div class="h-[300px]">
                    <canvas id="groupChart"></canvas>
                </div>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const createChart = (id, config) => {
                const el = document.getElementById(id);
                if (!el) return;
                new Chart(el, config);
            };

            // 📈 Daily Attendance Chart
            createChart('dailyAttendanceChart', {
                type: 'line',
                data: {
                    labels: @json($dailyLabels),
                    datasets: [
                        {
                            label: 'Present',
                            data: @json($dailyPresent),
                            borderWidth: 2,
                            tension: 0.3,
                            borderColor: '#16a34a' // green
                        },
                        {
                            label: 'Absent',
                            data: @json($dailyAbsent),
                            borderWidth: 2,
                            tension: 0.3,
                            borderColor: '#ef4444' // red
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });

            // 👥 Gender Chart (EARTH COLORS)
            createChart('genderChart', {
                type: 'doughnut',
                data: {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        data: [{{ $maleGender }}, {{ $femaleGender }}],
                        backgroundColor: [
                            '#92400E', // brown
                            '#F59E0B'  // amber
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });

            // 📊 Group Chart
            createChart('groupChart', {
                type: 'bar',
                data: {
                    labels: @json($groupLabels),
                    datasets: [
                        {
                            label: 'Present',
                            data: @json($groupPresent),
                            backgroundColor: '#16a34a'
                        },
                        {
                            label: 'Absent',
                            data: @json($groupAbsent),
                            backgroundColor: '#ef4444'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });

        });
    </script>

</x-layouts::app>
