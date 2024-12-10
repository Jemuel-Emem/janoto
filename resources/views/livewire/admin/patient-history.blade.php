<div class="container mx-auto mt-8 px-4">
    <h1 class="text-2xl font-bold text-blue-600 text-center mb-4">Patient Appointment History</h1>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-600 ">
                <tr>
                    <th class="py-2 px-4 border-b text-left text-white text-sm">Patient Name</th>
                    <th class="py-2 px-4 border-b text-left text-white text-sm">Service Name</th>
                    <th class="py-2 px-4 border-b text-left text-white text-sm">Appointment Date</th>
                    <th class="py-2 px-4 border-b text-left text-white text-sm">Appointment Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $appointment)
                    <tr>
                        <td class="py-2 px-4 border-b text-sm text-gray-700">
                            {{ $appointment->user->name ?? 'Unknown' }}
                        </td>
                        <td class="py-2 px-4 border-b text-sm text-gray-700">
                            {{ $appointment->service->name ?? 'Unknown Service' }}
                        </td>
                        <td class="py-2 px-4 border-b text-sm text-gray-700">
                            {{ $appointment->appointment_date }}
                        </td>
                        <td class="py-2 px-4 border-b text-sm text-gray-700">
                            {{ $appointment->appointment_time }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">
                            No confirmed appointments found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
