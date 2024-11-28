<div>

    <x-button label="Add Service" dark icon="plus" wire:click="$set('add_service_modal', true)" />


    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Service Name</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Photo</th>
                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @forelse($services as $service)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $service->id }}</td>
                        <td class="px-6 py-4">{{ $service->name }}</td>
                        <td class="px-6 py-4">{{ $service->description }}</td>
                        <td class="px-6 py-4">
                            @if ($service->photo)
                                <img src="{{ asset('storage/' . $service->photo) }}" alt="Service Photo" class="h-12 w-12 object-cover rounded">
                            @else
                                <span class="text-gray-400 italic">No photo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex gap-2 justify-center">
                            <x-button class="w-16 h-6" label="Edit" icon="pencil-alt" wire:click="editService({{ $service->id }})" positive />
                            <x-button class="w-16 h-6" label="Delete" icon="trash" wire:click="deleteService({{ $service->id }})" negative />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">No services available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


        <div class="mt-4">
            {{ $services->links() }}
        </div>

    </div>


<x-modal wire:model.defer="add_service_modal">
    <x-card title="Add New Service">
        <div class="space-y-3">
            <x-input label="Service Name" placeholder="Enter service name" wire:model="service_name" />
            <x-textarea label="Description" placeholder="Enter service description" wire:model="service_description" />
            <x-input type="file" label="Photo" wire:model="service_photo" />
            @error('service_photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" negative wire:click="closeModal" />
                <x-button positive label="Submit" wire:click="submitService" spinner="submitService" />
            </div>
        </x-slot>
    </x-card>
</x-modal>

<!-- Edit Service Modal -->
<x-modal wire:model.defer="edit_service_modal">
    <x-card title="Edit Service">
        <div class="space-y-3">
            <x-input label="Service Name" placeholder="Enter service name" wire:model="service_name" />
            <x-textarea label="Description" placeholder="Enter service description" wire:model="service_description" />
            <x-input type="file" label="Photo" wire:model="service_photo" />
            @error('service_photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            @if ($current_photo)
                <div>
                    <span class="text-sm">Current Photo:</span>
                    <img src="{{ asset('storage/' . $current_photo) }}" alt="Service Photo" class="h-20 mt-2">
                </div>
            @endif
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" negative wire:click="closeModal"/>
                <x-button positive label="Update" wire:click="updateService" spinner="updateService" />
            </div>
        </x-slot>
    </x-card>
</x-modal>

</div>
