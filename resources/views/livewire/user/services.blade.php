<div class="container mx-auto mt-8 px-4">

    <!-- Search Section -->
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
                class="w-full sm:w-64 bg-blue-600 text-white hover:bg-blue-700 border-0 rounded-md shadow-md transition duration-300"
            />
        </div>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        @foreach($services as $service)
            <div class="bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">

                <!-- Service Image -->
                <div class="h-40 bg-gray-100 rounded-lg overflow-hidden mb-4">
                    @if($service->photo)
                        <img src="{{ asset('storage/' . $service->photo) }}" alt="Service Image" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-500 text-sm">No Image Available</div>
                    @endif
                </div>

                <!-- Service Name and Description -->
                <h3 class="text-2xl font-semibold text-gray-800">{{ $service->name }}</h3>
                <p class="text-base text-gray-600 mt-2">{{ Str::limit($service->description, 100) }}</p>

                <!-- View Button -->
                <div class="mt-6 text-center w-full">
                    <x-button
                        label="View"
                        wire:click="viewService({{ $service->id }})"
                        class="w-full sm:w-80 bg-indigo-600 text-white hover:bg-indigo-700 border-0 rounded-md shadow-md transition duration-300 transform hover:scale-105"
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
                            <x-input
                                type="time"
                                label="Appointment Time"
                                wire:model="appointmentTime"
                                class="w-full text-black"
                            />
                        </div>
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
