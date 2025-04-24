<nav class="w-full h-[50px] bg-zinc-900 fixed top-0 z-50">
    <div class="relative flex items-center justify-between w-full h-16 px-2 lg:px-10 ">
        <div class="relative px-4 text-lg font-bold text-white uppercase">ClassNet<span class="absolute top-0 right-0 w-3 h-3 bg-blue-500 rounded-full">
            </span>
        </div>

        <div class="items-center justify-center hidden gap-5 text-sm lg:flex">

            <?php if ($_SESSION["user"]["role"] === "student") : ?>

            <div class="hidden text-white lg:absolute left-[45%] top-[50%] -translate-x-1/2 -translate-y-1/2 lg:flex items-center justify-center gap-5">
                <a class="px-2 py-1.5 hover:bg-black hover:border border-gray-500 rounded-lg transition-all duration-300" href="/home">Home</a>
            </div>

            <div class="hidden text-white lg:absolute left-[50%] top-[50%] -translate-x-1/2 -translate-y-1/2 lg:flex items-center justify-center gap-5">
                <a class="px-2 py-1.5 hover:bg-black hover:border border-gray-500 rounded-lg transition-all duration-300" href="/grades">Grades</a>
            </div>

                <a href="/profile">
                    <img src="/assets/profile-icon.png" alt="profile icon" class="w-6 h-6 bg-white rounded-full">
                </a>
                

            <?php  endif;?>
             <?php if ($_SESSION['user']["role"] === "teacher"): ?>

                    <div class="hidden text-white lg:absolute left-[45%] top-[50%] -translate-x-1/2 -translate-y-1/2 lg:flex items-center justify-center gap-5">
                <a class="px-2 py-1.5 hover:bg-black hover:border border-gray-500 rounded-lg transition-all duration-300" href="/home">Home</a>
            </div>

            <div class="hidden text-white lg:absolute left-[50%] top-[50%] -translate-x-1/2 -translate-y-1/2 lg:flex items-center justify-center gap-5">
                <a class="px-2 py-1.5 hover:bg-black hover:border border-gray-500 rounded-lg transition-all duration-300" href="/grades">Grades</a>
            </div>

                <a href="/profile">
                    <img src="/assets/profile-icon.png" alt="profile icon" class="w-6 h-6 bg-white rounded-full">
                </a>

            <?php endif; ?> 
            <?php if ($_SESSION['user']["role"] === "admin") : ?>

                <div classs="hidden text-white lg:absolute left-[45%] top-[50%] -translate-x-1/2 -translate-y-1/2 lg:flex items-center justify-center gap-5">
                    <a class="px-2 py-1.5 hover:bg-black hover:border border-gray-500 rounded-lg transition-all duration-300" href="/subjects">Subjects</a>
                </div>

                <div class="hidden text-white lg:absolute left-[50%] top-[50%] -translate-x-1/2 -translate-y-1/2 lg:flex items-center justify-center gap-5">
                    <a class="px-2 py-1.5 hover:bg-black hover:border border-gray-500 rounded-lg transition-all duration-300" href="/students">Students</a>
                </div>

            <?php  endif; ?> <?php if (!isset($_SESSION["user"])) : ?>
                <a href="/login">
                    <button class="px-3 py-1.5 text-white bg-black border border-gray-500 rounded-lg hover:opacity-75 transition-all duration-300">Login</button>
                </a>

            <?php endif; ?>
            
            <?php if (isset($_SESSION['user']["role"])) : ?>
                <a class="text-white"><?php echo ucfirst($_SESSION['user']["role"]); ?></a>
            <?php endif; ?>
        </div>
    </div>
</nav>
