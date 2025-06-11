<x-guest-layout>
    <h2 class="text-2xl font-bold mb-6 max-w-lg mx-auto mt-10">Izvēlies braucienu, ko rediģēt</h2>

    <form method="GET" action="" class="max-w-lg mx-auto p-6 bg-white rounded shadow">
        <label for="ride_id" class="block mb-2 font-medium text-gray-700">Brauciena ID vai apraksts</label>
        <select id="ride_id" name="ride_id" class="block w-full border-gray-300 rounded" required onchange="if(this.value) window.location.href='{{ url('rides') }}/'+this.value+'/edit'">
            <option value="">-- Izvēlies braucienu --</option>
            @foreach($rides as $ride)
                <option value="{{ $ride->id }}">
                    #{{ $ride->id }}: {{ $ride->route_start }} → {{ $ride->route_end }} ({{ ucfirst($ride->status) }})
                </option>
            @endforeach
        </select>
    </form>
</x-guest-layout>
