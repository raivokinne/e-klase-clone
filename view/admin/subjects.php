<?php
view('components/head', ['title' => 'Subjects']);
echo '<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />';
view('components/side-nav');
?>

<div class="min-h-screen bg-gray-50 transition-all duration-300">
    <section class="grid place-items-center min-h-screen w-full py-12">
        <div class="max-w-7xl w-full px-4">
            <div class="mb-12 text-center">
                <h1 class="text-5xl font-bold mb-3 text-gray-900 font-libre_baskerville_regular">Curriculum Management</h1>
                <p class="text-gray-600 text-lg">Organize your subjects, teachers, and class schedules</p>
            </div>

            <div class="mb-10 flex flex-col items-center">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Select Class</h2>
                <div class="flex gap-3">
                    <button data-class="1a" class="class-btn px-5 py-2 font-medium rounded-md bg-gray-800 text-white shadow transition-all duration-200 hover:bg-black hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500">1a</button>
                    <button data-class="2b" class="class-btn px-5 py-2 font-medium rounded-md bg-gray-800 text-white shadow transition-all duration-200 hover:bg-black hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500">2b</button>
                    <button data-class="3c" class="class-btn px-5 py-2 font-medium rounded-md bg-gray-800 text-white shadow transition-all duration-200 hover:bg-black hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500">3c</button>
                    <button data-class="4d" class="class-btn px-5 py-2 font-medium rounded-md bg-gray-800 text-white shadow transition-all duration-200 hover:bg-black hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500">4d</button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-10">
                <div class="lg:col-span-3 bg-white rounded-xl shadow-md p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="material-symbols-outlined mr-2">menu_book</span>
                        Subjects
                    </h2>
                    <div class="flex flex-col gap-3 w-full">
                        <?php foreach ($subjects as $subject): ?>
                            <div class="bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 shadow-sm">
                                <span class="font-medium text-gray-800"><?php echo htmlspecialchars($subject['name']); ?></span>
                            </div>
                        <?php endforeach; ?>
                        <?php if (empty($subjects)): ?>
                            <div class="text-gray-400 text-center italic">No subjects found.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="lg:col-span-6">
                    <div class="flex items-center justify-center mb-5 bg-white px-6 py-3 rounded-lg shadow-md">
                        <span id="arrow-back" class="material-symbols-outlined cursor-pointer text-3xl text-gray-800 hover:text-black">arrow_back</span>
                        <h2 id="week-date" class="text-xl font-bold text-gray-800 mx-6"></h2>
                        <span id="arrow-forward" class="material-symbols-outlined cursor-pointer text-3xl text-gray-800 hover:text-black">arrow_forward</span>
                    </div>

                    <div id="table-container" class="w-full">
                    </div>

                    <div class="flex justify-center mt-8">
                        <button class="px-6 py-3 bg-gray-900 text-white font-medium rounded-lg shadow-md hover:bg-black hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-700">
                            <span class="material-symbols-outlined align-middle mr-2">save</span>
                            Save Schedule
                        </button>
                    </div>
                </div>

                <div class="lg:col-span-3 bg-white rounded-xl shadow-md p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="material-symbols-outlined mr-2">person</span>
                        Teachers
                    </h2>
                    <div class="flex flex-col gap-3 w-full">
                        <?php foreach ($teachers as $teacher): ?>
                            <div class="bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 shadow-sm">
                                <span class="font-medium text-gray-800"><?php echo htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']); ?></span>
                            </div>
                        <?php endforeach; ?>
                        <?php if (empty($teachers)): ?>
                            <div class="text-gray-400 text-center italic">No teachers found.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php view('components/footer') ?>

<script>
    document.querySelectorAll('.class-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.class-btn').forEach(b => {
                b.classList.remove('active', 'bg-black');
                b.classList.add('bg-gray-800');
            });
            this.classList.remove('bg-gray-800');
            this.classList.add('active', 'bg-black');
        });
    });

    function getMonday(d) {
        d = new Date(d);
        var day = d.getDay(),
            diff = d.getDate() - day + (day === 0 ? -6 : 1);
        return new Date(d.setDate(diff));
    }

    const today = new Date();
    const monday = getMonday(today);
    const weekDays = [];
    for (let i = 0; i < 5; i++) {
        const day = new Date(monday);
        day.setDate(monday.getDate() + i);
        weekDays.push({
            label: day.toLocaleDateString('en-US', {
                weekday: 'long'
            }),
            date: day.toLocaleDateString('en-CA'),
            pretty: day.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            })
        });
    }

    let currentDayIdx = weekDays.findIndex(d => {
        const now = new Date();
        return d.date === now.toLocaleDateString('en-CA');
    });
    if (currentDayIdx === -1) currentDayIdx = 0;

    function getTableRows(dayIdx) {
        let rows = '';
        for (let i = 1; i <= 8; i++) {
            rows += `
        <tr>
          <td class="px-4 py-3 h-[50px] border border-gray-300 hover:bg-gray-50 transition-all">${i}</td>
          <td class="px-4 py-3 h-[50px] border border-gray-300 hover:bg-gray-50 transition-all"></td>
          <td class="px-4 py-3 h-[50px] border border-gray-300 hover:bg-gray-50 transition-all"></td>
          <td class="px-4 py-3 h-[50px] border border-gray-300 hover:bg-gray-50 transition-all"></td>
        </tr>
      `;
        }
        return rows;
    }

    function renderTable(dayIdx, animate = true) {
        const tableHtml = `
      <table class="w-full bg-white border border-gray-300 rounded-lg shadow-md transition-all duration-300 opacity-0" id="day-table">
        <thead>
          <tr class="bg-gray-900 text-white">
            <th class="px-4 py-3 text-left border-r border-gray-600">#</th>
            <th class="px-4 py-3 text-left border-r border-gray-600">Subject</th>
            <th class="px-4 py-3 text-left border-r border-gray-600">Teacher</th>
            <th class="px-4 py-3 text-left">Notes</th>
          </tr>
        </thead>
        <tbody>
          ${getTableRows(dayIdx)}
        </tbody>
      </table>
    `;
        const container = document.getElementById('table-container');
        container.innerHTML = tableHtml;
        setTimeout(() => {
            document.getElementById('day-table').style.opacity = 1;
        }, animate ? 50 : 0);
    }

    function updateDateDisplay(dayIdx) {
        document.getElementById('week-date').textContent =
            weekDays[dayIdx].label + ' - ' + weekDays[dayIdx].pretty;
    }

    function updateArrows() {
        document.getElementById('arrow-back').style.opacity = currentDayIdx === 0 ? 0.3 : 1;
        document.getElementById('arrow-forward').style.opacity = currentDayIdx === weekDays.length - 1 ? 0.3 : 1;
    }

    function goToDay(idx) {
        if (idx < 0 || idx >= weekDays.length) return;
        currentDayIdx = idx;
        updateDateDisplay(currentDayIdx);
        renderTable(currentDayIdx);
        updateArrows();
    }

    document.getElementById('arrow-back').addEventListener('click', function() {
        if (currentDayIdx > 0) goToDay(currentDayIdx - 1);
    });
    document.getElementById('arrow-forward').addEventListener('click', function() {
        if (currentDayIdx < weekDays.length - 1) goToDay(currentDayIdx + 1);
    });

    updateDateDisplay(currentDayIdx);
    renderTable(currentDayIdx, false);
    updateArrows();
</script>