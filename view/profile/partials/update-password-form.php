<?php

use Core\Session;

?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Update Password
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="/profile/<?php echo $_SESSION['user']['id']; ?>/password" class="mt-6 space-y-6">
        <input type="hidden" name="_method" value="PUT">
        <div>
            <label for="update_password_current_password">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="block w-full px-4 py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" autocomplete="current-password" />
            <?php if (isset($pasword_errors)) : ?>
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    <?php echo $pasword_errors['current_password'] ?>
                </p>
            <?php endif ?>
        </div>

        <div>
            <label for="update_password_password">New Password</label>
            <input id="update_password_password" name="password" type="password" class="block w-full px-4 py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" autocomplete="new-password" />
            <?php if (isset($pasword_errors)) : ?>
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    <?php echo $pasword_errors['password'] ?>
                </p>
            <?php endif ?>
        </div>

        <div>
            <label for="update_password_password_confirmation">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full px-4 py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" autocomplete="new-password" />
            <?php if (isset($password_errors)) : ?>
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    <?php echo $password_errors['password_confirmation']; ?>
                </p>
            <?php endif ?>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-gray-700 hover:bg-gray-600 focus:outline-none">Save</button>

        </div>
    </form>
</section>