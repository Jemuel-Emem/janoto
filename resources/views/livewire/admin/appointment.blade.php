<div class="container mx-auto mt-8 px-4">





    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="min-w-full table-auto">
            <thead class="text-white bg-gray-600">
                <tr>
                    <th class="px-4 py-2 text-left">User Name</th>
                    <th class="px-4 py-2 text-left">Service Name</th>
                    <th class="px-4 py-2 text-left">Appointment Date</th>
                    <th class="px-4 py-2 text-left">Appointment Time</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($appointments as $appointment)
                    <tr class="border-t border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $appointment->user->name }}</td>
                        <td class="px-4 py-2">{{ $appointment->service->name }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                        <td class="px-4 py-2">
                            <span class="bg-{{ $appointment->status == 'pending' ? 'orange' : ($appointment->status == 'confirmed' ? 'green' : 'red') }}-500 text-white px-2 py-1 rounded-full text-sm">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>

                        <td class="px-4 py-2">
                            @if($appointment->status == 'pending')
                                <x-button
                                    label="Confirm"
                                    wire:click="confirmAppointment({{ $appointment->id }})"
                                    class="bg-green-500 text-white hover:bg-green-600 rounded-md py-1 px-4 text-sm"
                                />
                                <x-button
                                    label="Cancel"
                                    wire:click="cancelAppointment({{ $appointment->id }})"
                                    class="bg-red-500 text-white hover:bg-red-600 rounded-md py-1 px-4 text-sm ml-2"
                                />
                            @else
                                <span class="text-gray-400 text-sm">No Actions</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
