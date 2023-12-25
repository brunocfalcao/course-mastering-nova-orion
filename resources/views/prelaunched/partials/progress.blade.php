<div class="max-w-full md:w-1/2 flex flex-col md:flex-row border-2 border-teal-500 rounded-xl py-2">
    <div class="w-full shrink-0 py-10">
        <!-- <div class="w-full md:w-[267.73px] h-[320.52px] shrink-0"> -->
        <div class="relative mx-auto rounded-lg flex flex-col justify-center">
            <svg class="w-[150px] md:w-[195px] h-auto mx-auto" viewBox="0 0 100 100">
                <!-- Background circle -->
                <circle class="text-gray-200 stroke-current" stroke-width="5" cx="50" cy="50" r="40" fill="transparent"></circle>

                <!-- Red circle for remaining progress -->
                <circle class="text-red-500 stroke-current" stroke-width="5" cx="50" cy="50" r="40" fill="transparent"></circle>

                <!-- Gradient border for the progress circle -->
                <circle class="progress-ring__circle" stroke-width="5" stroke-linecap="round" cx="50" cy="50" r="40" fill="transparent" stroke="url(#gradient)" stroke-dashoffset="calculateDashOffset(10)"></circle>

                <!-- Center text with gradient fill -->
                <text x="50" y="50" font-family="Verdana" font-size="14" text-anchor="middle" alignment-baseline="middle" fill="url(#gradient)">30%</text>

                <!-- Define the linear gradient -->
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#00FFC4" />
                        <stop offset="100%" style="stop-color:#56D7FE" />
                    </linearGradient>
                </defs>
            </svg>

            <p class="  font-regular leading-8 text-white text-2xl text-center px-14">Current progress</p>

        </div>
    </div>
</div>
