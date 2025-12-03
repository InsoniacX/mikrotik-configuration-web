<div class="relative aspect-[19/9] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
    <x-header.card-header :icon="$icon" :title="$title" />
    <div class="mx-5 my-4 flex flex-col gap-3">
        @foreach ($items as $item)
        @if ($item['span'] ?? false)
        <h5 class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">
            {{ $item['label'] }}<span id="{{ $item['id'] }}">{{ $item['value'] }}</span>
        </h5>
        @else
        <h5 id="{{ $item['id'] }}" class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">
            {{ $item['label'] }}{{ $item['value'] }}
        </h5>
        @endif
        @endforeach
    </div>
</div>