<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Failed Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Brauciena ID</th>
                                <th class="px-4 py-2">Vadītāja ID</th>
                                <th class="px-4 py-2">Izveidots</th>
                                <th class="px-4 py-2">Atcelts</th>
                                <th class="px-4 py-2">Izņēmums</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($failedJobs as $job)
                                <tr>
                                    <td class="border px-4 py-2">{{ $job->id }}</td>
                                    <td class="border px-4 py-2">{{ $job->ride_id ?? '-' }}</td>
                                    <td class="border px-4 py-2">{{ $job->driver_id ?? '-' }}</td>
                                    <td class="border px-4 py-2">{{ $job->created_at ?? '-' }}</td>
                                    <td class="border px-4 py-2">{{ $job->cancelled_at ?? '-' }}</td>
                                    <td class="border px-4 py-2"><pre class="whitespace-pre-wrap">{{ $job->exception }}</pre></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Ja izmanto Laravel paginatoru --}}
                    {{-- $failedJobs var būt paginēts kolekcijas objekts --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
