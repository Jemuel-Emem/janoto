<div class="container mx-auto mt-8 px-4">
    <!-- Add FAQ Button -->
    <x-button label="Add FAQ" dark icon="plus" wire:click="openAddFaqModal" />

    <!-- FAQ Table -->
    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @forelse($faqs as $faq)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $faq->title }}</td>
                        <td class="px-6 py-4">{{ $faq->description }}</td>
                        <td class="px-6 py-4 flex gap-2 justify-center">
                            <x-button label="Edit" icon="pencil-alt" positive wire:click="openEditFaqModal({{ $faq->id }})" />
                            <x-button label="Delete" icon="trash" negative wire:click="deleteFaq({{ $faq->id }})" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No FAQs available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add FAQ Modal -->
    <x-modal wire:model.defer="add_faq_modal">
        <x-card title="Add New FAQ">
            <div class="space-y-3">
                <x-input
                    label="Title"
                    placeholder="Enter FAQ title"
                    wire:model.defer="title"
                />
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <x-textarea
                    label="Description"
                    placeholder="Enter FAQ description"
                    wire:model.defer="description"
                />
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" wire:click="$set('add_faq_modal', false)" />
                    <x-button positive label="Submit" wire:click="submitFaq" spinner="submitFaq" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <!-- Edit FAQ Modal -->
    <x-modal wire:model.defer="edit_faq_modal">
        <x-card title="Edit FAQ">
            <div class="space-y-3">
                <x-input
                    label="Title"
                    placeholder="Enter FAQ title"
                    wire:model.defer="title"
                />
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <x-textarea
                    label="Description"
                    placeholder="Enter FAQ description"
                    wire:model.defer="description"
                />
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" wire:click="$set('edit_faq_modal', false)" />
                    <x-button positive label="Update" wire:click="updateFaq" spinner="updateFaq" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
