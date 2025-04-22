<?php view('components/head', ['title' => 'Login']) ?>
<div class="font-[sans-serif] text-[#333]">
    <div class="flex items-center justify-center min-h-screen px-4 py-6 fle-col">
        <div class="grid items-center w-full max-w-6xl gap-10 md:grid-cols-2">
            <div class="max-md:text-center">
                <h2 class="lg:text-5xl text-4xl font-extrabold lg:leading-[55px]">
                    Get your dream holiday
                </h2>
                <p class="mt-6 text-sm">Immerse yourself in a hassle-free experience. Simplify your journey with our intuitively designed platform. Effortlessly book your favorite rooms.</p>
                <div class="mt-10">
                    <img src="/assets/register-bg.jpg" alt="" class="w-full">
                </div>
            </div>
            <form class="w-full max-w-md space-y-6 md:ml-auto max-md:mx-auto" action="/register" method="post">
                <h3 class="mb-8 text-3xl font-extrabold max-md:text-center">
                    Create account
                </h3>
                <div>
                    <input name="name" type="name" autocomplete="name" name="name" class="bg-gray-100 w-full text-sm px-4 py-3.5 rounded-md outline-blue-600" placeholder="Name" />
                    <?php if (isset($errors['name']) || isset($errors['empty'])) : ?>
                        <p class="text-xs font-semibold text-red-500 error">
                            <?= $errors['empty'] ?? $errors['name'] ?>
                        </p>
                    <?php endif ?>
                </div>
                <div>
                    <input name="email" type="email" autocomplete="email" class="bg-gray-100 w-full text-sm px-4 py-3.5 rounded-md outline-blue-600" placeholder="Email address" name="email" />
                    <?php if (isset($errors['email']) || isset($errors['empty'])) : ?>
                        <p class="text-xs font-semibold text-red-500 error">
                            <?= $errors['empty'] ?? $errors['email'] ?>
                        </p>
                    <?php endif ?>
                </div>
                <div>
                    <input name="password" type="password" autocomplete="current-password" class="bg-gray-100 w-full text-sm px-4 py-3.5 rounded-md outline-blue-600" placeholder="Password" name="password" />
                    <?php if (isset($errors['password']) || isset($errors['empty'])) : ?>
                        <p class="text-xs font-semibold text-red-500 error">
                            <?= $errors['empty'] ?? $errors['password'] ?>
                        </p>
                    <?php endif ?>
                </div>
                <div>
                    <input name="password_confirmation" type="password" autocomplete="current-password" class="bg-gray-100 w-full text-sm px-4 py-3.5 rounded-md outline-blue-600" placeholder="Confirm password" name="password_confirmation" />
                    <?php if (isset($errors['password_confirmation']) || isset($errors['empty'])) : ?>
                        <p class="text-xs font-semibold text-red-500 error">
                            <?= $errors['empty'] ?? $errors['password_confirmation'] ?>
                        </p>
                    <?php endif ?>
                </div>
                <div class="!mt-10">
                    <button type="submit" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-gray-700 hover:bg-gray-600 focus:outline-none">
                        Sign up
                    </button>
                </div>
                <p class="mt-10 text-sm">Already have an account <a href="/login" class="ml-1 font-semibold text-blue-600 hover:underline">Login here</a></p>
            </form>
        </div>
    </div>
</div>
<?php view('components/footer') ?>