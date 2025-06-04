<?php view('components/head', ['title' => 'Teacher Dashboard'])?>
<?php view('components/side-nav')?>

<div class="min-h-screen bg-gray-100 pl-[250px] transition-all duration-300">
	<section class="py-12">
		<div class="container mx-auto px-4">
			<div class="mb-6">
				<h1 class="text-3xl font-bold text-black">Welcome,				                                                  				                                                   <?php echo htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']); ?></h1>
				<p class="text-gray-600 mt-2">Teacher ID:				                                         				                                          <?php echo htmlspecialchars($teacher['id_number']); ?></p>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<!-- Teacher Information Card -->
				<div class="bg-white rounded-lg shadow-md p-6">
					<h2 class="text-xl font-semibold text-black mb-4">Teacher Information</h2>
					<div class="space-y-3">
						<div>
							<label class="text-sm font-medium text-gray-500">Full Name</label>
							<p class="text-black"><?php echo htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']); ?></p>
						</div>
						<div>
							<label class="text-sm font-medium text-gray-500">Email</label>
							<p class="text-black"><?php echo htmlspecialchars($teacher['email']); ?></p>
						</div>
						<div>
							<label class="text-sm font-medium text-gray-500">Teacher ID</label>
							<p class="text-black"><?php echo htmlspecialchars($teacher['id_number']); ?></p>
						</div>
						<div>
							<label class="text-sm font-medium text-gray-500">Subject</label>
							<p class="text-black"><?php echo htmlspecialchars($subject['name']); ?></p>
						</div>
					</div>
				</div>

				<!-- Quick Actions Card -->
				<div class="bg-white rounded-lg shadow-md p-6">
					<h2 class="text-xl font-semibold text-black mb-4">Quick Actions</h2>
					<div class="grid grid-cols-1 gap-4">
						<a href="/grades" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
							</svg>
							<span class="text-black">Manage Grades</span>
						</a>
						<a href="/curriculum" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
							</svg>
							<span class="text-black">View Curriculum</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php view('components/footer')?>
