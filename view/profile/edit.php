<?php view('components/head', ['title' => 'Profile']) ?>
<?php view('components/side-nav') ?>

<div class="min-h-screen bg-gray-100 <?php echo (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['admin','teacher'])) ? 'pl-[250px]' : ''; ?> transition-all duration-300">
  <section class="flex items-center justify-center py-12">
    <div class="w-full max-w-4xl bg-white rounded-2xl overflow-hidden">
      <div class="md:flex">
        <div class="w-full md:w-1/2 bg-gradient-to-br bg-black p-8 flex flex-col items-center text-white">
          <div class="relative">
            <img id="profilePreview" class="w-32 h-32 rounded-full border-4 border-white object-cover" src="<?= 
              $_SESSION['user']['avatar'] 
                ? $_SESSION['user']['avatar'] 
                : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' 
            ?>" alt="Profile Image">
            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 hover:opacity-100 rounded-full transition-opacity">
              <label for="profileImage" class="cursor-pointer flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-sm">Change</span>
              </label>
              <input type="file" id="profileImage" name="profileImage" accept="image/*" class="hidden" form="imageUploadForm">
            </div>
          </div>

          <h2 class="mt-6 text-2xl font-bold"><?php echo htmlspecialchars(
            $_SESSION['user']['name'], ENT_QUOTES
          ); ?></h2>
          <p class="mt-2 text-md opacity-75"><?php echo htmlspecialchars(
            $_SESSION['user']['email'], ENT_QUOTES
          ); ?></p>

          <form id="imageUploadForm" method="post" action="/profile/<?= $id ?>/upload" enctype="multipart/form-data" class="mt-6 w-full">
            <button type="submit" class="w-full bg-white text-blue-600 font-semibold py-2 rounded-lg hover:bg-gray-100 transition">Save Image</button>
          </form>

          <a href="/logout" class="mt-4 w-full">
            <button class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 rounded-lg transition">Logout</button>
          </a>
        </div>

        <div class="w-full md:w-1/2 p-8">
          <h3 class="text-xl font-semibold text-gray-800 mb-4">Account Details</h3>
          <div class="space-y-4">
            <div>
              <label class="block text-gray-600 text-sm">Name</label>
              <input readonly class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50" value="<?php echo htmlspecialchars(
                $_SESSION['user']['name'], ENT_QUOTES
              ); ?>">
            </div>
            <div>
              <label class="block text-gray-600 text-sm">Email</label>
              <input readonly class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50" value="<?php echo htmlspecialchars(
                $_SESSION['user']['email'], ENT_QUOTES
              ); ?>">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php view('components/footer') ?>
