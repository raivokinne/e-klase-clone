<?php view('components/head', ['title' => 'Home']) ?>

<section class="grid place-items-center min-h-screen w-full">
    <article class="max-w-7xl p-8 flex flex-col justify-center items-center">
        <h1 class="text-6xl sm:text-6xl font-extrabold text-center mb-6 font-libre_baskerville_regular">
            E-gay
        </h1>
        <p class="text-center text-xs sm:text-lg w-[500px] text-gray-700">
            E-gay is the best e-klases alternative for schools.
        </p>
        <a href="/register">
            <button class="mt-8 px-6 py-3 bg-black text-white font-semibold rounded-lg shadow-md hover:bg-gray-800 transition duration-300">
                Get Started
            </button>
        </a>
    </article>
</section>

<?php view('components/footer') ?>