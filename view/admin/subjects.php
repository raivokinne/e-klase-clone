<?php
    view('components/head', ['title' => 'Subjects']);
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">';
    view('components/side-nav');
?>

<div class="min-h-screen bg-gray-50 transition-all duration-300 select-none">
    <section class="fixed inset-0 pt-12 pb-6 overflow-hidden">
        <div class="max-w-7xl h-full mx-auto px-2 sm:px-4 flex flex-col">
            <!-- Class Selection Section -->
            <div class="mb-4 flex flex-col items-center">
                <h2 class="text-xl font-bold mb-3 text-gray-800">Select Class</h2>
                <div class="w-full max-w-2xl bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-1 p-2">
                        <?php foreach ($classes as $class): ?>
                            <button data-class="<?php echo htmlspecialchars($class->name); ?>"
                                    class="class-btn flex items-center justify-center px-2 py-2 rounded-md transition-all duration-200 text-sm font-medium text-gray-700 hover:shadow-md relative group bg-white hover:bg-gray-900 hover:text-white border border-gray-200">
                                <span class="relative"><?php echo htmlspecialchars($class->name); ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <?php if (empty($classes)): ?>
                        <div class="text-gray-400 text-center italic p-2">No classes found.</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-3 flex-1 min-h-0">
                <!-- Subjects Panel -->
                <div class="lg:col-span-3 bg-white rounded-lg shadow-md border border-gray-200 flex flex-col h-[calc(100vh-16rem)]">
                    <h2 class="text-lg font-bold text-gray-900 p-2 pb-1 flex items-center border-b border-gray-200">
                        <i class="fas fa-book mr-2 text-gray-600"></i>
                        Subjects
                    </h2>
                    <div class="flex-1 overflow-y-auto px-2 pb-2">
                        <div class="flex flex-col gap-1.5 w-full subjects-container">
                            <?php foreach ($subjects as $subject): ?>
                                <div class="bg-white border border-gray-200 rounded-md px-3 py-2 shadow-sm cursor-move draggable-subject transition-all duration-200 hover:shadow-md hover:bg-gray-50"
                                     draggable="true"
                                     data-type="subject"
                                     data-id="<?php echo htmlspecialchars($subject->id); ?>">
                                    <span class="font-medium text-gray-800 text-sm"><?php echo htmlspecialchars($subject->name); ?></span>
                                </div>
                            <?php endforeach; ?>
<?php if (empty($subjects)): ?>
                            <div class="text-gray-400 text-center italic text-sm">No subjects found.</div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Schedule Section -->
                <div class="lg:col-span-6 flex flex-col">
                    <div class="flex items-center justify-center mb-3 bg-white px-4 py-2 rounded-lg shadow-md border border-gray-200">
                        <button id="arrow-back" class="p-1 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="fas fa-chevron-left text-xl text-gray-600"></i>
                        </button>
                        <h2 id="week-date" class="text-lg font-bold text-gray-800 mx-4"></h2>
                        <button id="arrow-forward" class="p-1 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="fas fa-chevron-right text-xl text-gray-600"></i>
                        </button>
                    </div>

                    <div class="flex-1 overflow-y-auto">
                        <div id="table-container" class="w-full">
                        </div>

                        <div class="flex justify-center mt-4 pb-4">
                            <button id="save-schedule" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-md shadow-md hover:bg-black hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2">
                                <i class="fas fa-save mr-2"></i>
                                Save Schedule
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Teachers Panel -->
                <div class="lg:col-span-3 bg-white rounded-lg shadow-md border border-gray-200 flex flex-col h-[calc(100vh-16rem)]">
                    <h2 class="text-lg font-bold text-gray-900 p-2 pb-1 flex items-center border-b border-gray-200">
                        <i class="fas fa-chalkboard-teacher mr-2 text-gray-600"></i>
                        Teachers
                    </h2>
                    <div class="flex-1 overflow-y-auto px-2 pb-2">
                        <div class="flex flex-col gap-1.5 w-full teachers-container">
                            <?php foreach ($teachers as $teacher): ?>
                                <div class="bg-white border border-gray-200 rounded-md px-3 py-2 shadow-sm cursor-move draggable-teacher transition-all duration-200 hover:shadow-md hover:bg-gray-50"
                                     draggable="true"
                                     data-type="teacher"
                                     data-id="<?php echo htmlspecialchars($teacher->id); ?>">
                                    <span class="font-medium text-gray-800 text-sm"><?php echo htmlspecialchars($teacher->first_name . ' ' . $teacher->last_name); ?></span>
                                </div>
                            <?php endforeach; ?>
<?php if (empty($teachers)): ?>
                            <div class="text-gray-400 text-center italic text-sm">No teachers found.</div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php view('components/footer')?>

<script>
    // Class button selection
    let selectedClass = null;
    document.querySelectorAll('.class-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.class-btn').forEach(b => {
                b.classList.remove('active', 'from-blue-600', 'to-blue-800', 'text-white', 'border-blue-700', 'shadow-lg');
                b.classList.add('from-gray-50', 'to-gray-100', 'text-gray-700', 'border-gray-200');
            });
            this.classList.remove('from-gray-50', 'to-gray-100', 'text-gray-700', 'border-gray-200');
            this.classList.add('active', 'from-blue-600', 'to-blue-800', 'text-white', 'border-blue-700', 'shadow-lg');
            selectedClass = this.dataset.class;

            // When a class is selected, show the table and enable saving
            renderTable(currentDayIdx, true);
            document.getElementById('save-schedule').style.display = 'block';

            // Enable week navigation
            document.getElementById('week-date').parentElement.style.opacity = '1';
            document.getElementById('arrow-back').style.pointerEvents = 'auto';
            document.getElementById('arrow-forward').style.pointerEvents = 'auto';

            // Show notification about the selected class
            showNotification(`Class ${selectedClass} selected`);
        });
    });

    // Week navigation
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

    // Schedule data storage
    const scheduleData = {};

    // Initialize schedule data structure for all classes and days
    weekDays.forEach(day => {
        <?php foreach ($classes as $class): ?>
            if (!scheduleData['<?php echo htmlspecialchars($class->name); ?>']) {
                scheduleData['<?php echo htmlspecialchars($class->name); ?>'] = {};
            }
            if (!scheduleData['<?php echo htmlspecialchars($class->name); ?>'][day.date]) {
                scheduleData['<?php echo htmlspecialchars($class->name); ?>'][day.date] = Array(8).fill().map(() => ({
                    subject: null,
                    teacher: null,
                    room: '',
                    location: '' // 'P' for Priekuļi, 'C' for Cēsis
                }));
            }
        <?php endforeach; ?>
    });

    function getTableRows(dayIdx) {
        const dayData = scheduleData[selectedClass || '<?php echo htmlspecialchars($classes[0]->name); ?>'][weekDays[dayIdx].date] || Array(8).fill().map(() => ({
            subject: null,
            teacher: null,
            room: '',
            location: ''
        }));

        let rows = '';
        for (let i = 0; i < 8; i++) {
            const rowData = dayData[i] || { subject: null, teacher: null, room: '', location: '' };
            const subjectData = rowData.subject ?
                `data-id="${rowData.subject.id}" data-content="${rowData.subject.name}"` : '';
            const teacherData = rowData.teacher ?
                `data-id="${rowData.teacher.id}" data-content="${rowData.teacher.name}"` : '';

            const locationPClass = rowData.location === 'P' ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-700';
            const locationCClass = rowData.location === 'C' ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-700';

            rows += `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-3 py-2 h-[40px] border border-gray-300 bg-gray-50 font-medium text-gray-700 text-sm">${i+1}</td>
                    <td class="px-3 py-2 h-[40px] border border-gray-300 subject-cell"
                        data-period="${i}" data-day="${weekDays[dayIdx].date}" data-type="subject" ${subjectData}>
                        ${rowData.subject ?
                            `<div class="bg-white border border-gray-200 rounded-md px-3 py-2 text-gray-800 text-sm shadow-sm">
                                ${rowData.subject.name}
                            </div>` :
                            '<div class="h-full w-full min-h-[32px] rounded-md border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400 text-sm hover:border-gray-400 hover:text-gray-500 transition-colors">Drop subject here</div>'}
                    </td>
                    <td class="px-3 py-2 h-[40px] border border-gray-300 teacher-cell"
                        data-period="${i}" data-day="${weekDays[dayIdx].date}" data-type="teacher" ${teacherData}>
                        ${rowData.teacher ?
                            `<div class="bg-white border border-gray-200 rounded-md px-3 py-2 text-gray-800 text-sm shadow-sm">
                                ${rowData.teacher.name}
                            </div>` :
                            '<div class="h-full w-full min-h-[32px] rounded-md border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400 text-sm hover:border-gray-400 hover:text-gray-500 transition-colors">Drop teacher here</div>'}
                    </td>
                    <td class="px-3 py-2 h-[40px] border border-gray-300 room-cell">
                        <div class="flex items-center">
                            <input type="text" class="w-16 border border-gray-300 rounded-l px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 room-input select-none"
                                data-period="${i}" data-day="${weekDays[dayIdx].date}" placeholder="Room"
                                value="${rowData.room || ''}">
                            <button class="location-btn px-2 py-1 rounded-none ${locationPClass} border border-gray-300 hover:opacity-90 font-medium text-sm focus:outline-none focus:ring-1 focus:ring-gray-400"
                                data-period="${i}" data-day="${weekDays[dayIdx].date}" data-location="P">
                                P
                            </button>
                            <button class="location-btn px-2 py-1 rounded-r ${locationCClass} border border-gray-300 hover:opacity-90 font-medium text-sm focus:outline-none focus:ring-1 focus:ring-gray-400"
                                data-period="${i}" data-day="${weekDays[dayIdx].date}" data-location="C">
                                C
                            </button>
                        </div>
                    </td>
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
                        <th class="px-3 py-2 text-left border-r border-gray-600 text-sm">#</th>
                        <th class="px-3 py-2 text-left border-r border-gray-600 text-sm">Subject</th>
                        <th class="px-3 py-2 text-left border-r border-gray-600 text-sm">Teacher</th>
                        <th class="px-3 py-2 text-left text-sm">Room</th>
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

        setupDragDropForTable();
        hideErrorMessage();
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

    function hideErrorMessage() {
        const errorContainer = document.getElementById('error-container');
        errorContainer.classList.add('hidden');
    }

    function validateSchedule(dayData) {
        const incompleteHours = [];
        const missingRooms = [];
        const missingLocations = [];

        dayData.forEach((hour, index) => {
            const hourNumber = index + 1;

            // If either subject or teacher is set, both must be set
            if ((hour.subject && !hour.teacher) || (!hour.subject && hour.teacher)) {
                incompleteHours.push(hourNumber);
            }

            // If both subject and teacher are set, room and location must also be set
            if (hour.subject && hour.teacher) {
                if (!hour.room || hour.room.length !== 3) {
                    missingRooms.push(hourNumber);
                }
                if (!hour.location) {
                    missingLocations.push(hourNumber);
                }
            }
        });

        if (incompleteHours.length > 0) {
            showNotification(`Hour${incompleteHours.length > 1 ? 's' : ''} ${incompleteHours.join(', ')} ${incompleteHours.length > 1 ? 'are' : 'is'} incomplete. Please add both subject and teacher.`, 'error');
            return false;
        }

        if (missingRooms.length > 0) {
            showNotification(`Please set valid room number for hour${missingRooms.length > 1 ? 's' : ''} ${missingRooms.join(', ')}.`, 'error');
            return false;
        }

        if (missingLocations.length > 0) {
            showNotification(`Please set location (P/C) for hour${missingLocations.length > 1 ? 's' : ''} ${missingLocations.join(', ')}.`, 'error');
            return false;
        }

        return true;
    }

    // Set up drag-and-drop functionality
    function setupDragDrop() {
        // For subjects and teachers
        const draggables = document.querySelectorAll('.draggable-subject, .draggable-teacher');
        const dropZones = document.querySelectorAll('.subject-cell, .teacher-cell');

        let draggedElement = null;

        draggables.forEach(draggable => {
            // Create a clone for dragging
            draggable.addEventListener('dragstart', (e) => {
                draggedElement = draggable;
                draggable.classList.add('opacity-50', 'scale-105');

                // Create a custom drag image
                const dragImage = draggable.cloneNode(true);
                dragImage.style.position = 'absolute';
                dragImage.style.top = '-1000px';
                dragImage.style.opacity = '0.8';
                document.body.appendChild(dragImage);
                e.dataTransfer.setDragImage(dragImage, 10, 10);

                // Clean up after drag starts
                setTimeout(() => {
                    document.body.removeChild(dragImage);
                }, 0);

                e.dataTransfer.setData('text/plain', JSON.stringify({
                    id: draggable.dataset.id,
                    type: draggable.dataset.type,
                    content: draggable.textContent.trim()
                }));
            });

            draggable.addEventListener('dragend', () => {
                draggable.classList.remove('opacity-50', 'scale-105');
            });
        });

        // Handle drop zones
        dropZones.forEach(dropZone => {
            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                // Only allow dropping if the type matches
                const dragType = draggedElement?.dataset.type;
                const dropType = dropZone.dataset.type;

                if (dragType === dropType) {
                    dropZone.classList.add('bg-gray-100', 'border-2', 'border-blue-500');
                }
            });

            dropZone.addEventListener('dragleave', () => {
                dropZone.classList.remove('bg-gray-100', 'border-2', 'border-blue-500');
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('bg-gray-100', 'border-2', 'border-blue-500');

                const data = JSON.parse(e.dataTransfer.getData('text/plain'));

                // Only allow dropping if the type matches
                if (data.type !== dropZone.dataset.type) {
                    return;
                }

                // Update the visual representation
                const bgColor = data.type === 'subject' ? 'bg-blue-100' : 'bg-green-100';
                const borderColor = data.type === 'subject' ? 'border-blue-300' : 'border-green-300';
                const textColor = data.type === 'subject' ? 'text-blue-800' : 'text-green-800';

                dropZone.innerHTML = `
                    <div class="${bgColor} border ${borderColor} rounded-lg px-3 py-2 ${textColor} shadow-sm animate-fadeIn">
                        ${data.content}
                    </div>
                `;

                // Store the data for saving
                const day = dropZone.dataset.day;
                const period = parseInt(dropZone.dataset.period);
                const classId = selectedClass || '<?php echo htmlspecialchars($classes[0]->name); ?>';

                if (!scheduleData[classId][day]) {
                    scheduleData[classId][day] = Array(8).fill().map(() => ({
                        subject: null,
                        teacher: null,
                        room: '',
                        location: ''
                    }));
                }

                // Update the schedule data
                if (data.type === 'subject') {
                    scheduleData[classId][day][period].subject = {
                        id: data.id,
                        name: data.content
                    };
                } else {
                    scheduleData[classId][day][period].teacher = {
                        id: data.id,
                        name: data.content
                    };
                }

                // Add attributes for data tracking
                dropZone.setAttribute('data-id', data.id);
                dropZone.setAttribute('data-content', data.content);

                // Add bouncing animation
                const newElement = dropZone.querySelector('div');
                newElement.classList.add('animate-bounce');
                setTimeout(() => {
                    newElement.classList.remove('animate-bounce');
                }, 500);

                // Hide error message if it was shown
                hideErrorMessage();
            });
        });
    }

    function setupDragDropForTable() {
        // Track room input changes
        document.querySelectorAll('.room-input').forEach(input => {
            input.addEventListener('input', (e) => {
                // Only allow numbers
                e.target.value = e.target.value.replace(/[^0-9]/g, '');

                // Limit to 3 digits
                if (e.target.value.length > 3) {
                    e.target.value = e.target.value.slice(0, 3);
                }
            });

            input.addEventListener('change', (e) => {
                const day = e.target.dataset.day;
                const period = parseInt(e.target.dataset.period);
                const classId = selectedClass || '<?php echo htmlspecialchars($classes[0]->name); ?>';

                // Validate room number
                if (e.target.value.length !== 3) {
                    showNotification('Room number must be exactly 3 digits', 'error');
                    e.target.value = '';
                    return;
                }

                if (!scheduleData[classId][day]) {
                    scheduleData[classId][day] = Array(8).fill().map(() => ({
                        subject: null,
                        teacher: null,
                        room: '',
                        location: ''
                    }));
                }

                scheduleData[classId][day][period].room = e.target.value;
            });
        });

        // Location buttons (P and C)
        document.querySelectorAll('.location-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const day = e.target.dataset.day;
                const period = parseInt(e.target.dataset.period);
                const location = e.target.dataset.location;
                const classId = selectedClass || '<?php echo htmlspecialchars($classes[0]->name); ?>';
                const rowData = scheduleData[classId]?.[day]?.[period];

                // Validate if subject and teacher are set before allowing location
                if (!rowData?.subject || !rowData?.teacher || !rowData?.room) {
                    showNotification('Please set subject, teacher and room number first', 'error');
                    return;
                }

                if (!scheduleData[classId][day]) {
                    scheduleData[classId][day] = Array(8).fill().map(() => ({
                        subject: null,
                        teacher: null,
                        room: '',
                        location: ''
                    }));
                }

                // Toggle location if already selected
                if (scheduleData[classId][day][period].location === location) {
                    scheduleData[classId][day][period].location = '';
                    e.target.classList.remove(location === 'P' ? 'bg-purple-600' : 'bg-blue-600');
                    e.target.classList.remove('text-white');
                    e.target.classList.add('bg-gray-200', 'text-gray-700');
                } else {
                    // Update location buttons styling in this row
                    const locationBtns = document.querySelectorAll(`.location-btn[data-period="${period}"][data-day="${day}"]`);
                    locationBtns.forEach(button => {
                        button.classList.remove('bg-purple-600', 'bg-blue-600', 'text-white');
                        button.classList.add('bg-gray-200', 'text-gray-700');
                    });

                    // Apply new styling
                    e.target.classList.remove('bg-gray-200', 'text-gray-700');
                    e.target.classList.add(location === 'P' ? 'bg-purple-600' : 'bg-blue-600', 'text-white');

                    // Save location
                    scheduleData[classId][day][period].location = location;
                }
            });
        });

        // Set up drag and drop for the current table
        setupDragDrop();
    }

    // Notification system
    function showNotification(message, type = 'info') {
        // Remove any existing notification
        const existingNotification = document.getElementById('notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        // Create notification element
        const notification = document.createElement('div');
        notification.id = 'notification';
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 animate-slideIn ${
            type === 'info' ? 'bg-blue-500 text-white' :
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' : 'bg-gray-800 text-white'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <span class="material-symbols-outlined mr-2">${
                    type === 'info' ? 'info' :
                    type === 'success' ? 'check_circle' :
                    type === 'error' ? 'error' : 'notifications'
                }</span>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(notification);

        // Auto-remove after 3 seconds
        setTimeout(() => {
            notification.classList.add('animate-slideOut');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Save schedule data
    document.getElementById('save-schedule').addEventListener('click', async function() {
        if (!selectedClass) {
            showNotification('Please select a class first!', 'error');
            document.querySelectorAll('.class-btn').forEach(btn => {
                btn.classList.add('animate-pulse');
                setTimeout(() => btn.classList.remove('animate-pulse'), 1000);
            });
            return;
        }

        const currentDay = weekDays[currentDayIdx].date;
        const dayData = scheduleData[selectedClass][currentDay];

        if (!validateSchedule(dayData)) {
            return;
        }

        const dataToSave = {
            stundu_saraksts: [{
                name: selectedClass,
                dienas: [{
                    name: weekDays[currentDayIdx].label.toLowerCase(),
                    subjects: dayData.map((period, index) => {
                        if (!period.subject || !period.teacher) return null;

                        return {
                            id: index + 1,
                            teachers: period.teacher.name,
                            subject: period.subject.name,
                            kabinets: period.room + period.location
                        };
                    }).filter(item => item !== null)
                }]
            }]
        };

        const saveBtn = this;
        const originalText = saveBtn.innerHTML;

        saveBtn.innerHTML = `
            <span class="material-symbols-outlined animate-spin align-middle mr-2">sync</span>
            Saving...
        `;
        saveBtn.disabled = true;

        try {
            const response = await fetch('/subjects', {
                method: 'POST',
                // headers: {
                //     'Content-Type': 'application/json'
                // },
                body: JSON.stringify(dataToSave)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.error || 'Failed to save schedule');
            }

            saveBtn.innerHTML = `
                <span class="material-symbols-outlined align-middle mr-2">check_circle</span>
                Saved!
            `;

            showNotification(`Class ${selectedClass} schedule for ${weekDays[currentDayIdx].label} saved successfully!`, 'success');

        } catch (error) {
            console.error('Error saving schedule:', error);
            showNotification(error.message || 'Failed to save schedule. Please try again.', 'error');
            saveBtn.innerHTML = originalText;
        } finally {
            setTimeout(() => {
                saveBtn.innerHTML = originalText;
                saveBtn.disabled = false;
            }, 1500);
        }
    });

    // Initialize
    updateDateDisplay(currentDayIdx);
    updateArrows();
</script>

<style>
/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideOut {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.animate-fadeIn {
    animation: fadeIn 0.3s ease-in-out;
}

.animate-bounce {
    animation: bounce 0.5s ease-in-out;
}

.animate-spin {
    animation: spin 1s linear infinite;
}

.animate-slideIn {
    animation: slideIn 0.3s ease-in-out forwards;
}

.animate-slideOut {
    animation: slideOut 0.3s ease-in-out forwards;
}

.animate-pulse {
    animation: pulse 0.7s ease-in-out infinite;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Mobile Responsiveness */
@media (max-width: 1024px) {
    .grid-cols-1 {
        gap: 1rem;
    }

    .h-[calc(100vh-16rem)] {
        height: auto;
        max-height: 250px;
    }
}

/* Hover Effects */
.hover-scale {
    transition: transform 0.2s ease-in-out;
}

.hover-scale:hover {
    transform: scale(1.02);
}

/* Shadow Effects */
.shadow-hover {
    transition: box-shadow 0.2s ease-in-out;
}

.shadow-hover:hover {
    box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.06);
}
</style>