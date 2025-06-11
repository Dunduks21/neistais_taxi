<!-- Create new trip -->
<x-guest-layout>
    <h1 class="text-2xl font-bold mb-6 text-white">Create New Ride</h1>

    <form method="POST" action="{{ route('rides.store') }}">
        @csrf

        <!-- Customer ID -->
        <div class="mb-4">
            <x-input-label for="customer_id" :value="__('Customer ID')" />
            <x-text-input id="customer_id" class="block mt-1 w-full" type="number" name="customer_id" :value="old('customer_id')" required autofocus />
            <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
        </div>

        <!-- Driver ID -->
        <div class="mb-4">
            <x-input-label for="driver_id" :value="__('Driver ID')" />
            <x-text-input id="driver_id" class="block mt-1 w-full" type="number" name="driver_id" :value="old('driver_id')" required />
            <x-input-error :messages="$errors->get('driver_id')" class="mt-2" />
        </div>

        <!-- Route Start -->
        <div class="mb-4">
            <x-input-label for="route_start" :value="__('Route Start')" />
            <x-text-input id="route_start" class="block mt-1 w-full" type="text" name="route_start" :value="old('route_start')" required />
            <x-input-error :messages="$errors->get('route_start')" class="mt-2" />
        </div>

        <!-- Route End -->
        <div class="mb-4">
            <x-input-label for="route_end" :value="__('Route End')" />
            <x-text-input id="route_end" class="block mt-1 w-full" type="text" name="route_end" :value="old('route_end')" required />
            <x-input-error :messages="$errors->get('route_end')" class="mt-2" />
        </div>

        <!-- Distance -->
        <div class="mb-4">
            <x-input-label for="distance" :value="__('Distance (km)')" />
            <x-text-input id="distance" class="block mt-1 w-full" type="number" step="0.01" name="distance" :value="old('distance')" required />
            <x-input-error :messages="$errors->get('distance')" class="mt-2" />
        </div>

        <!-- Ride Date -->
        <div class="mb-4">
            <x-input-label for="ride_date" :value="__('Ride Date')" />
            <x-text-input id="ride_date" class="block mt-1 w-full" type="date" name="ride_date" :value="old('ride_date')" required />
            <x-input-error :messages="$errors->get('ride_date')" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="mb-4">
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                <option value="planned" {{ old('status') == 'planned' ? 'selected' : '' }}>Planned</option>
                <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Create Ride') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
