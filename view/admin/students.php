<?php view('components/head', ['title' => 'Management']) ?>
<?php view('components/side-nav') ?>
<div class="min-h-screen bg-gray-100 <?php echo (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['admin','teacher'])) ? 'pl-[250px]' : ''; ?> transition-all duration-300">
  <section class="py-12">
    <div class="container mx-auto px-4">
      <div class="mb-6 flex border-b border-gray-200">
        <button id="student-tab" onclick="switchTab('student')" class="px-6 py-3 border-b-2 border-black text-black font-medium">
          Student Management
        </button>
        <button id="teacher-tab" onclick="switchTab('teacher')" class="px-6 py-3 text-gray-500 hover:text-black font-medium">
          Teacher Management
        </button>
      </div>
      
      <div id="student-section">
        <h1 class="text-3xl font-bold mb-8 text-black">Student Management</h1>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
          <h2 class="text-xl font-semibold mb-4 text-black">Add New Student</h2>
          <form action="process_student.php" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="add">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label for="student_first_name" class="block text-sm font-medium text-black mb-1">First Name</label>
                <input type="text" id="student_first_name" name="first_name" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
              </div>
              
              <div>
                <label for="student_last_name" class="block text-sm font-medium text-black mb-1">Last Name</label>
                <input type="text" id="student_last_name" name="last_name" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
              </div>
              
              <div>
                <label for="student_email" class="block text-sm font-medium text-black mb-1">Email</label>
                <input type="email" id="student_email" name="email" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
              </div>
              
              <div>
                <label for="student_id" class="block text-sm font-medium text-black mb-1">Student ID</label>
                <input type="text" id="student_id" name="student_id" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
              </div>
              
              <div>
                <label for="grade_level" class="block text-sm font-medium text-black mb-1">Grade Level</label>
                <select id="grade_level" name="grade_level" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
                  <option value="">Select Grade</option>
                  <option value="9">9th Grade</option>
                  <option value="10">10th Grade</option>
                  <option value="11">11th Grade</option>
                  <option value="12">12th Grade</option>
                </select>
              </div>
              
              <div>
                <label for="student_dob" class="block text-sm font-medium text-black mb-1">Date of Birth</label>
                <input type="date" id="student_dob" name="date_of_birth" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
              </div>
            </div>
            
            <div class="flex justify-end">
              <button type="submit" class="px-6 py-2 bg-black text-white font-medium rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                Add Student
              </button>
            </div>
          </form>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4 text-black">Search Students</h2>
          <form action="students.php" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label for="search_student_name" class="block text-sm font-medium text-black mb-1">Student Name</label>
                <input type="text" id="search_student_name" name="search_name" 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black"
                  placeholder="Search by name">
              </div>
              
              <div>
                <label for="search_student_id" class="block text-sm font-medium text-black mb-1">Student ID</label>
                <input type="text" id="search_student_id" name="search_id" 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black"
                  placeholder="Search by ID">
              </div>
              
              <div>
                <label for="search_grade" class="block text-sm font-medium text-black mb-1">Grade Level</label>
                <select id="search_grade" name="search_grade" 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
                  <option value="">All Grades</option>
                  <option value="9">9th Grade</option>
                  <option value="10">10th Grade</option>
                  <option value="11">11th Grade</option>
                  <option value="12">12th Grade</option>
                </select>
              </div>
            </div>
            
            <div class="flex justify-end">
              <button type="submit" class="px-6 py-2 bg-gray-800 text-white font-medium rounded-md hover:bg-black focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                Search
              </button>
            </div>
          </form>
        </div>
        
        <div class="mt-8">
          <h2 class="text-xl font-semibold mb-4 text-black">Student List</h2>
          <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-100">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">ID</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Name</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Email</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php if(isset($students) && !empty($students)): ?>
                  <?php foreach($students as $student): ?>
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $student['id_number']; ?></td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-black"><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $student['email']; ?></td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="edit_student.php?id=<?php echo $student['id']; ?>" class="text-gray-800 hover:text-black mr-3">Edit</a>
                        <a href="delete_student.php?id=<?php echo $student['id']; ?>" class="text-gray-800 hover:text-black" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-700">No students found</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div id="teacher-section" class="hidden">
        <h1 class="text-3xl font-bold mb-8 text-black">Teacher Management</h1>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
          <h2 class="text-xl font-semibold mb-4 text-black">Add New Teacher</h2>
          <form action="process_teacher.php" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="add">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label for="teacher_first_name" class="block text-sm font-medium text-black mb-1">First Name</label>
                <input type="text" id="teacher_first_name" name="first_name" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
              </div>
              
              <div>
                <label for="teacher_last_name" class="block text-sm font-medium text-black mb-1">Last Name</label>
                <input type="text" id="teacher_last_name" name="last_name" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
              </div>
              
              <div>
                <label for="teacher_email" class="block text-sm font-medium text-black mb-1">Email</label>
                <input type="email" id="teacher_email" name="email" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
              </div>
              
              <div>
                <label for="teacher_id" class="block text-sm font-medium text-black mb-1">Teacher ID</label>
                <input type="text" id="teacher_id" name="teacher_id" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
              </div>
              
              <div>
                <label for="department" class="block text-sm font-medium text-black mb-1">Department</label>
                <select id="department" name="department" required 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
                  <option value="">Select Department</option>
                  <option value="Mathematics">Mathematics</option>
                  <option value="Science">Science</option>
                  <option value="English">English</option>
                  <option value="History">History</option>
                  <option value="Arts">Arts</option>
                  <option value="Physical Education">Physical Education</option>
                </select>
              </div>
              
              <div>
                <label for="phone" class="block text-sm font-medium text-black mb-1">Phone Number</label>
                <input type="tel" id="phone" name="phone" 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
              </div>
            </div>
            
            <div class="flex justify-end">
              <button type="submit" class="px-6 py-2 bg-black text-white font-medium rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                Add Teacher
              </button>
            </div>
          </form>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4 text-black">Search Teachers</h2>
          <form action="teachers.php" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label for="search_teacher_name" class="block text-sm font-medium text-black mb-1">Teacher Name</label>
                <input type="text" id="search_teacher_name" name="search_name" 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black"
                  placeholder="Search by name">
              </div>
              
              <div>
                <label for="search_teacher_id" class="block text-sm font-medium text-black mb-1">Teacher ID</label>
                <input type="text" id="search_teacher_id" name="search_id" 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black"
                  placeholder="Search by ID">
              </div>
              
              <div>
                <label for="search_department" class="block text-sm font-medium text-black mb-1">Department</label>
                <select id="search_department" name="search_department" 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-black">
                  <option value="">All Departments</option>
                  <option value="Mathematics">Mathematics</option>
                  <option value="Science">Science</option>
                  <option value="English">English</option>
                  <option value="History">History</option>
                  <option value="Arts">Arts</option>
                  <option value="Physical Education">Physical Education</option>
                </select>
              </div>
            </div>
            
            <div class="flex justify-end">
              <button type="submit" class="px-6 py-2 bg-gray-800 text-white font-medium rounded-md hover:bg-black focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                Search
              </button>
            </div>
          </form>
        </div>
        
        <div class="mt-8">
          <h2 class="text-xl font-semibold mb-4 text-black">Teacher List</h2>
          <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-100">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">ID</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Name</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Email</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php if(isset($teachers) && !empty($teachers)): ?>
                  <?php foreach($teachers as $teacher): ?>
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $teacher['id_number']; ?></td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-black"><?php echo $teacher['first_name'] . ' ' . $teacher['last_name']; ?></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $teacher['email']; ?></td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="edit_teacher.php?id=<?php echo $teacher['id']; ?>" class="text-gray-800 hover:text-black mr-3">Edit</a>
                        <a href="delete_teacher.php?id=<?php echo $teacher['id']; ?>" class="text-gray-800 hover:text-black" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-700">No teachers found</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  function switchTab(tab) {
    document.getElementById('student-section').classList.add('hidden');
    document.getElementById('teacher-section').classList.add('hidden');
    
    document.getElementById('student-tab').classList.remove('border-black', 'text-black');
    document.getElementById('student-tab').classList.add('text-gray-500');
    document.getElementById('teacher-tab').classList.remove('border-black', 'text-black');
    document.getElementById('teacher-tab').classList.add('text-gray-500');
    
    if (tab === 'student') {
      document.getElementById('student-section').classList.remove('hidden');
      document.getElementById('student-tab').classList.add('border-black', 'text-black');
      document.getElementById('student-tab').classList.remove('text-gray-500');
    } else if (tab === 'teacher') {
      document.getElementById('teacher-section').classList.remove('hidden');
      document.getElementById('teacher-tab').classList.add('border-black', 'text-black');
      document.getElementById('teacher-tab').classList.remove('text-gray-500');
    }
  }
</script>

<?php view('components/footer') ?>