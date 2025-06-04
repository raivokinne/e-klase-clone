<?php view('components/head', ['title' => $title]) ?>
<?php view('components/side-nav') ?>

<section class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        <?= htmlspecialchars($student['name']) ?>
                    </h1>
                    <p class="text-lg text-gray-600">Class: <?= htmlspecialchars($class) ?></p>
                </div>
                <div class="mt-4 sm:mt-0 text-right">
                    <div class="text-sm text-gray-500">Overall Average</div>
                    <div class="flex items-center gap-3">
                        <div class="text-3xl font-bold <?= getGradeColor(calculateOverallAverage($student['grades'])) ?>">
                            <?= calculateOverallAverage($student['grades']) ?>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold <?= getGradeColor(calculateOverallAverage($student['grades'])) ?>">
                                <?= getLetterGrade(calculateOverallAverage($student['grades'])) ?>
                            </div>
                            <div class="text-xs text-gray-500">
                                ECTS: <?= getECTSGrade(calculateOverallAverage($student['grades'])) ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm <?= getGradeColor(calculateOverallAverage($student['grades'])) ?> mt-1">
                        <?= getGradeStatus(calculateOverallAverage($student['grades'])) ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Subjects Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($student['grades'] as $subject): ?>
                <?php $isPassingGrade = isPassing($subject['average']); ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden <?= !$isPassingGrade ? 'ring-2 ring-red-200' : '' ?>">
                    <div class="px-6 py-4 bg-gray-50 border-b">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <?= htmlspecialchars($subject['subject']) ?>
                            </h3>
                            <?php if (!$isPassingGrade): ?>
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    FAIL
                                </span>
                            <?php else: ?>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    PASS
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-sm text-gray-500">
                                <?= count($subject['grades']) ?> grade<?= count($subject['grades']) !== 1 ? 's' : '' ?>
                            </span>
                            <div class="flex items-center gap-2">
                                <span class="text-lg font-bold <?= getGradeColor($subject['average']) ?>">
                                    <?= number_format($subject['average'], 2) ?>
                                </span>
                                <span class="text-sm font-medium <?= getGradeColor($subject['average']) ?>">
                                    (<?= getLetterGrade($subject['average']) ?>)
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Individual Grades -->
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Individual Grades:</h4>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($subject['grades'] as $grade): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        <?= $grade >= 4.0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= number_format($grade, 1) ?> (<?= getLetterGrade($grade) ?>)
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Grade Statistics -->
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Highest:</span>
                                <span class="font-medium"><?= number_format(max($subject['grades']), 1) ?> (<?= getLetterGrade(max($subject['grades'])) ?>)</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Lowest:</span>
                                <span class="font-medium"><?= number_format(min($subject['grades']), 1) ?> (<?= getLetterGrade(min($subject['grades'])) ?>)</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">ECTS Grade:</span>
                                <span class="font-medium"><?= getECTSGrade($subject['average']) ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-medium <?= getGradeColor($subject['average']) ?>">
                                    <?= getGradeStatus($subject['average']) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Progress Bar (1-10 scale) -->
                        <div class="mt-4">
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>1</span>
                                <span class="text-red-500">4 (Pass)</span>
                                <span>10</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 relative">
                                <!-- Pass line indicator -->
                                <div class="absolute left-[30%] top-0 w-0.5 h-3 bg-red-400"></div>
                                <div class="h-3 rounded-full <?= getGradeColor($subject['average']) === 'text-green-700' ? 'bg-green-600' :
                                    (getGradeColor($subject['average']) === 'text-green-600' ? 'bg-green-500' :
                                    (getGradeColor($subject['average']) === 'text-blue-600' ? 'bg-blue-500' :
                                    (getGradeColor($subject['average']) === 'text-yellow-600' ? 'bg-yellow-500' :
                                    (getGradeColor($subject['average']) === 'text-orange-600' ? 'bg-orange-500' : 'bg-red-500')))) ?>"
                                     style="width: <?= ($subject['average'] / 10) * 100 ?>%"></div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1 text-center">
                                1 (Lowest) - 10 (Highest)
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Academic Performance Summary -->
        <div class="mt-8 bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Academic Performance Summary</h2>

            <!-- Performance Overview -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600"><?= count($student['grades']) ?></div>
                    <div class="text-sm text-gray-500">Subjects</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">
                        <?php
                        $passingSubjects = 0;
                        foreach ($student['grades'] as $subject) {
                            if (isPassing($subject['average'])) $passingSubjects++;
                        }
                        echo $passingSubjects;
                        ?>
                    </div>
                    <div class="text-sm text-gray-500">Passed</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600">
                        <?= count($student['grades']) - $passingSubjects ?>
                    </div>
                    <div class="text-sm text-gray-500">Failed</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold <?= getGradeColor(calculateOverallAverage($student['grades'])) ?>">
                        <?= calculateOverallAverage($student['grades']) ?>
                    </div>
                    <div class="text-sm text-gray-500">Overall Average</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold <?= getGradeColor(calculateOverallAverage($student['grades'])) ?>">
                        <?= getECTSGrade(calculateOverallAverage($student['grades'])) ?>
                    </div>
                    <div class="text-sm text-gray-500">ECTS Grade</div>
                </div>
            </div>

            <!-- Grade Distribution -->
            <div class="border-t pt-4">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Grade Distribution</h3>
                <div class="grid grid-cols-3 md:grid-cols-6 gap-4 text-sm">
                    <?php
                    $gradeDistribution = ['A+/A' => 0, 'B+/B' => 0, 'C+/C' => 0, 'D+/D' => 0, 'E' => 0, 'F' => 0];
                    foreach ($student['grades'] as $subject) {
                        $letter = getLetterGrade($subject['average']);
                        if (in_array($letter, ['A+', 'A'])) $gradeDistribution['A+/A']++;
                        elseif (in_array($letter, ['B+', 'B'])) $gradeDistribution['B+/B']++;
                        elseif (in_array($letter, ['C+', 'C'])) $gradeDistribution['C+/C']++;
                        elseif (in_array($letter, ['D+', 'D'])) $gradeDistribution['D+/D']++;
                        elseif ($letter === 'E') $gradeDistribution['E']++;
                        else $gradeDistribution['F']++;
                    }
                    ?>
                    <?php foreach ($gradeDistribution as $grade => $count): ?>
                        <div class="text-center p-3 bg-gray-50 rounded">
                            <div class="text-lg font-bold"><?= $count ?></div>
                            <div class="text-gray-600"><?= $grade ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@media print {
    .bg-gray-50 { background: white !important; }
    .shadow-sm { box-shadow: none !important; }
    button, .bg-gray-600 { display: none !important; }
}
</style>

<?php view('components/footer') ?>
