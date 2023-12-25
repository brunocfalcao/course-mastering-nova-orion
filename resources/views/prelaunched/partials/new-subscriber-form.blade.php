<form method="POST" action="{{ route('prelaunched.subscribe') }}" class="flex flex-col w-full">
    @csrf

    <p class="py-2   leading-6 text-lg tracking-wide w-full">Get notified when we launch:</p>
    <div class="bg-deep-soft-blue flex flex-row rounded justify-start w-full pl-3 py-2">
        <div class="flex items-center space-y-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
            </svg>
        </div>
        <div class="w-full">
            <div action="#" class="w-full flex flex-row items-center">
                <div class="flex flex-col justify-between w-full md:w-4/6 px-2">
                    <label for="email" class="text-xs text-gray-300 px-3">Email</label>
                    <input type="email" name="email" required id="email" placeholder="user@email.com" value="{{ old('email') }}" class="text-teal-500 bg-transparent focus:outline-none border-transparent focus:border-transparent focus:ring-0 placeholder-teal-400/50 ring-0 ring-transparent focus:ring-transparent">
                </div>
                <div class="hidden md:flex md:w-2/6 px-4">
                    <button type="submit" class="w-full text-lg bg-gradient-to-r tracking-wide leading-6 from-teal-400 to-sky-500 py-2 px-4 rounded capitalize text-black font-medium">
                        Notify Me
                    </button>
                </div>
            </div>
        </div>
    </div>

    @error('email')
    <p class="font-2xl text-red-400">
        {{ $message }}
    </p>
    @enderror

    @if(session()->has('message'))
    <p class="font-2xl text-teal-400">
        {{ session()->get('message') }}
    </p>
    @endif

    <div class="block md:hidden w-full mt-4">
        <button type="submit" class="w-full bg-gradient-to-r text-lg tracking-wide leading-6 from-teal-400 to-sky-500 py-3 px-4 rounded capitalize text-black font-medium">
            Notify Me
        </button>
    </div>
</form>
