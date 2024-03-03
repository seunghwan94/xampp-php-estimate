<?
$filePath = '../data/var.txt';

if ($_POST['type'] == 'add' && isset($_POST['word'])) {
    // 파일이 존재하고, 파일 사이즈가 0보다 크면 내용이 있다고 판단
    if (file_exists($filePath) && filesize($filePath) > 0) {
        // 파일에 내용이 있으므로, 줄바꿈과 함께 추가
        file_put_contents($filePath, "\n".$_POST['color']."|".$_POST['word'], FILE_APPEND | LOCK_EX);
    } else {
        // 파일이 비어 있으므로, 줄바꿈 없이 추가
        file_put_contents($filePath, $_POST['color']."|".$_POST['word'], FILE_APPEND | LOCK_EX);
    }
}else if ($_POST['type']=='delete' && isset($_POST['word'])){
    $word = $_POST['word'];
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);

    // 제거할 단어가 있는 줄을 찾아서 배열에서 제거
    $newLines = array_filter($lines, function($line) use ($word) {
        return trim($line) !== trim($word);
    });

    // 파일에 새로운 내용을 쓴다.
    file_put_contents($filePath, implode(PHP_EOL, $newLines));
}
?>