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
    <!-- Side Navigation Placeholder -->
    <div class="fixed left-0 top-0 h-full w-[250px] bg-gray-800 text-white p-4">
        <h2 class="text-xl font-bold mb-4">Teacher Panel</h2>
        <nav class="space-y-2">
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
            <a href="#" class="block py-2 px-4 rounded bg-gray-700">Curriculum</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Grades</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Messages</a>
        </nav>
    </div>

    <div class="min-h-screen bg-gray-100 pl-[250px] transition-all duration-300">
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-black">My Curriculum</h1>
                    <p class="text-gray-600 mt-2">Subject: Mathematics | Teacher: Tom Teacher</p>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Monday -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-black mb-4">Monday</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 my-4">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Class</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Subject</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Room</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="group hover:bg-gray-50 transition-all duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">08:30 - 09:10</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Mathematics', '08:30 - 09:10', 'Monday')">10A</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Mathematics', '08:30 - 09:10', 'Monday')">Mathematics</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">123P</td>
                                    </tr>
                                    <tr class="group hover:bg-gray-50 transition-all duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">09:10 - 09:50</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Physics', '09:10 - 09:50', 'Monday')">10A</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Physics', '09:10 - 09:50', 'Monday')">Physics</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">123P</td>
                                    </tr>
                                    <tr class="group hover:bg-gray-50 transition-all duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">09:50 - 10:30</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Chemistry', '09:50 - 10:30', 'Monday')">10A</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Chemistry', '09:50 - 10:30', 'Monday')">Chemistry</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">345P</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tuesday -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-black mb-4">Tuesday</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 my-4">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Class</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Subject</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Room</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="group hover:bg-gray-50 transition-all duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">08:30 - 09:10</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Biology', '08:30 - 09:10', 'Tuesday')">10A</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Biology', '08:30 - 09:10', 'Tuesday')">Biology</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">123P</td>
                                    </tr>
                                    <tr class="group hover:bg-gray-50 transition-all duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">09:10 - 09:50</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Computer Science', '09:10 - 09:50', 'Tuesday')">10A</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Computer Science', '09:10 - 09:50', 'Tuesday')">Computer Science</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">342C</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Rest of the week would follow the same pattern -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-black mb-4">Wednesday</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 my-4">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Class</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Subject</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Room</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="group hover:bg-gray-50 transition-all duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">08:30 - 09:10</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Mathematics', '08:30 - 09:10', 'Wednesday')">10A</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 clickable-cell" onclick="openStudentModal('10A', 'Mathematics', '08:30 - 09:10', 'Wednesday')">Mathematics</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">123P</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                                        <option value="1">Sam Student</option>
                                        <option value="2">Bob Williams</option>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Number</th>
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

        async function openStudentModal(className, subject, time, day) {
            currentClass = className;
            currentSubject = subject;
            currentTime = time;
            currentDay = day;

            document.getElementById('modalTitle').textContent = `Students in Class ${className}`;
            document.getElementById('modalSubtitle').textContent = `Subject: ${subject} | Time: ${time} | Day: ${day}`;

            try {
                const response = await fetch(`/teacher/students?class=${encodeURIComponent(className)}&subject=${encodeURIComponent(subject)}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch students');
                }
                const students = await response.json();
                populateStudentsTable(students);
                document.getElementById('studentModal').classList.remove('hidden');
            } catch (error) {
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${student.id_number}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${gradesText}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">${averageText}</td>
                `;

                tbody.appendChild(row);
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
                const response = await fetch('/teacher/students', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        student_id: parseInt(studentId),
                        subject: currentSubject,
                        grade: grade,
                        class: currentClass
                    })
                });

                if (!response.ok) {
                    throw new Error('Failed to add grade');
                }

                const result = await response.json();

                // Refresh the students list
                const studentsResponse = await fetch(`/teacher/students?class=${encodeURIComponent(currentClass)}&subject=${encodeURIComponent(currentSubject)}`);
                if (!studentsResponse.ok) {
                    throw new Error('Failed to refresh students');
                }
                const students = await studentsResponse.json();
                populateStudentsTable(students);

                hideAddGradeForm();
                showNotification('Grade added successfully!', 'success');
            } catch (error) {
                showNotification('Error adding grade: ' + error.message, 'error');
            }
        }

        function editGrades(studentId) {
            alert(`Edit grades for student ID: ${studentId}\nThis would open a detailed grade editing interface.`);
        }

        function viewHistory(studentId) {
            alert(`View grade history for student ID: ${studentId}\nThis would show all historical grades and trends.`);
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-md z-50 ${
                type === 'success' ? 'bg-green-500' :
                type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            } text-white shadow-lg transform transition-all duration-300`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Close modal when clicking outside of it
        document.getElementById('studentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStudentModal();
            }
        });
    </script>
</body>
</html>
