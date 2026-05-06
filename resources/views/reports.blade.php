>
<x-layouts::app :title="__('Students')">
    <div x-data="{search: '', address: '', group: '' }" class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <x-reusables.header class="bg-main shadow-xl text-white border rounded-xl py-4 px-2 font-extrabold text-2xl text-center md:text-4xl tracking-wide">
            Attendances
        </x-reusables.header>

        <!-- Navigation Section -->
        <div class="p-6 shadow-lg rounded-lg flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-5">
            <!-- Left side: search + dropdown -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100">
        <h2 class="text-slate-600 font-bold mb-4 uppercase text-sm tracking-wider">Students per Location</h2>
        <canvas id="locationChart"></canvas>
    </div>

    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100">
        <h2 class="text-slate-600 font-bold mb-4 uppercase text-sm tracking-wider">Overall Attendance</h2>
        <canvas id="attendancePieChart"></canvas>
    </div>
</div>
        </div>


</x-layouts::app>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Setup para sa Location Bar Chart
    const ctxLocation = document.getElementById('locationChart').getContext('2d');
    new Chart(ctxLocation, {
        type: 'bar',
        data: {
            labels: @json($locationLabels), // Ito yung 'pluck' ng address
            datasets: [{
                label: 'Students',
                data: @json($locationCounts), // Ito yung 'pluck' ng total
                backgroundColor: '#3b82f6', // Blue
                borderRadius: 5
            }]
        }
    });

    // 2. Setup para sa Attendance Pie Chart
    const ctxAttendance = document.getElementById('attendancePieChart').getContext('2d');
    new Chart(ctxAttendance, {
        type: 'pie',
        data: {
            labels: ['Present', 'Absent'],
            datasets: [{
                data: [@json($presentCount), @json($absentCount)],
                backgroundColor: ['#10b981', '#ef4444'] // Green at Red
            }]
        }
    });
});
</script>
