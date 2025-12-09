<div class="flex items-center justify-between p-8 lg:px-10 lg:pb-10">
    <div class="flex items-center gap-4">
        @if ($chirp->user->logo !== null)
            <img
                width="40"
                height="40"
                class="size-10 rounded-full"
                src="{{ Storage::url($chirp->user->logo) }}"
                alt="User profile picture"
            />
        @endif

        <span>{{ $chirp->user->name }}</span>
    </div>
    <span class="text-sm text-white">{{ $chirp->time_diff }}</span>
</div>
