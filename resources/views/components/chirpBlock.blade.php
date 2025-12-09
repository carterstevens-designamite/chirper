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
        <div
            class="flex items-center justify-end gap-4 p-8 py-0 lg:px-10"
            x-data="likeHandler(
                        {{ $chirp->id }},
                        {{ $isLiked ? 'true' : 'false' }},
                        {{ $likesCount }},
                    )"
        >
            <button x-on:click="toggleLike" class="like-button">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    version="1.1"
                    width="25"
                    height="25"
                    viewBox="0 0 256 256"
                    xml:space="preserve"
                >
                    <g
                        style="
                            stroke: none;
                            stroke-width: 0;
                            stroke-dasharray: none;
                            stroke-linecap: butt;
                            stroke-linejoin: miter;
                            stroke-miterlimit: 10;
                            fill: none;
                            fill-rule: nonzero;
                            opacity: 1;
                        "
                        transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)"
                    >
                        <path
                            d="M 45 84.334 L 6.802 46.136 C 2.416 41.75 0 35.918 0 29.716 c 0 -6.203 2.416 -12.034 6.802 -16.42 c 4.386 -4.386 10.217 -6.802 16.42 -6.802 c 6.203 0 12.034 2.416 16.42 6.802 L 45 18.654 l 5.358 -5.358 c 4.386 -4.386 10.218 -6.802 16.42 -6.802 c 6.203 0 12.034 2.416 16.42 6.802 l 0 0 l 0 0 C 87.585 17.682 90 23.513 90 29.716 c 0 6.203 -2.415 12.034 -6.802 16.42 L 45 84.334 z M 23.222 10.494 c -5.134 0 -9.961 2 -13.592 5.63 S 4 24.582 4 29.716 s 2 9.961 5.63 13.592 L 45 78.678 l 35.37 -35.37 C 84.001 39.677 86 34.85 86 29.716 s -1.999 -9.961 -5.63 -13.592 l 0 0 c -3.631 -3.63 -8.457 -5.63 -13.592 -5.63 c -5.134 0 -9.961 2 -13.592 5.63 L 45 24.311 l -8.187 -8.187 C 33.183 12.494 28.356 10.494 23.222 10.494 z"
                            style="
                                stroke: none;
                                stroke-width: 1;
                                stroke-dasharray: none;
                                stroke-linecap: butt;
                                stroke-linejoin: miter;
                                stroke-miterlimit: 10;
                                fill: rgb(255, 255, 255);
                                fill-rule: nonzero;
                                opacity: 1;
                            "
                            transform=" matrix(1 0 0 1 0 0) "
                            stroke-linecap="round"
                        />
                    </g>
                </svg>
            </button>
            <span x-text="likesCount"></span>
        </div>
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
    </div>
@endforeach

@if ($chirps->count() == 0)
    <div
        class="dark:bg-lightGrey mb-5 flex-1 rounded-lg bg-white text-[13px] leading-5 shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"
    >
        <div class="p-12">
            <p class="text-white">No chirps yet</p>
        </div>
    </div>
@endif

<script>
    function likeHandler(chirpId, initialState, likesCount) {
        return {
            isLiked: initialState,
            likesCount: likesCount,
            toggleLike() {
                const url = `/chirp/${chirpId}/like`;

                fetch(url, {
                    method: this.isLiked ? 'DELETE' : 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                    .then((response) => {
                        if (response.ok) {
                            this.isLiked = !this.isLiked;
                            this.likesCount = this.isLiked ? this.likesCount + 1 : this.likesCount - 1;
                        } else {
                            console.error('Failed to toggle favorite.');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            },
        };
    }
</script>
