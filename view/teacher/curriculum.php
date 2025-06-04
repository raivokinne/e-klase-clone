<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Curriculum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .clickable-cell {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .clickable-cell:hover {
            background-color: #dbeafe !important;
            transform: scale(1.02);
        }
        .modal {
            backdrop-filter: blur(4px);
        }
        .grade-input {
            transition: border-color 0.2s ease;
        }
        .grade-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php require_once __DIR__ . '/../components/side-nav.php'; ?>

    <div class="min-h-screen bg-gray-100 pl-[250px] transition-all duration-300">
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-black">My Curriculum</h1>
                    <p class="text-gray-600 mt-2">Subject:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php echo htmlspecialchars($subject->name) ?> | Teacher:<?php echo htmlspecialchars($teacher->teacher_name) ?></p>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <?php foreach ($days as $day): ?>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-black mb-4"><?php echo $day ?></h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 my-4">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8">Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8">Class</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Subject</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8">Room</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($timeSlots as $time): ?>
                                    <tr class="group hover:bg-gray-50 transition-all duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50"><?php echo $time ?></td>
                                        <?php if (! empty($schedule[$day][$time])): ?>
<?php $lesson = $schedule[$day][$time][0]; ?>
                                            <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('<?php echo htmlspecialchars($lesson['class']) ?>', '<?php echo htmlspecialchars($lesson['subject']) ?>', '<?php echo $time ?>', '<?php echo $day ?>')"><?php echo htmlspecialchars($lesson['class']) ?></td>
                                            <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('<?php echo htmlspecialchars($lesson['class']) ?>', '<?php echo htmlspecialchars($lesson['subject']) ?>', '<?php echo $time ?>', '<?php echo $day ?>')"><?php echo htmlspecialchars($lesson['subject']) ?></td>
                                            <td class="px-6 py-4 text-sm text-gray-900"><?php echo htmlspecialchars($lesson['room']) ?></td>
                                        <?php else: ?>
                                            <td class="px-6 py-4 text-sm text-gray-500" colspan="3"></td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>

    <!-- Student Modal -->
    <div id="studentModal" class="fixed inset-0 bg-black bg-opacity-50 modal hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <div class="flex justify-between items-center p-6 border-b">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Students in Class</h3>
                        <p class="text-sm text-gray-600 mt-1" id="modalSubtitle">Subject: Mathematics | Time: 08:30 - 09:10</p>
                    </div>
                    <button onclick="closeStudentModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto max-h-[70vh]">
                    <div class="mb-4">
                        <button onclick="showAddGradeForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors">
                            Add New Grade
                        </button>
                    </div>

                    <!-- Add Grade Form (Initially Hidden) -->
                    <div id="addGradeForm" class="hidden mb-6 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-lg font-medium mb-4">Add Grade</h4>
                        <form onsubmit="addGrade(event)">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Student</label>
                                    <select id="gradeStudentSelect" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Select Student</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Grade</label>
                                    <input type="number" id="gradeInput" step="0.1" min="1" max="10" class="w-full border border-gray-300 rounded-md px-3 py-2 grade-input focus:outline-none" placeholder="Enter grade (1-10)">
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition-colors mr-2">
                                        Add Grade
                                    </button>
                                    <button type="button" onclick="hideAddGradeForm()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition-colors">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Students Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Grades</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Average</th>
                                </tr>
                            </thead>
                            <tbody id="studentsTableBody" class="bg-white divide-y divide-gray-200">
                                <!-- Student rows will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentClass = '';
        let currentSubject = '';
        let currentTime = '';
        let currentDay = '';
        let currentStudents = [];

        async function openStudentModal(className, subject, time, day) {
            currentClass = className;
            currentSubject = subject;
            currentTime = time;
            currentDay = day;

            document.getElementById('modalTitle').textContent = `Students in Class ${className}`;
            document.getElementById('modalSubtitle').textContent = `Subject: ${subject} | Time: ${time} | Day: ${day}`;

            try {
                const response = await fetch(`<?php echo $_SERVER['REQUEST_URI'] ?>?action=get_students&class=${encodeURIComponent(className)}&subject=${encodeURIComponent(subject)}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch students');
                }
                const students = await response.json();
                currentStudents = students;
                populateStudentsTable(students);
                populateStudentSelect(students);
                document.getElementById('studentModal').classList.remove('hidden');
            } catch (error) {
                console.error('Error:', error);
                showNotification('Error loading students: ' + error.message, 'error');
            }
        }

        function closeStudentModal() {
            document.getElementById('studentModal').classList.add('hidden');
            hideAddGradeForm();
        }

        function populateStudentsTable(students) {
            const tbody = document.getElementById('studentsTableBody');
            tbody.innerHTML = '';

            students.forEach(student => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors';

                // Find grades for current subject
                const subjectGrades = student.grades.find(g => g.subject === currentSubject) || { grades: [], average: 0 };
                const gradesText = subjectGrades.grades.length > 0 ? subjectGrades.grades.join(', ') : 'No grades yet';
                const averageText = subjectGrades.grades.length > 0 ? subjectGrades.average.toFixed(2) : 'N/A';

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${student.name}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${gradesText}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">${averageText}</td>
                `;

                tbody.appendChild(row);
            });
        }

        function populateStudentSelect(students) {
            const select = document.getElementById('gradeStudentSelect');
            select.innerHTML = '<option value="">Select Student</option>';

            students.forEach(student => {
                const option = document.createElement('option');
                option.value = student.id;
                option.textContent = student.name;
                select.appendChild(option);
            });
        }

        function showAddGradeForm() {
            document.getElementById('addGradeForm').classList.remove('hidden');
        }

        function hideAddGradeForm() {
            document.getElementById('addGradeForm').classList.add('hidden');
            document.getElementById('gradeStudentSelect').value = '';
            document.getElementById('gradeInput').value = '';
        }

        async function addGrade(event) {
            event.preventDefault();

            const studentId = document.getElementById('gradeStudentSelect').value;
            const grade = parseFloat(document.getElementById('gradeInput').value);

            if (!studentId || !grade) {
                showNotification('Please select a student and enter a grade', 'error');
                return;
            }

            if (grade < 1 || grade > 10) {
                showNotification('Grade must be between 1 and 10', 'error');
                return;
            }

            try {
                const response = await fetch('<?php echo $_SERVER['REQUEST_URI'] ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'add_grade',
                        student_id: studentId,
                        subject: currentSubject,
                        grade: grade,
                        class: currentClass
                    })
                });

                if (!response.ok) {
                    throw new Error('Failed to add grade');
                }

                const result = await response.json();
                if (result.success) {
                    showNotification('Grade added successfully', 'success');
                    hideAddGradeForm();
                    // Refresh the students table
                    openStudentModal(currentClass, currentSubject, currentTime, currentDay);
                } else {
                    throw new Error(result.error || 'Failed to add grade');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Error adding grade: ' + error.message, 'error');
            }
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white z-50`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
</body>
</html>