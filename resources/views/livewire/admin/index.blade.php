<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">

    <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6 flex flex-col items-center">
        <div class="text-3xl font-bold mb-2">
            <i class="ri-add-box-fill"></i>
        </div>
        <div class="text-4xl font-extrabold mb-2">{{ $serviceCount }}</div>
        <div class="text-lg font-medium">Services</div>
    </div>


    <div class="bg-yellow-400 text-gray-800 rounded-lg shadow-lg p-6 flex flex-col items-center">
        <div class="text-3xl font-bold mb-2">
            <i class="ri-contract-fill"></i>
        </div>
        <div class="text-4xl font-extrabold mb-2">{{ $appointmentCount }}</div>
        <div class="text-lg font-medium">Appointments</div>
    </div>


    <div class="bg-gray-300 text-gray-800 rounded-lg shadow-lg p-6 flex flex-col items-center">
        <div class="text-3xl font-bold mb-2">
            <i class="ri-calendar-schedule-fill"></i>
        </div>
        <div class="text-4xl font-extrabold mb-2">{{ $scheduleCount }}</div>
        <div class="text-lg font-medium">Schedules</div>
    </div>
</div>
