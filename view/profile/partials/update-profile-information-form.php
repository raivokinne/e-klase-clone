<?php

use Core\Session;

?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Update your account's profile information and email address.
        </p>

    </header>

    <form method="POST" action="/profile/<?php echo $_SESSION['user']['id']; ?>/update" class="mt-6 space-y-6">
        <input type="hidden" name="_method" value="PUT">
        <div>
            <label for="update_name">Name</label>
            <input id="update_name" name="name" type="text" class="block w-full px-4 py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?php echo $_SESSION['user']['name']; ?>" />
            <?php if (isset($info_errors)) : ?>
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    <?php echo $info_errors['name']; ?>
                </p>
            <?php endif ?>
        </div>

        <div>
            <label for="update_email">Email</label>
            <input id="update_email" name="email" type="email" class="block w-full px-4 py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?php echo $_SESSION['user']['email']; ?>" />
            <?php if (isset($info_errors)) : ?>
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    <?php echo $info_errors['email']; ?>
                </p>
            <?php endif ?>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-gray-700 hover:bg-gray-600 focus:outline-none">Save</button>

        </div>
    </form>
</section>