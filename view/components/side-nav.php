<div id="sidebar" class="fixed left-0 z-40 h-screen bg-zinc-900 text-white pt-[20px] shadow-lg transition-all duration-300 w-[250px] select-none ">
    <div class="flex flex-col h-full relative">
        <div class="relative px-6 py-4 text-lg font-bold text-white uppercase border-b border-zinc-700">
            ClassNet
        </div>

        <button id="toggleSidebar" class="absolute -right-3 top-4 bg-zinc-900 rounded-full p-1 shadow-lg border border-zinc-700 hover:bg-zinc-800 transition-all">
            <svg id="collapseIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
            <svg id="expandIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
        </button>

        <div class="flex flex-col py-4 flex-grow">
            <?php if (isset($_SESSION["user"])): ?>
                <a href="/" class="flex items-center px-6 py-3 hover:bg-black hover:border-l-4 border-blue-500 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="sidebar-text">Home</span>
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION["user"]) && $_SESSION["user"]->role === "student"): ?>
                <a href="/grades" class="flex items-center px-6 py-3 hover:bg-black hover:border-l-4 border-blue-500 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="sidebar-text">Grades</span>
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION["user"]) && $_SESSION["user"]->role === "teacher"): ?>
                <a href="/my-subjects" class="flex items-center px-6 py-3 hover:bg-black hover:border-l-4 border-blue-500 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="sidebar-text">My Subjects</span>
                </a>
                <a href="/grades" class="flex items-center px-6 py-3 hover:bg-black hover:border-l-4 border-blue-500 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="sidebar-text">Grades</span>
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION["user"]) && $_SESSION["user"]->role === "admin"): ?>
                <a href="/subjects" class="flex items-center px-6 py-3 hover:bg-black hover:border-l-4 border-blue-500 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="sidebar-text">Subjects</span>
                </a>
                <a href="/management" class="flex items-center px-6 py-3 hover:bg-black hover:border-l-4 border-blue-500 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="sidebar-text">Management</span>
                </a>
            <?php endif; ?>
        </div>

        <div class="mt-auto border-t border-zinc-700">
            <?php if (! isset($_SESSION["user"])): ?>
                <a href="/login" class="flex items-center px-6 py-4 hover:bg-blue-900 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span class="sidebar-text">Login</span>
                </a>
            <?php else: ?>
                <a href="/profile/<?php echo $_SESSION["user"]->id ?>/edit" class="flex items-center px-6 py-4 hover:bg-zinc-800 transition-all duration-300">
                    <div class="w-6 h-6 bg-white rounded-full mr-3 flex-shrink-0 sidebar-icon">
                        <img src="/assets/profile-icon.png" alt="profile" class="w-6 h-6 rounded-full">
                    </div>
                    <span class="sidebar-text">Profile (<?php echo ucfirst($_SESSION["user"]->role); ?>)</span>
                </a>

                <a href="/logout" class="flex items-center px-6 py-4 hover:bg-red-900 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="sidebar-text">Logout</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const collapseIcon = document.getElementById('collapseIcon');
        const expandIcon = document.getElementById('expandIcon');
        const mainContent = document.querySelector('.min-h-screen');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');

        function toggleSidebar() {
            if (sidebar.classList.contains('w-[250px]')) {
                sidebar.classList.remove('w-[250px]');
                sidebar.classList.add('w-[70px]');

                sidebarTexts.forEach(text => {
                    text.classList.add('hidden');
                });

                collapseIcon.classList.add('hidden');
                expandIcon.classList.remove('hidden');
            } else {
                sidebar.classList.remove('w-[70px]');
                sidebar.classList.add('w-[250px]');

                sidebarTexts.forEach(text => {
                    text.classList.remove('hidden');
                });

                collapseIcon.classList.remove('hidden');
                expandIcon.classList.add('hidden');
            }
        }

        toggleBtn.addEventListener('click', toggleSidebar);
    });
</script>
