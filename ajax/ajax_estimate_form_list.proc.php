<?

if (isset($_POST['textToWrite'])) {

    $filename = $_POST['filename']; // 저장할 파일 이름
    $textToWrite = $_POST['textToWrite']; // 클라이언트로부터 받은 텍스트 데이터

    $file = fopen($filename, "w"); // 파일을 쓰기 모드로 열기

    fwrite($file, $textToWrite); // 파일에 내용 쓰기
    fclose($file); // 파일 닫기
    echo "양식이 저장 완료되었습니다."; // 성공 메시지 응답
}
?>
