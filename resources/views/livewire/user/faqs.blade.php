<div class="container mx-auto  px-4">
<div class="md:text-start text-center ">
    <span class="text-6xl  font-bold text-green-900">FAQ</span>
</div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($faqs as $faq)
            <div class="bg-white shadow-lg rounded-lg p-6 h-60 "  style="background-image: url('{{ asset('images/question-mark.png') }}');  background-size: 50% auto; background-position: right; background-repeat: no-repeat; margin-top:20px; ">
                <div class="text-lg font-semibold text-green-900 mb-3">{{ $faq->title }}</div>
                <p class="text-gray-700">{{ $faq->description }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{$faqs->links() }}
    </div>
</div>
