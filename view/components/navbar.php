<nav class="w-full h-[100px] bg-zinc-900 fixed top-0 z-50">
    <div class="relative flex items-center justify-center h-10 text-white">
        <p class="z-10 px-2 text-center">✨Discover Your Dream Vacation</p>
        <img src="/assets/navbar-bg.jpg" alt="" class="absolute top-0 left-0 z-0 object-cover w-full h-full">
    </div>
    <div class="relative flex items-center justify-between w-full h-16 px-2 lg:px-10 ">
        <div class="relative px-4 text-lg font-bold text-white uppercase">Viesnica<span class="absolute top-0 right-0 w-3 h-3 bg-blue-500 rounded-full">
            </span>
        </div>
        <div class="hidden text-white lg:absolute left-[50%] top-[50%] -translate-x-1/2 -translate-y-1/2 lg:flex items-center justify-center gap-5">
            <a class="px-2 py-1.5 hover:bg-black hover:border border-gray-500 rounded-lg transition-all duration-300" href="/">Home</a>
            <a class="px-2 py-1.5 hover:bg-black hover:border border-gray-500 rounded-lg transition-all duration-300" href="/rooms">Rooms</a>
            <a class="px-2 py-1.5 hover:bg-black hover:border border-gray-500 rounded-lg transition-all duration-300" href="/about">About Us</a>
        </div>
        <div class="items-center justify-center hidden gap-5 text-sm lg:flex">
            <?php if (isset($_SESSION['user'])) : ?>
                <a href="/profile">
                    <img src="/assets/profile-icon.png" alt="profile icon" class="w-6 h-6 bg-white rounded-full">
                </a>
                <?php if ($_SESSION['user']['role'] == 'admin') : ?>
                    <a href="/dashboard">
                        <button class="px-3 py-1.5 text-white bg-black border border-gray-500 rounded-lg hover:opacity-75 transition-all duration-300">Dashboard</button>
                    </a>
                <?php endif ?>
            <?php else : ?>
                <a href="/register">
                    <button class="px-3 py-1.5 text-white bg-black border border-gray-500 rounded-lg hover:opacity-75 transition-all duration-300">Register</button>
                </a>
            <?php endif ?>
            <button class="px-3 py-1.5 text-white bg-black border border-gray-500 rounded-lg hover:opacity-75 transition-all duration-300">Contact
                us</button>
        </div>
    </div>
</nav>
