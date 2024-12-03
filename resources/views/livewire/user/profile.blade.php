<div x-data="{ isModalOpen: @entangle('isModalOpen') }" class="p-6 rounded-lg">
    <h2 class="text-xl font-bold text-green-900 mb-4">User Profile</h2>


    <div class="flex items-center space-x-4">
        <img
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0f766e&color=ffffff&rounded=true"
            alt="User Avatar"
            class="w-16 h-16 rounded-full shadow-md"
        />

        <div>
            <h3 class="text-lg font-semibold text-gray-600">{{ $name }}</h3>
            <p class="text-sm text-gray-600">{{ $email }}</p>
        </div>
    </div>


    <div class="mt-6">
        <button
            @click="isModalOpen = true"
            class="px-4 py-2 text-green-600  rounded-md shadow hover:text-green-700"
        >
            Edit Profile
        </button>
    </div>


    <div
        x-show="isModalOpen"
        x-cloak
        class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50"
    >
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Profile</h3>


            <form wire:submit.prevent="updateProfile">

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input
                        type="text"
                        id="name"
                        wire:model.defer="name"
                        class="text-black mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-600 focus:border-green-600"
                    />
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        type="email"
                        id="email"
                        wire:model.defer="email"
                        class="mt-1 block w-full rounded-md border-gray-300 text-black shadow-sm focus:ring-green-600 focus:border-green-600"
                    />
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <!-- Close Button -->
                    <button
                        type="button"
                        @click="isModalOpen = false"
                        class="px-4 py-2 bg-gray-600 text-white rounded-md shadow hover:bg-gray-700"
                    >
                        Cancel
                    </button>

                    <!-- Save Button -->
                    <button
                        type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700"
                    >
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
