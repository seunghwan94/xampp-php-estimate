<?
function txtRead($filename){
    // 파일이 존재하는지 확인
    if (file_exists($filename)) {
        $file = fopen($filename, "r");
        
        // 파일의 내용을 읽고 출력
        while (!feof($file)) {
            $line = fgets($file);
            $result[] = trim($line);
        }
        fclose($file);
    }

    return $result;

}


function txtSave($filename,$txt){
    $textToWrite = '';
    $file = fopen($filename, "w"); // 파일을 쓰기 모드로 열기 (파일이 존재하지 않으면 생성됨)
    foreach ($txt as $key){
        $textToWrite .= $key."\n";
    }
    // 파일에 내용 쓰기
    fwrite($file, $textToWrite);
    // 파일 닫기
    fclose($file); 
}

?>