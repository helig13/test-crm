<!-- Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay, show/hide based on modal state. -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <!-- Modal content -->
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            {{__('Add New Employee')}}
                        </h3>
                        <div class="mt-2">
                            <!-- Form content -->
                            <form wire:submit.prevent="save">
                                <div class="mb-4">
                                    <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">{{__('First Name')}}:</label>
                                    <input wire:model="first_name" id="first_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                    @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">{{__('Last Name')}}:</label>
                                    <input wire:model="last_name" id="last_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                    @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{__('Email')}}:</label>
                                    <input wire:model="email" id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">{{__('Phone')}}:</label>
                                    <input wire:model="phone" id="phone" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                    @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="company_id" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Company') }}:</label>
                                    <select wire:model="company_id" id="company_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">{{ __('Select Company') }}</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex items-center justify-between">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                        Save
                                    </button>
                                    <button wire:click="closeModal()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
