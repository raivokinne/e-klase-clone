<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Delete Account
        </h2>
    </header>

    <div>
        <form method="post" action="/profile/<?php echo $_SESSION['user']['id']; ?>/delete" class="p-6">

            <input type="hidden" name="_method" value="DELETE">

            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete your account?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter
                your password to confirm you would like to permanently delete your account.
            </p>

            <div class="mt-6">
                <label for="current-password" class="block text-sm font-medium text-gray-700">Password</label>

                <input id="current-password" name="current-password" type="current-password" class="block w-3/4 px-4 py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Password" />

                <?php if (isset($delete_errors)) : ?>
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        <?php echo $delete_errors['current-password']; ?>
                    </p>
                <?php endif ?>
            </div>

            <div class="flex justify-end mt-6">
                <button type="button" class="text-sm text-gray-600 underline dark:text-gray-400 hover:text-gray-500">
                    Cancel
                </button>

                <button class="text-sm text-red-600 ms-3 dark:text-red-500 hover:text-red-400" type="submit">
                    Delete Account
                </button>
            </div>
        </form>
    </div>
</section>