<!-- resources/views/rides/index.blade.php -->
<!-- Visu braucienu saraksts -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rides List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Driver</th>
                            <th class="border px-4 py-2">Customer</th>
                            <th class="border px-4 py-2">Start Location</th>
                            <th class="border px-4 py-2">End Location</th>
                            <th class="border px-4 py-2">Date</th>
                            <th class="border px-4 py-2">Actions</th> <!-- Jauna kolonna darbībām -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rides as $ride)
                            <tr>
                                <td class="border px-4 py-2">{{ $ride->id }}</td>
                                <td class="border px-4 py-2">{{ $ride->driver->name ?? 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $ride->customer->name ?? 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $ride->route_start }}</td>
                                <td class="border px-4 py-2">{{ $ride->route_end }}</td>
                                <td class="border px-4 py-2">{{ $ride->created_at->format('Y-m-d H:i') }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('rides.edit', $ride->id) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                       Rediģēt
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($rides->isEmpty())
                    <p class="mt-4 text-center">No rides found.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
