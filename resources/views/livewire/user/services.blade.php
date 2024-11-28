<div class="container mx-auto mt-8 px-4">


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
                        class="w-full sm:w-80 bg-indigo-600 text-white hover:bg-indigo-700 border-0 rounded-md shadow-md transition duration-300 transform hover:scale-105"
                    />
                </div>
            </div>
        @endforeach
    </div>


    <div class="mt-8">
        {{ $services->links() }}
    </div>
</div>
