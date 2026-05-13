<x-app-layout>

    <h1>Frequently Asked Questions</h1>

    @foreach($faqs as $faq)
        <div>
            <h2>{{ $faq->question }}</h2>
            <p>{{ $faq->answer }}</p>
        </div>
    @endforeach

</x-app-layout>
