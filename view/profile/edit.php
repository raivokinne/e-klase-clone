<?php view('components/head', ['title' => 'Profile']) ?>
<section class="grid grid-cols-2 px-4 py-6 bg-gray-100">
    <div class="w-full h-full max-w-6xl">
        <header class="px-6 mx-auto ml-20 max-w-7xl lg:px-8 mt-36">
            <h2 class="text-3xl font-semibold text-gray-800">Profile</h2>
        </header>

        <div class="px-6 mx-auto mt-10 max-w-7xl lg:px-8">
            <div class="relative w-[400px] h-[400px] mx-auto mb-10 mt-20">
                <img class="object-cover w-full h-full border-4 border-gray-200 rounded-full" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profile Image" />
                <div class="absolute inset-0 flex flex-col items-center justify-center transition-opacity bg-black bg-opacity-50 rounded-full opacity-0 hover:opacity-100">
                    <h1 class="mb-2 text-sm font-bold text-white">Change Image</h1>
                    <input type="file" class="px-3 py-1 text-sm text-white bg-gray-800 rounded cursor-pointer" />
                </div>
            </div>

            <div class="text-center">
                <h2 class="text-sm font-medium text-gray-900">Name:
                    <span class="text-gray-700">
                        <?php echo $_SESSION['user']['name'] ?>
                    </span>
                </h2>
                <h2 class="mt-4 text-sm font-medium text-gray-900">Email:
                    <span class="text-gray-700">
                        <?php echo $_SESSION['user']['email'] ?>
                    </span>
                </h2>
            </div>

        </div>
    </div>

    <div class="py-12 mt-20">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <?php view('profile/partials/update-profile-information-form') ?>
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <?php view('profile/partials/update-password-form') ?>
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <?php view('profile/partials/delete-user-form') ?>
                </div>
            </div>
            <a href="/logout" class="flex items-center justify-end w-full">
                <button class="w-[400px] shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-gray-700 hover:bg-gray-600 focus:outline-none mt-10">Logout</button>
            </a>
        </div>
    </div>
</section>
<?php view('components/footer') ?>