<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Info Cards -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @include('components.card.dashboard-card', [
            'icon' => 'clock',
            'title' => 'Device Uptime',
            'items' => [
            ['id' => 'uptime-date', 'label' => 'Date: ', 'value' => $date],
            ['id' => 'uptime-time', 'label' => 'Time: ', 'value' => $time],
            ['id' => 'device-uptime', 'label' => 'Uptime: ', 'value' => $uptime],
            ]
            ])

            @include('components.card.dashboard-card', [
            'icon' => 'info',
            'title' => 'Devices Information',
            'items' => [
            ['id' => 'board-name', 'label' => 'Identity: ', 'value' => $identity],
            ['id' => 'model-name', 'label' => 'Model: ', 'value' => $boardmodel],
            ['id' => 'os-version', 'label' => 'OS Version: ', 'value' => $version],
            ]
            ])

            @include('components.card.dashboard-card', [
            'icon' => 'server',
            'title' => 'System Performance',
            'items' => [
            ['id' => 'cpu-load', 'label' => 'CPU Load: ', 'value' => $cpu, 'span' => true],
            ['id' => 'memory-usage', 'label' => 'Free Memory: ', 'value' => $memory, 'span' => true],
            ['id' => 'disk-usage', 'label' => 'Free HDD: ', 'value' => $disk, 'span' => true],
            ]
            ])
        </div>

        <div class="grid h-fit grid-flow-col grid-rows-3 gap-3">
            <div class="relative col-span-2 max-w-6xl rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-header.card-header :icon="__('wifi')" :title="__('Hotspot')" />
                <div class="flex justify-around border-neutral-200 gap-2 py-3 dark:bg-neutral-800">
                    <x-card.card :icon="__('router')" :title="__('# Devices')" :description="__('Total Active Devices')" class="flex max-w-48 gap-2 border-b rounded-xl border-neutral-400 px-4 py-3 bg-red-400 hover:border-neutral-600 min-w-52" />
                    <x-card.card :icon="__('users')" :title="__('# Users')" :description="__('Total Users Active')" class="flex max-w-48 gap-2 border-b rounded-xl border-neutral-400 px-4 py-3 bg-green-400 hover:border-neutral-600 min-w-52" />
                    <x-card.card :icon="__('user-plus')" :title="__('Add Profile')" :description="__('Add New Profile')" class="flex max-w-48 gap-2 border-b rounded-xl border-neutral-400 px-4 py-3 bg-yellow-400 hover:border-neutral-600 min-w-52" />
                    <x-card.card :icon="__('user-plus')" :title="__('Generate Users')" :description="__('Generate New Users')" class="flex max-w-48 gap-2 border-b rounded-xl border-neutral-400 px-4 py-3 bg-green-400 hover:border-neutral-600 min-w-52" />
                </div>
            </div>

            <div class="relative max-w-6xl col-span-2 row-span-2 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>

            <div class="relative row-span-3 min-w-lg overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-header.card-header :icon="__('logs')" :title="__('System Log')" />
                <div class="overflow-y-auto max-h-[420px]">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="sticky top-0 bg-gray-950">
                            <tr>
                                <th class="border px-4 py-2">Time</th>
                                <th class="border px-4 py-2">Topics</th>
                                <th class="border px-4 py-2">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $log)
                            @if (is_array($log))
                            <tr>
                                <td class="border px-4 py-2">{{ $log['time'] ??  'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $log['topics'] ?? 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $log['message'] ?? 'No message' }}</td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="3" class="border px-4 py-2 text-center">No logs available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        const updateMap = {
            'uptime-date': ['date', 'Date: '],
            'uptime-time': ['time', 'Time: '],
            'device-uptime': ['uptime', 'Uptime: '],
            'board-name': ['boardName', 'Identity: '],
            'model-name': ['model', 'Model: '],
            'os-version': ['osVersion', 'OS Version: '],
            'cpu-load': ['cpu', ''],
            'memory-usage': ['memory', ''],
            'disk-usage': ['disk', '']
        };

        function updateRouterData() {
            fetch('/api/router-data?ts=' + Date.now())
                .then(r => r.json())
                .then(data => {
                    if (data.error) return console.error('Error:', data.error);

                    Object.entries(updateMap).forEach(([id, [key, label]]) => {
                        const el = document.getElementById(id);
                        if (el) el.textContent = label + (data[key]);
                    });
                })
                .catch(e => console.error('Fetch error:', e));

            // console.log('Router data updated.');
        }
        updateRouterData();
        setInterval(updateRouterData, 3000);
    </script>
</x-layouts.app>