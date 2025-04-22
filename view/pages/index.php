<?php view('components/head', ['title' => 'Home']) ?>

<section class="grid md:grid-cols-2 min-h-screen w-full">
    <article class="max-w-7xl p-8 flex flex-col justify-center items-center">
        <h1 class="text-6xl sm:text-6xl font-extrabold text-center mb-6 font-libre_baskerville_regular">
            Enjoy your dream holiday
        </h1>
        <p class="text-left text-xs sm:text-lg w-3/4 sm:w-2/3 text-gray-700">
            Viesnica is a simple application that allows you to book your favorite rooms.
        </p>
        <a href="/register">
            <button class="mt-8 px-6 py-3 bg-black text-white font-semibold rounded-lg shadow-md hover:bg-gray-800 transition duration-300">
                Get Started
            </button>
        </a>
    </article>

    <article class="w-full h-full bg-no-repeat bg-cover bg-center" style="background-image: url('/assets/bg.jpg')"></article>
</section>

<?php view('components/footer') ?>