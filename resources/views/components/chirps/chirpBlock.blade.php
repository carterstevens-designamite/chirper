@props([
    'chirps',
    'showEdit' => false,
    'likedIds' => [],
])

@foreach ($chirps as $chirp)
    @php
        $isLiked = in_array($chirp->id, $likedIds);
        $likesCount = $chirp->likes_count;
    @endphp

    <div
        class="dark:bg-lightGrey relative mb-5 flex-1 rounded-lg bg-white text-[13px] leading-5 shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"
    >
        @if ($showEdit)
            @can('update', $chirp)
                <div class="absolute top-4 right-4">
                    <a
                        href="{{ route('chirp.edit', $chirp->id) }}"
                        class="text-white transition-colors hover:text-gray-300"
                        title="Edit Chirp"
                    >
                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                            ></path>
                        </svg>
                    </a>
                </div>
            @endcan
        @endif

        <div class="p-8 lg:p-10 lg:pb-8">
            @foreach (preg_split('/\n+/', $chirp->message) as $message)
                @if (trim($message) !== '')
                    <p class="text-md text-white not-last:mb-3">{{ $message }}</p>
                @endif
            @endforeach

            @if ($chirp->image !== null)
                <img
                    class="mt-6 aspect-square max-h-100 rounded-lg object-cover lg:aspect-video lg:min-h-75 lg:w-full"
                    src="{{ Storage::url($chirp->image) }}"
                    alt=""
                />
            @endif
        </div>
        <x-chirps.likeChirp :chirp="$chirp" :isLiked="$isLiked" :likesCount="$likesCount" />
        <x-chirps.chirpFooter :chirp="$chirp" />
    </div>
@endforeach

<x-chirps.chirpEmpty :chirps="$chirps" />
