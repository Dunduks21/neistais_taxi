<x-guest-layout>
    <h2 class="text-2xl font-bold mb-6 max-w-lg mx-auto mt-10">Rediģēt braucienu</h2>

    <!-- Rediģēšanas forma -->
    <form method="POST" action="{{ route('rides.update', $ride->id) }}" class="max-w-lg mx-auto p-6 bg-white rounded shadow">
        @csrf
        @method('PUT')

        <!-- Customer ID (read-only) -->
        <div class="mb-4">
            <x-input-label for="customer_id" :value="__('Customer ID')" />
            <x-text-input id="customer_id" class="block mt-1 w-full bg-gray-100 cursor-not-allowed" type="number" name="customer_id" value="{{ old('customer_id', $ride->customer_id) }}" readonly />
        </div>

        <!-- Driver ID -->
        <div class="mb-4">
            <x-input-label for="driver_id" :value="__('Driver ID')" />
            <x-text-input id="driver_id" class="block mt-1 w-full" type="number" name="driver_id" value="{{ old('driver_id', $ride->driver_id) }}" required />
            <x-input-error :messages="$errors->get('driver_id')" class="mt-2" />
        </div>

        <!-- Route Start -->
        <div class="mb-4">
            <x-input-label for="route_start" :value="__('Route Start')" />
            <x-text-input id="route_start" class="block mt-1 w-full" type="text" name="route_start" value="{{ old('route_start', $ride->route_start) }}" required autofocus />
            <x-input-error :messages="$errors->get('route_start')" class="mt-2" />
        </div>

        <!-- Route End -->
        <div class="mb-4">
            <x-input-label for="route_end" :value="__('Route End')" />
            <x-text-input id="route_end" class="block mt-1 w-full" type="text" name="route_end" value="{{ old('route_end', $ride->route_end) }}" required />
            <x-input-error :messages="$errors->get('route_end')" class="mt-2" />
        </div>

        <!-- Distance -->
        <div class="mb-4">
            <x-input-label for="distance" :value="__('Distance (km)')" />
            <x-text-input id="distance" class="block mt-1 w-full" type="number" step="0.01" name="distance" value="{{ old('distance', $ride->distance) }}" required />
            <x-input-error :messages="$errors->get('distance')" class="mt-2" />
        </div>

        <!-- Ride Date -->
        <div class="mb-4">
            <x-input-label for="ride_date" :value="__('Ride Date')" />
            <x-text-input id="ride_date" class="block mt-1 w-full" type="date" name="ride_date" value="{{ old('ride_date', $ride->ride_date ? $ride->ride_date->format('Y-m-d') : '') }}" required />
            <x-input-error :messages="$errors->get('ride_date')" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="mb-6">
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status" class="block mt-1 w-full rounded border-gray-300">
                @foreach(['planned', 'ongoing', 'completed', 'cancelled'] as $statusOption)
                    <option value="{{ $statusOption }}" {{ old('status', $ride->status) === $statusOption ? 'selected' : '' }}>
                        {{ ucfirst($statusOption) }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between space-x-4">
            <x-primary-button>
                {{ __('Update Ride') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Dzēšanas forma (atsevišķi ārpus rediģēšanas formas) -->
    <form method="POST" action="{{ route('rides.destroy', $ride->id) }}" onsubmit="return confirm('Vai tiešām vēlaties izdzēst šo braucienu?');" class="max-w-lg mx-auto mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
            {{ __('Dzēst braucienu') }}
        </button>
    </form>
</x-guest-layout>
