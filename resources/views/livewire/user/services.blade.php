<div>


    <div>
        <div>
            <div class="container mx-auto mt-8 px-4">

             <span class="text-gray-700 font-bold md:text-4xl text-2xl ">APPOINTMENTS</span>
                <div id="calendar-container" class="p-4">
                    <div id="calendar" class="rounded-lg shadow-lg"></div>
                </div>


                <div class="flex justify-between items-center mb-6">
                    <div class="w-full sm:w-3/4 md:w-fit lg:w-full mb-6">
                        <x-input
                            label="Search Services"
                            wire:model="search"
                            placeholder="Search by name or description"
                            class="w-full text-black"
                        />
                    </div>
                    <div class="ml-4 sm:mt-0">
                        <x-button
                            label="Search"
                            wire:click="searchServices"
                            class="w-full sm:w-64 bg-green-600 text-white hover:bg-green-700 border-0 rounded-md shadow-md transition duration-300"
                        />
                    </div>
                </div>

                <!-- Services Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                    @foreach($services as $service)
                        <div class="bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                            <div class="h-40 bg-gray-100 rounded-lg overflow-hidden mb-4">
                                @if($service->photo)
                                    <img src="{{ asset('storage/' . $service->photo) }}" alt="Service Image" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-500 text-sm">No Image Available</div>
                                @endif
                            </div>

                            <h3 class="text-2xl font-semibold text-gray-800">{{ $service->name }}</h3>
                            <p class="text-base text-gray-600 mt-2">{{ Str::limit($service->description, 100) }}</p>

                            <div class="mt-6 text-center w-full">
                                <x-button
                                    label="View"
                                    wire:click="viewService({{ $service->id }})"
                                    class="w-full sm:w-80 bg-green-700 text-white hover:bg-green-900 border-0 rounded-md shadow-md transition duration-300 transform hover:scale-105"
                                />
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $services->links() }}
                </div>

                @if($showModal && $selectedService)
                    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white w-11/12 md:w-2/3 lg:w-1/2 rounded-lg shadow-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-2xl font-semibold text-black">{{ $selectedService->name }}</h2>
                                <button class="" wire:click="closeModal">✖</button>
                            </div>
                            @if($errorMessage)
                            <div class="bg-red-100 text-red-800 p-4 rounded-md">
                                {{ $errorMessage }}
                            </div>
                            @endif


                            <div class="mb-4">
                                @if($selectedService->photo)
                                    <img src="{{ asset('storage/' . $selectedService->photo) }}" alt="Service Image" class="w-full h-64 object-cover rounded-lg mb-4">
                                @endif
                                <p class="text-black"><strong class="text-black">Description:</strong> {{ $selectedService->description }}</p>
                            </div>
                            <div class="mb-4">
                                <div class="flex space-x-4">
                                    <div class="w-1/2">
                                        <x-input
                                            type="date"
                                            label="Appointment Date"
                                            wire:model="appointmentDate"
                                            class="w-full text-black"
                                        />
                                    </div>

                                    <div class="w-1/2">
                                        <label for="appointmentTime" class="block text-sm font-medium text-gray-700">Appointment Time</label>
                                        <select
                                            wire:model="appointmentTime"
                                            id="appointmentTime"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 bg-white rounded-md text-black focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            <option value="">Select a time</option>
                                            <option value="08:00">8:00 AM</option>
                                            <option value="09:00">9:00 AM</option>
                                            <option value="10:00">10:00 AM</option>
                                            <option value="11:00">11:00 AM</option>
                                            <option value="12:00">12:00 PM</option>
                                            <option value="13:00">1:00 PM</option>
                                            <option value="14:00">2:00 PM</option>
                                            <option value="15:00">3:00 PM</option>
                                            <option value="16:00">4:00 PM</option>
                                            <option value="17:00">5:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="calendar" class="mb-4"></div>
                            <div class="mb-4" class="">
                                <div>
                                    <x-checkbox
                                        wire:model="termsAccepted"
                                        label="Did you agree to the terms and conditions?"
                                    />
                                </div>
                            </div>

                            <div class="text-center">
                                <x-button wire:click="submitAppointment"
                                    label="Submit Appointment"
                                    class="bg-green-600 text-white hover:bg-green-700 rounded-md shadow-md transition duration-300 px-6 py-3"
                                />
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const appointments = @json($appointments);

                    const events = appointments.map(appointment => ({
                        title: `${appointment.service.name} - ${appointment.user.name}`,
                        start: `${appointment.appointment_date}T${appointment.appointment_time}`,
                    }));

                    const calendarEl = document.getElementById('calendar');
                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth,timeGridWeek,timeGridDay',
                        },
                        events: events,
                    });

                    calendar.render();

                    // Recalculate calendar layout on window resize
                    window.addEventListener('resize', () => {
                        const newView = window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth';
                        if (calendar.view.type !== newView) {
                            calendar.changeView(newView);
                            calendar.render(); // Rerender for proper layout
                        }
                    });
                });
            </script>


<style>

    #calendar {
        background-color: #f3f4f6; /* Light gray background */
        color: black; /* Black text for readability */
        border-radius: 8px;
        overflow: hidden; /* Prevent overflow issues */
    }

    .fc-daygrid-day {
        background-color: #f3f4f6;
    }

    .fc-toolbar-title,
    .fc-daygrid-day-top,
    .fc-daygrid-day-number {
        color: black;
    }

    /* Responsive styles for smaller screens */
    @media (max-width: 768px) {
        #calendar-container {
            padding: 2px; /* Reduce padding on smaller screens */
        }

        #calendar {
            background-color: #e5e7eb; /* Slightly darker gray for mobile */
        }

        .fc-toolbar-title {
            font-size: 1rem; /* Adjust title size */
        }

        .fc-daygrid-day {
            font-size: 0.75rem; /* Adjust day text size */
        }
    }
</style>

        </div>

    </div>

</div>
