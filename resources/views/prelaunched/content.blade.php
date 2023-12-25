<div class="w-full lg:max-w-7xl flex flex-col md:flex-row mx-auto px-2 pb-4 md:px-20 md:pb-20 space-y-10 md:space-y-0 md:space-x-10">
    <div class="hidden md:block md:w-1/2 bg-deep-soft-blue rounded-lg py-18">
        <div class="w-full flex flex-row mt-20 shadow-xl">
            <div class="w-3/6 h-[32rem] bg-cover bg-start object-scale-up rounded-tl-lg rounded-bl-lg mt-0 z-10 -mx-[8rem]" style="background-image: url({{ Vite::image('prelaunched-image.png') }})">
            </div>

            <div class="w-full h-[32rem] bg-cover bg-center" style="background-image: url({{ Vite::image('prelaunched-image.png') }})">
            </div>
        </div>
    </div>


    <div class="flex flex-col w-full md:w-1/2">
        <div class="heading font-medium text-5xl px-2 md:px-0">
            Medium, rare, but mostly well-done HTML email components.
        </div>
        <div class="progress-area flex flex-col md:flex-row space-y-8 md:space-y-0 md:space-x-8 mt-8 px-2 md:px-0">

            @include('course::prelaunched.partials.progress')
            @include('course::prelaunched.partials.expected-launch-date')

        </div>

        <div class="px-4 md:px-0 mt-6 text-white pt-4 flex flex-col">

            @include('course::prelaunched.partials.new-subscriber-form')

        </div>

    </div>
</div>
