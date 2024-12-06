<div class="container mx-auto mt-8 px-4">

    @if($appointments->isEmpty())
        <p class="text-lg text-gray-600">No appointments found.</p>
    @else
        <div class="relative overflow-x-auto mt-4 bg-white shadow-lg rounded-lg p-4">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase" style="background-color: #0f766e;">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium text-white">#</th>
                        <th scope="col" class="px-6 py-3 font-medium text-white">Date</th>
                        <th scope="col" class="px-6 py-3 font-medium text-white">Status</th>
                        <th scope="col" class="px-6 py-3 font-medium text-white">Reason</th>
                        <th scope="col" class="px-6 py-3 font-medium text-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-black">
                    @foreach($appointments as $appointment)
                        <tr class="border-b hover:bg-gray-50 transition duration-300">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td> <!-- Formatted date -->
                            <td class="px-6 py-4
                            @if($appointment->status == 'pending')  text-yellow-800 @elseif($appointment->status == 'confirmed')  text-green-800 @endif">
                            {{ ucfirst($appointment->status) }}
                            </td>

                            <td class="px-6 py-4">{{ $appointment->note}}</td>
                            <td class="px-6 py-4">

                                <button
                                    @if($appointment->status == 'confirmed') disabled class="text-gray-400 cursor-not-allowed" @else class="text-red-600 hover:text-red-800 transition duration-300" @endif
                                    wire:click="cancelAppointment({{ $appointment->id }})">
                                    Cancel
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
