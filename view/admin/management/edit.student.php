<?php view('components/head', ['title' => 'Edit Student']) ?>
<?php view('components/side-nav') ?>

<div class="min-h-screen bg-gray-100 pl-[250px] transition-all duration-300">
	<section class="py-12">
		<div class="container mx-auto px-4">
			<div class="mb-6 flex items-center justify-between">
				<h1 class="text-3xl font-bold text-black">Edit Student</h1>
				<a href="/management?section=student" class="px-6 py-2 bg-gray-600 text-white font-medium rounded-md hover:bg-gray-700">
					Back to List
				</a>
			</div>

			<?php if (isset($_SESSION['error'])): ?>
				<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
					<p><?php echo $_SESSION['error']; ?></p>
					<?php unset($_SESSION['error']); ?>
				</div>
			<?php endif; ?>

			<?php if (isset($_SESSION['success'])): ?>
				<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
					<p><?php echo $_SESSION['success']; ?></p>
					<?php unset($_SESSION['success']); ?>
				</div>
			<?php endif; ?>

			<div class="bg-white rounded-lg shadow-md p-6">
				<form action="/update/<?php echo $student['user_id']; ?>/student" method="post" class="space-y-4">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="id" value="<?php echo $student['id']; ?>">
					<input type="hidden" name="user_id" value="<?php echo $student['user_id']; ?>">
					<input type="hidden" name="role" value="student">

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label for="first_name" class="block text-sm font-medium text-black mb-1">First Name</label>
							<input type="text" id="first_name" name="first_name" required
								value="<?php echo $student['first_name']; ?>"
								class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
						</div>

						<div>
							<label for="last_name" class="block text-sm font-medium text-black mb-1">Last Name</label>
							<input type="text" id="last_name" name="last_name" required
								value="<?php echo $student['last_name']; ?>"
								class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
						</div>

						<div>
							<label for="email" class="block text-sm font-medium text-black mb-1">Email</label>
							<input type="email" id="email" name="email" required
								value="<?php echo $student['email']; ?>"
								class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
						</div>

						<div>
							<label for="id_number" class="block text-sm font-medium text-black mb-1">Student ID</label>
							<input type="text" id="id_number" name="id_number" required
								value="<?php echo $student['id_number']; ?>"
								class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
						</div>

						<div>
							<label for="class" class="block text-sm font-medium text-black mb-1">Class</label>
							<select id="class" name="class" required
								class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
								<option value="">Select Class</option>
								<?php foreach ($classes as $class): ?>
									<option value="<?php echo $class['name']; ?>" <?php echo ($student['class'] == $class['name']) ? 'selected' : ''; ?>>
										<?php echo $class['name']; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="pt-4 border-t mt-6">
						<h3 class="text-lg font-medium mb-4">Change Password (leave blank to keep current password)</h3>
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div>
								<label for="password" class="block text-sm font-medium text-black mb-1">New Password</label>
								<input type="password" id="password" name="password"
									class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
							</div>
							<div>
								<label for="password_confirmation" class="block text-sm font-medium text-black mb-1">Confirm Password</label>
								<input type="password" id="password_confirmation" name="password_confirmation"
									class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
							</div>
						</div>
					</div>

					<div class="flex justify-end mt-6">
						<button type="submit" class="px-6 py-2 bg-black text-white font-medium rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
							Update Student
						</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>

<?php view('components/footer') ?>
