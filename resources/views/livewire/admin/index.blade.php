<div>
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

    <div class="mt-6 bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold mb-4">Latest Appointments</h3>

        <!-- Appointment Table -->
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-teal-600 text-white">
                    <th class="px-4 py-2 text-left">Client</th>
                    <th class="px-4 py-2 text-left">Service</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Time</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestAppointments as $appointment)
                    <tr class="border-b hover:bg-teal-50">
                        <td class="px-4 py-2">{{ $appointment->user->name }}</td>
                        <td class="px-4 py-2">{{ $appointment->service->name }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                        <td class="px-4 py-2">
                            @if($appointment->status == 'confirmed')
                                <span class="text-green-500 font-semibold">Confirmed</span>
                            @elseif($appointment->status == 'pending')
                                <span class="text-yellow-500 font-semibold">Pending</span>
                            @else
                                <span class="text-red-500 font-semibold">Cancelled</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
