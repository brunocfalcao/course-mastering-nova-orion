@extends('course::layouts.prelaunched')

@section('title', 'Mastering Nova by Bruno C. Falcao')

@section('content')
<div class="w-full mx-auto justify-center min-h-screen flex flex-col bg-primary-black text-white"
style="
    background: linear-gradient(180deg, #000 44.59%, rgba(1, 1, 1, 0.00) 100%), linear-gradient(180deg, rgba(1, 1, 1, 0.00) 57.01%, #000 100%), linear-gradient(0deg, #7CE0FC 0%, #7CE0FC 100%), url({{ Vite::image('prelaunched-bg.png') }}), lightgray 50% / cover no-repeat;
    background-position: center top 85rem !important;
    background-blend-mode: normal, normal, color, normal;
">

    @include('course::prelaunched.navbar')

    @include('course::prelaunched.content')

    @include('course::prelaunched.get-access')

    @include('course::prelaunched.footer')

</div>
@endsection

@push('scripts')
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
@endpush
