@props(['chirps', 'showEdit' => false])

@foreach ($chirps as $chirp)
    <div
        class="mb-5 text-[13px] leading-5 flex-1 bg-white dark:bg-lightGrey dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg relative">
        @if (Auth::user()->id === $chirp->user_id && $showEdit)
            <div class="absolute top-4 right-4">
                <a href="{{ route('chirp.edit', $chirp->id) }}" class="text-white hover:text-gray-300 transition-colors"
                    title="Edit Chirp">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </a>
            </div>
        @endif
        <div class="p-8 lg:p-10 lg:pb-8">
            @foreach (preg_split('/\n+/', $chirp->message) as $message)
                @if (trim($message) !== '')
                    <p class="text-white text-md not-last:mb-3">{{ $message }}</p>
                @endif
            @endforeach
            @if ($chirp->image !== null)
                <img class="aspect-square lg:aspect-video max-h-100 object-cover rounded-lg mt-6"
                    src="{{ Storage::url($chirp->image) }}" alt="" />
            @endif
        </div>
        <div class="p-8 lg:px-10 lg:pb-10 flex justify-between items-center">
            <div class="flex gap-4 items-center">
                @if ($chirp->user->logo !== null)
                    <img width="40" height="40" class="size-10 rounded-full"
                        src="{{ Storage::url($chirp->user->logo) }}" alt="User profile picture" />
                @endif
                <span>{{ $chirp->user->name }}</span>
            </div>
            <span class="text-sm text-white">{{ $chirp->time_diff }}</span>
        </div>
    </div>
@endforeach

@if ($chirps->count() == 0)
    <div
        class="mb-5 text-[13px] leading-5 flex-1 bg-white dark:bg-lightGrey dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg">
        <div class="p-12">
            <p class="text-white">No chirps yet</p>
        </div>
    </div>
@endif
