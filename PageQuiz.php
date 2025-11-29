<?php
// Đọc file quiz.txt
$filename = "quiz.txt";
$quiz_content = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Biến để lưu trữ câu hỏi và đáp án
$quiz = [];
$current_question = "";

foreach ($quiz_content as $line) {
    $line = trim($line);
    if (preg_match('/^ANSWER:/', $line)) {
        // Nếu dòng bắt đầu bằng ANSWER:, lưu đáp án vào câu hỏi hiện tại
        $quiz[] = [
            'question' => $current_question,
            'answer' => substr($line, 7) // cắt "ANSWER:" đi
        ];
        $current_question = ""; // reset cho câu hỏi tiếp theo
    } else {
        // Nếu chưa có ANSWER, nối dòng vào câu hỏi
        if ($current_question !== "") {
            $current_question .= "<br>" . $line;
        } else {
            $current_question = $line;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quiz Android</title>
<style>
body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
.quiz-container { max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #aaa; }
.question { margin-bottom: 15px; }
.question h3 { margin: 0 0 5px 0; }
.answer { color: green; margin-left: 15px; }
</style>
</head>
<body>

<div class="quiz-container">
    <h2>Quiz Android</h2>
    <?php foreach ($quiz as $index => $item): ?>
        <div class="question">
            <h3>Câu <?= $index + 1 ?>:</h3>
            <p><?= $item['question'] ?></p>
            <p class="answer"><strong>Đáp án:</strong> <?= $item['answer'] ?></p>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
