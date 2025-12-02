<x-layouts.app :title="__('Dashboard')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-[19/9] gap-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-header.card-header :icon="__('clock')" :title="__('Device Uptime')" />
                <h5>Date: {{ $date }} </h5>
                <h5>Time: {{ $time }} </h5>
                <h5>Uptime: {{ $uptime }}</h5>
            </div>

            <div class="relative aspect-[19/9] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-header.card-header :icon="__('info')" :title="__('Devices Information')" />
                @if ($isrouterboard == "true")
                <h5>Board Name: Mikrotik {{ $model }} </h5>
                <h5>Model: {{ $boardmodel }} </h5>
                @endif
                <h5>OS Version: {{ $version }} </h5>
            </div>
            <div class="relative aspect-[19/9] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-header.card-header :icon="__('server')" :title="__('System Performance')" />
                <h5>CPU Load: {{ $cpu }} </h5>
                <h5>Free Memory: {{ $memory }} </h5>
                <h5>Free HDD: {{ $disk }} </h5>
            </div>
        </div>
        <div class="grid h-fit grid-flow-col grid-rows-3 gap-3">
            <div class="relative col-span-2 max-w-6xl rounded-xl border border-neutral-200 dark:border-neutral-700 ">
                <x-header.card-header :icon="__('wifi')" :title="__('Hotspot')" />
                <div class="flex justify-around border-neutral-200 gap-2 py-3 dark:bg-neutral-800">
                    <x-card.card :icon="__('router')" :title="__('# Devices')" :description="__('Total Active Devices')" class="flex max-w-48 gap-2 border-b rounded-xl border-neutral-400 px-4 py-3 bg-red-400 hover:border-neutral-600 min-w-52" />
                    <x-card.card :icon="__('users')" :title="__('# Users')" :description="__('Total Users Active')" class="flex max-w-48 gap-2 border-b rounded-xl border-neutral-400 px-4 py-3 bg-green-400 hover:border-neutral-600 min-w-52" />
                    <x-card.card :icon="__('user-plus')" :title="__('Add Profile')" :description="__('Add New Profile')" class="flex max-w-48 gap-2 border-b rounded-xl border-neutral-400 px-4 py-3 bg-yellow-400 hover:border-neutral-600 min-w-52" />
                    <x-card.card :icon="__('user-plus')" :title="__('Generate Users')" :description="__('Generate New Users')" class="flex max-w-48 gap-2 border-b rounded-xl border-neutral-400 px-4 py-3 bg-green-400  hover:border-neutral-600 min-w-52" />
                </div>
            </div>
            <div class="relative max-w-6xl col-span-2 row-span-2 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative row-span-3 min-w-lg overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-header.card-header :icon="__('logs')" :title="__('System Log')" />
            </div>
        </div>
        <!-- <div class="relative row-span-2 col-span-2 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div> -->
</x-layouts.app>