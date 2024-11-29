<div class="container mx-auto mt-8 px-4">
    <h1 class="text-3xl font-bold text-blue-600 text-center">Schedule of Confirmed Appointments</h1>
    <p class="text-lg text-gray-500 text-center mb-6">View all confirmed appointments on the calendar</p>

    <!-- Calendar Container -->
    <div id="calendar" class="bg-gray-100 rounded-lg shadow-lg p-6"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const appointments = @json($appointments); // Pass data from Livewire

        const events = appointments.map(appointment => ({
            title: `${appointment.service.name} - ${appointment.user.name}`,
            start: `${appointment.appointment_date}T${appointment.appointment_time}`, // Format: YYYY-MM-DDTHH:mm:ss
        }));

        // Initialize FullCalendar
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay',
            },
            events: events, // Pass event data
        });

        calendar.render();
    });
</script>
