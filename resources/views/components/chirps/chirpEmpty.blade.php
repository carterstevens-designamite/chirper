@if ($chirps->count() == 0)
    <div
        class="dark:bg-lightGrey mb-5 flex-1 rounded-lg bg-white text-[13px] leading-5 shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"
    >
        <div class="p-12">
            <p class="text-white">No chirps yet</p>
        </div>
    </div>
@endif
