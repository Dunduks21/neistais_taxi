<<!-- Tagadējā brauciena info -->
<x-guest-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">{{ __('ride_details.title') }}</h1>

        <p><strong>{{ __('ride_details.customer_id') }}:</strong> {{ $ride->customer_id }}</p>
        <p><strong>{{ __('ride_details.driver_id') }}:</strong> {{ $ride->driver_id }}</p>
        <p><strong>{{ __('ride_details.start_location') }}:</strong> {{ $ride->route_start }}</p>
        <p><strong>{{ __('ride_details.end_location') }}:</strong> {{ $ride->route_end }}</p>
        <p><strong>{{ __('ride_details.distance') }}:</strong> {{ $ride->distance }} km</p>
        <p><strong>{{ __('ride_details.status') }}:</strong> {{ ucfirst($ride->status) }}</p>
        <p><strong>{{ __('ride_details.created_at') }}:</strong> {{ $ride->created_at->format('d.m.Y H:i') }}</p>
        <p><strong>{{ __('ride_details.updated_at') }}:</strong> {{ $ride->updated_at->format('d.m.Y H:i') }}</p>

        <a href="{{ route('rides.index') }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-900">
            {{ __('ride_details.back_to_list') }}
        </a>
    </div>
</x-guest-layout>
