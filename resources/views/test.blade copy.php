<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="w-full mx-auto justify-center min-h-screen flex flex-col bg-primary-black text-white" style="background: linear-gradient(180deg, #000 44.59%, rgba(1, 1, 1, 0.00) 100%), linear-gradient(180deg, rgba(1, 1, 1, 0.00) 57.01%, #000 100%), linear-gradient(0deg, #7CE0FC 0%, #7CE0FC 100%), url({{ Vite::image('prelaunched-footer-bg.png') }}), lightgray 50% / cover no-repeat;
    background-position: center top 85rem !important;
    background-blend-mode: normal, normal, color, normal;
">

        <div class="w-full mt-10 mb-6">
            <div class="max-w-5xl mx-auto">
                <div class="w-full flex justify-center md:justify-between">
                    <div class="flex flex-row items-center">
                        <img class="w-20 h-20" src="{{ Vite::image('mastering-nova-mascot.svg') }}" alt="mastering nova">
                        <span class="leading-normal tracking-tighter font-satoshi-medium ml-2 text-3xl">
                            masteringnova
                        </span>
                    </div>
                    <div class="hidden md:flex space-x-1 py-4 font-satoshi leadning-normal tracking-tighter text-lg items-center">
                        <a href="#" class="w-full bg-gradient-to-r tracking-wide leading-6 from-teal-400 to-sky-500 py-2 px-8 rounded capitalize text-black font-medium">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>


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
                <div class="heading font-satoshi font-medium text-5xl px-2 md:px-0">
                    Medium, rare, but mostly well-done HTML email components.
                </div>
                <div class="progress-area flex flex-col md:flex-row space-y-8 md:space-y-0 md:space-x-8 mt-8 px-2 md:px-0">
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

                                <p class="font-satoshi font-regular leading-8 text-white text-2xl text-center px-14">Current progress</p>

                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 py-4 border-2 border-teal-500 rounded-xl">
                        <div class="w-full md:h-[320.523px]">
                            <div class="relative flex flex-col justify-center py-4">
                                <p class="text-gradient text-[50px] font-satoshi font-regular text-center px-12 py-8">March 2023</p>
                                <p class="font-satoshi font-regular leading-8 text-white text-2xl text-center px-8">Estimated Launch date</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="px-4 md:px-0 mt-6 text-white pt-4 flex flex-col">
                    <p class="py-2 font-satoshi leading-6 text-lg tracking-wide w-full">Get notified when we launch:</p>
                    <div class="bg-deep-soft-blue flex flex-row rounded justify-start w-full pl-3 py-2">
                        <div class="flex items-center space-y-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                            </svg>
                        </div>
                        <div class="w-full">
                            <div action="#" class="w-full flex flex-row">
                                <div class="flex flex-col justify-between w-full md:w-4/6 px-2">
                                    <label for="email" class="text-xs text-gray-300">Email</label>
                                    <input type="email" id="email" placeholder="user@email.com" class="text-teal-500 bg-transparent border-transparent
                                    focus:outline-none
                                    placeholder-teal-400/50
                                    ring-0 ring-transparent focus:ring-transparent">
                                </div>
                                <div class="hidden md:block md:w-2/6 px-2">
                                    <button class="w-full bg-gradient-to-r tracking-wide leading-6 from-teal-400 to-sky-500 py-2 px-4 rounded capitalize text-black font-medium">
                                        Notify Me
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="block md:hidden w-full mt-4">
                        <button class="w-full bg-gradient-to-r tracking-wide leading-6 from-teal-400 to-sky-500 py-3 px-4 rounded capitalize text-black font-medium">
                            Notify Me
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- style="border: 2.5px solid rgba(255, 255, 255, 0.00); -->

        <div class="flex flex-col md:flex-row max-w-5xl mx-auto py-4 mt-6 md:mt-0">
            <div class="w-full md:w-8/12 flex justify-center text-center md:text-left md:justify-start px-4 md:px-0 mb-4 md:mb-0">
                <p class="text-white text-3xl font-satoshi">
                    If you want to access the previous version of my course, for Orion version, please click this to access it
                </p>
            </div>
            <div class="w-full md:w-4/12 px-4 md:px-4 flex flex-row items-center space-x-2 justify-center md:justify-end">
                <button class="w-full py-3 px-14 text-lg bg-gradient-to-r from-teal-400 to-sky-500 rounded capitalize text-black font-medium">
                    Get Access
                </button>
            </div>
        </div>

        <div class="w-full my-20">
            <div class="max-w-5xl mx-auto">
                <div class="w-full flex flex-col-reverse md:flex-row justify-between">
                    <div class="flex flex-row justify-center md:justify-start items-center">
                        <img class="w-20 h-20" src="{{ Vite::image('mastering-nova-mascot.svg') }}" alt="mastering nova">
                        <span class="leading-normal tracking-tighter font-satoshi-medium ml-2 text-3xl">
                            masteringnova
                        </span>
                    </div>
                    <div class="space-x-1 py-4 font-satoshi leadning-normal tracking-tighter text-lg flex flex-col md:flex-row items-center">
                        <a href="#" class="hover:underline">
                            Contact
                        </a>
                        <span class="hidden md:block">|</span>
                        <a href="#" class="hover:underline">
                            Privacy and Cookie Policy
                        </a>
                        <span class="hidden md:block">|</span>
                        <a href="#" class="hover:underline">Terms of Usage</a>
                        <span class="hidden md:block">|</span>
                        <a href="#" class="hover:underline">Twitter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateDashOffset(percentage) {
            const circumference = 2 * Math.PI * 40; // Circumference of the circle
            const progress = (100 - percentage) / 100; // Calculate the remaining progress
            return progress * circumference;
        }

        // Add this script to handle dynamic dash offset calculation
        document.addEventListener('DOMContentLoaded', function() {

            const progressCircle = document.querySelector('.progress-ring__circle');
            const textElement = document.querySelector('text');

            // Set initial dash offset based on the percentage
            progressCircle.setAttribute('stroke-dashoffset', calculateDashOffset(20));
            textElement.innerHTML = '10%'; // Update text
        });
    </script>
</body>


</html>
