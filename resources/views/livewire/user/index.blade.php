<div class="flex flex-col items-center justify-center text-center text-black py-16 px-4">

    <div class="w-full max-w-4xl mx-auto mb-12 px-4 py-6 flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">


        <div class="text-center flex-1">
            <img src="{{ asset('images/dental.png') }}" alt="Janolo Clinic Logo" class="w-32 h-32 mb-6 transition-transform duration-500 transform hover:scale-110 mx-auto">
            <h1 class="text-4xl font-bold text-black mb-4 animate__animated animate__fadeIn">Welcome to Janolo Clinic</h1>
            <p class="text-lg text-black mb-8 animate__animated animate__fadeIn animate__delay-1s">
                Providing exceptional dental care for you and your family.
            </p>
        </div>

        <div class="text-lg text-black flex-1">
            <h2 class="text-3xl font-semibold text-green-600 mb-4">Our Hours</h2>
            <div class="space-y-2">
                <p><span class="font-bold">Monday to Saturday</span> 8:00 AM - 5:00 PM</p>
                <p><span class="font-bold">Sunday:</span> Closed</p>
            </div>
        </div>

    </div>

    <!-- Contact Button -->
    <a href="{{ route('user.services') }}" class="px-6 py-3 bg-white text-green-500 font-semibold rounded-md hover:bg-green-600 transition duration-300 transform hover:scale-105 mb-6">
        Discover Our Services
    </a>


    <div class="flex flex-wrap justify-center items-center space-x-6 mt-12 px-4">

        <div class="text-center max-w-xs mb-6 md:mb-0 md:max-w-sm">
            <h3 class="text-2xl font-semibold text-black">Affordable Care</h3>
            <p class="text-black mt-4">We provide high-quality dental treatments at prices that won’t break your budget.</p>
        </div>

        <div class="text-center max-w-xs mb-6 md:mb-0 md:max-w-sm">
            <h3 class="text-2xl font-semibold text-black">Experienced Professionals</h3>
            <p class="text-black mt-4">Our team is composed of highly skilled and experienced dental professionals.</p>
        </div>

        <div class="text-center max-w-xs mb-6 md:mb-0 md:max-w-sm">
            <h3 class="text-2xl font-semibold text-black">Modern Technology</h3>
            <p class="text-black mt-4">We use the latest in dental technology to provide you with efficient, comfortable treatment.</p>
        </div>
    </div>


    <div class="mt-12 text-center">
        <h3 class="text-xl font-semibold text-black mb-4">Contact Us</h3>
        <p class="text-lg text-black mb-2"><strong>Phone:</strong> 0928-555-5670</p>
        <p class="text-lg text-black"><strong>Location:</strong> 407 Real St., J Casim Compound, Talon 1, Las Piñas City</p>
    </div>

</div>
