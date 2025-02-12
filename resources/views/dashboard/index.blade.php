@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
    
    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
    <h2 class="text-3xl font-semibold mb-6 text-gray-800">Welcome, {{ Auth::user()->name }}! 🎉</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Tuition Postings Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 p-6 shadow-md rounded-lg hover:shadow-lg transition-all duration-300 border">
            <h3 class="text-2xl font-semibold mb-4 text-gray-700">📚 Your Tuition Postings</h3>
            
            @if(Auth::user()->tuitionPostings->count() > 0)
                <ul class="space-y-3">
                    @foreach(Auth::user()->tuitionPostings as $posting)
                        <li class="p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-300">
                            <a href="{{ route('tuition_postings.edit', $posting) }}" 
                               class="flex items-center space-x-3 text-green-600 hover:text-green-700 transition">
                                <span class="text-lg font-medium">{{ $posting->subject }}</span> 
                                <span class="text-sm text-gray-500">({{ $posting->schoolLevel->name }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 italic">You haven't created any tuition postings yet.</p>
            @endif

            <a href="{{ route('tuition_postings.create') }}" 
               class="mt-4 block text-center bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 shadow-md">
                ➕ Create New Posting
            </a>
        </div>

        <!-- Quick Stats Section -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 shadow-md rounded-lg hover:shadow-lg transition-all duration-300 border">
            <h3 class="text-2xl font-semibold mb-4 text-gray-700">📊 Quick Stats</h3>
            <p class="text-lg text-gray-800 font-medium">Total Postings: 
                <span class="text-green-600 font-bold">{{ Auth::user()->tuitionPostings->count() }}</span>
            </p>

            <div class="mt-6 flex items-center space-x-4">
                <div class="flex-1 text-center relative group">
                    <p class="text-3xl font-semibold text-blue-600">{{ Auth::user()->tuitionPostings->where('fee', '>', 100)->count() }}</p>
                    <p class="text-gray-500 text-sm">Premium Postings</p>

                    <!-- Tooltip on Hover -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-gray-800 text-white text-xs rounded-lg py-2 px-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-lg">
                        Tuition fees over $100
                    </div>
                </div>
                
                <div class="flex-1 text-center relative group">
                    <p class="text-3xl font-semibold text-yellow-600">{{ Auth::user()->tuitionPostings->where('fee', '<=', 100)->count() }}</p>
                    <p class="text-gray-500 text-sm">Affordable Postings</p>
                    
                    <!-- Tooltip on Hover -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-gray-800 text-white text-xs rounded-lg py-2 px-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-lg">
                        Tuition fees $100 or lower
                    </div>
                </div>
            </div>
            <!-- Graphs Section -->
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Tuition Posting Statistics</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Chart 1: Line Chart for Number of Postings Per School Level -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Postings Trend Per School Level</h3>
                        <canvas id="postingsChart"></canvas>
                    </div>

                    <!-- Chart 2: Average Tuition Fee per School Level (Pie Chart) -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Average Tuition Fee per School Level</h3>
                        <canvas id="feesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Fetch Data from Blade Variables
        const tuitionPostings = {!! json_encode(Auth::user()->tuitionPostings) !!};

        // Debugging: Log raw data
        // Group data by school level and calculate count & average fee
        const schoolLevelData = {};
        tuitionPostings.forEach(posting => {
            const level = posting.school_level.name;
            if (!schoolLevelData[level]) {
                schoolLevelData[level] = { count: 0, totalFee: 0 };
            }
            schoolLevelData[level].count++;
            schoolLevelData[level].totalFee += parseFloat(posting.fee);
        });

        // Extract Data for Charts
        const schoolLevelLabels = Object.keys(schoolLevelData);
        const schoolLevelCounts = schoolLevelLabels.map(level => schoolLevelData[level].count);
        const averageFees = schoolLevelLabels.map(level => (schoolLevelData[level].totalFee / schoolLevelData[level].count).toFixed(2));

        // Debugging: Log transformed data

        // Render Line Chart (Postings Trend Per School Level)
        const ctx1 = document.getElementById('postingsChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: schoolLevelLabels,
                datasets: [{
                    label: 'Number of Postings',
                    data: schoolLevelCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    tension: 0.4 // Smooth curve effect
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });

        // Render Pie Chart (Average Tuition Fees Per School Level)
        const ctx2 = document.getElementById('feesChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: schoolLevelLabels.map((level, index) => `${level} (${schoolLevelCounts[index]} postings)`),
                datasets: [{
                    label: 'Average Fee',
                    data: averageFees,
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    });
</script>

@endsection