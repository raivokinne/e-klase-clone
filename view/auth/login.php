<?php view('components/head', ['title' => 'Login']) ?>
<div class="font-[sans-serif] text-[#333]">
    <div class="flex items-center justify-center min-h-screen px-4 py-6">
        <div class="grid w-[400px] gap-10">
            <form class="w-full max-w-md space-y-6 md:ml-auto max-md:mx-auto" action="/login" method="post">
                <h3 class="mb-8 text-3xl font-extrabold max-md:text-center">
                    Sign in
                </h3>
                <div>
                    <input name="email" type="email" autocomplete="email" required class="bg-gray-100 w-full text-sm px-4 py-3.5 rounded-md outline-blue-600" placeholder="Email address" name="email" />
                    <?php if (isset($errors['email']) || isset($errors['empty'])) : ?>
                        <p class="text-xs font-semibold text-red-500 error">
                            <?= $errors['empty'] ?? $errors['email'] ?>
                        </p>
                    <?php endif ?>
                </div>
                <div>
                    <input name="password" type="password" autocomplete="current-password" required class="bg-gray-100 w-full text-sm px-4 py-3.5 rounded-md outline-blue-600" placeholder="Password" name="password" />
                    <?php if (isset($errors['empty'])) : ?>
                        <p class="text-xs font-semibold text-red-500 error">
                            <?= $errors['empty'] ?>
                        </p>
                    <?php endif ?>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                        <label for="remember-me" class="block ml-3 text-sm">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="jajvascript:void(0);" class="text-blue-600 hover:text-blue-500">
                            Forgot your password?
                        </a>
                    </div>
                </div>
                <div class="!mt-10">
                    <button type="submit" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-gray-700 hover:bg-gray-600 focus:outline-none">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php view('components/footer') ?>