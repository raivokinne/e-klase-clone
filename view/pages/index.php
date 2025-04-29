<?php view('components/head', ['title' => 'Home']) ?>
<?php view('components/side-nav') ?>

<div class="overflow-x-hidden w-full">
	<section class="grid place-items-center min-h-screen w-full transition-all duration-300">
		<article class="max-w-7xl p-8 flex flex-col justify-center items-center">
			<h1 class="text-6xl sm:text-6xl font-extrabold text-center mb-6 font-libre_baskerville_regular">
				Home
			</h1>

			<?php if (isset($_SESSION["user"])): ?>
				<div class="bg-zinc-100 p-6 rounded-lg shadow-md w-full max-w-3xl">
					<h2 class="text-2xl font-bold mb-4">Welcome, <?php echo htmlspecialchars($_SESSION["user"]["first_name"] ?? "User"); ?></h2>

					<?php if ($_SESSION["user"]["role"] === "admin"): ?>
						<p class="mb-4">Access your administrative tools through the side navigation panel.</p>
					<?php elseif ($_SESSION["user"]["role"] === "teacher"): ?>
						<p class="mb-4">Manage your subjects and student grades using the navigation menu.</p>
					<?php elseif ($_SESSION["user"]["role"] === "student"): ?>
						<p class="mb-4">View your course information and grades through the navigation bar above.</p>
					<?php endif; ?>
				</div>
			<?php else: ?>
				<div class="bg-zinc-100 p-6 rounded-lg shadow-md w-full max-w-3xl">
					<h2 class="text-2xl font-bold mb-4">Welcome to ClassNet</h2>
					<p class="mb-4">Please log in to access your personalized dashboard.</p>
					<a href="/login" class="inline-block px-4 py-2 bg-zinc-900 text-white rounded-lg hover:bg-zinc-800 transition-all duration-300">Login</a>
				</div>
			<?php endif; ?>

		</article>
	</section>
</div>

<?php view('components/footer') ?>
