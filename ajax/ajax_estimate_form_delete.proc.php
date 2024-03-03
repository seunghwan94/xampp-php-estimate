<?
$filename = $_POST['filename'];

unlink("../".$filename);

echo "이 양식을 삭제 되었습니다.";
?>