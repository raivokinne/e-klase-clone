<?php view('components/head', ['title' => 'Students']) ?>
<?php view('components/side-nav') ?>

<div class="min-h-screen bg-gray-100 <?php echo (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['admin','teacher'])) ? 'pl-[250px]' : ''; ?> transition-all duration-300">
  <section class="py-12">
    <div class="max-w-6xl mx-auto p-8 bg-white rounded-2xl">
      <h1 class="text-4xl font-extrabold text-gray-800 mb-6">Admin: Students</h1>
      <!-- Students content goes here -->
    </div>
  </section>
</div>

<?php view('components/footer') ?>