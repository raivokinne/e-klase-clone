<?php
view('components/head', ['title' => 'Subjects']);
echo '<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />';
view('components/side-nav');
?>

<div class="min-h-screen bg-gray-100 <?php echo (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['admin','teacher'])) ? 'ml-[250px]' : ''; ?> transition-all duration-300">
  <section class="grid place-items-center min-h-screen w-full transition-all duration-300">
    <div class="flex flex-row justify-center items-start gap-24 w-full max-w-6xl">

      <div class="bg-white rounded-xl shadow-lg p-6 w-80 min-h-[350px] flex flex-col items-center border border-gray-200">
        <h2 class="text-2xl font-bold text-indigo-700 mb-4 select-none">Subjects</h2>
        <div class="flex flex-col gap-3 w-full">
          <?php foreach ($subjects as $subject): ?>
            <div class="bg-indigo-50 border border-indigo-200 rounded-lg px-4 py-3 shadow-sm flex flex-col">
              <span class="font-semibold text-indigo-800"><?php echo htmlspecialchars($subject['name']); ?></span>
            </div>
          <?php endforeach; ?>
          <?php if (empty($subjects)): ?>
            <div class="text-gray-400 text-center select-none">No subjects found.</div>
          <?php endif; ?>
        </div>
      </div>


        <div class="flex flex-col items-center justify-center select-none">
          <h1 class="text-6xl sm:text-5xl font-extrabold text-center mb-2 font-libre_baskerville_regular">Curriculum</h1>
          <p class="text-gray-600 mb-4">Manage your curriculum and subjects.</p>

          <div>Choose the class:</div>
          <div>
            <button data-class="1a" class="class-btn px-3 py-1 text-sm font-semibold rounded-lg bg-indigo-500 text-white shadow transition-all duration-200 hover:bg-green-600 hover:scale-110 hover:shadow-lg focus:outline-none">
              1a
            </button>
            <button data-class="2b" class="class-btn px-3 py-1 text-sm font-semibold rounded-lg bg-indigo-500 text-white shadow transition-all duration-200 hover:bg-green-600 hover:scale-110 hover:shadow-lg focus:outline-none">
              2b
            </button>
            <button data-class="3c" class="class-btn px-3 py-1 text-sm font-semibold rounded-lg bg-indigo-500 text-white shadow transition-all duration-200 hover:bg-green-600 hover:scale-110 hover:shadow-lg focus:outline-none ">
              3c
            </button>
            <button data-class="4d" class="class-btn px-3 py-1 text-sm font-semibold rounded-lg bg-indigo-500 text-white shadow transition-all duration-200 hover:bg-green-600 hover:scale-110 hover:shadow-lg focus:outline-none">
              4d
            </button>
          </div>

          <button class="w-32 h-10 mt-48 bg-green-600 text-white font-semibold rounded-xl shadow-md hover:bg-green-700 hover:scale-105 hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
            <span class="material-symbols-outlined align-middle mr-1">save</span>
              Save
          </button>
        </div>




      <div class="bg-white rounded-xl shadow-lg p-6 w-80 min-h-[350px] flex flex-col items-center border border-gray-200">
        <h2 class="text-2xl font-bold text-indigo-700 mb-4 select-none">Teachers</h2>
        <div class="flex flex-col gap-3 w-full">
          <?php foreach ($teachers as $teacher): ?>
            <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-3 shadow-sm flex flex-col">
              <span class="font-semibold text-green-800"><?php echo htmlspecialchars($teacher['name']); ?></span>
            </div>
          <?php endforeach; ?>
          <?php if (empty($teachers)): ?>
            <div class="text-gray-400 text-center select-none">No teachers found.</div>
          <?php endif; ?>
        </div>
      </div>
    </div>


    <div class="w-full flex flex-col justify-center items-center transition-all duration-300">
      <div class="overflow-x-auto flex justify-center items-center" >
        <div class="w-full flex flex-col items-center ">

          <div id="date-arrows-bar" class=" flex items-center bg-white bg-opacity-90 px-4 py-2 rounded-lg shadow z-30 hover:shadow-lg transition-all duration-300">
            <span id="arrow-back" class="material-symbols-outlined cursor-pointer select-none text-3xl">arrow_back</span>
              <div>
                <h2 id="week-date" class="text-xl font-bold text-gray-800 mx-4"></h2>
              </div>
            <span id="arrow-forward" class="material-symbols-outlined cursor-pointer select-none text-3xl">arrow_forward</span>
          </div>

          <div id="table-container" class="w-full flex justify-center items-center mt-2">
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
      document.querySelectorAll('.class-btn').forEach(b => b.classList.remove('active', 'bg-green-500'));
      this.classList.add('active', 'bg-green-500');
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
      label: day.toLocaleDateString('en-US', { weekday: 'long' }),
      date: day.toLocaleDateString('en-CA'),
      pretty: day.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
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
          <td class="px-6 py-3 h-[50px] border-2 border-gray-400 hover:bg-gray-100 transition-all duration-300"></td>
          <td class="px-6 py-3 h-[50px] border-2 border-gray-400 hover:bg-gray-100 transition-all duration-300"></td>
          <td class="px-6 py-3 h-[50px] border-2 border-gray-400 hover:bg-gray-100 transition-all duration-300"></td>
          <td class="px-6 py-3 h-[50px] border-2 border-gray-400 hover:bg-gray-100 transition-all duration-300"></td>
        </tr>
      `;
    }
    return rows;
  }

  function renderTable(dayIdx, animate = true) {
    const tableHtml = `
      <table class="min-w-[900px] w-11/12 max-w-6xl bg-white border border-gray-300 rounded-lg shadow-md transition-all duration-400 opacity-0 mx-auto" id="day-table">
        <thead>
          <tr class="bg-black text-white">
            <th class="px-6 py-3 text-left border-2">Subject Name</th>
            <th class="px-6 py-3 text-left border-2">Teacher</th>
            <th class="px-6 py-3 text-left border-2">Description</th>
            <th class="px-6 py-3 text-left border-2">Actions</th>
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