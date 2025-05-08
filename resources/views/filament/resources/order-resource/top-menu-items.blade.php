<x-filament::page>
    <x-filament::card>
        <h2 class="text-xl font-bold mb-4">Top Ordered Menu Items</h2>

        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th class="text-left">Menu Item</th>
                    <th class="text-left">Times Ordered</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->order_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-filament::card>
</x-filament::page>
