<div class="flex items-center gap-2 border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
    @if($icon)
    <span class="iconify text-2xl text-neutral-600 dark:text-neutral-300">
        <flux:icon :name="$icon" class="text-2xl text-neutral-600 dark:text-neutral-300" />
    </span>
    @endif
    @if($title)
    <h2 class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">{{ $title }}</h2>
    @endif
</div>