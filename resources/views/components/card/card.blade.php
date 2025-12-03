<div {{ $attributes }}>
    @if($icon)
    <span class="iconify text-6xl text-black">
        <flux:icon :name="$icon" class="text-6xl text-black" />
    </span>
    @endif
    <div class="flex flex-col">
        @if($title)
        <h3 class="text-md font-medium text-neutral-950 dark:text-neutral-800">{{ $title }}</h3>
        @endif
        @if($description)
        <p class="text-sm text-neutral-800 dark:text-neutral-950">{{ $description }}</p>
        @endif
    </div>
</div>