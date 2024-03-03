<?
$filePath = '../data/estimate_form_default.txt';

// 파일을 열거나, 파일이 없다면 생성
$file = fopen($filePath, "w"); // 'a' 모드는 파일의 끝에 데이터를 추가하는 모드입니다.

// POST 데이터 받기
$name = isset($_POST['name']) ? $_POST['name'] . "\n" : "";
$businessNumber = isset($_POST['businessNumber']) ? $_POST['businessNumber'] . "\n" : "";
$businessName = isset($_POST['businessName']) ? $_POST['businessName'] . "\n" : ""; // 변수명 수정
$address = isset($_POST['address']) ? $_POST['address'] . "\n" : "";
$businessType = isset($_POST['businessType']) ? $_POST['businessType'] . "\n" : "";
$businessItem = isset($_POST['businessItem']) ? $_POST['businessItem'] . "\n" : "";
$phone = isset($_POST['phone']) ? $_POST['phone'] . "\n" : ""; // 변수명 수정
$fax = isset($_POST['fax']) ? $_POST['fax'] . "\n" : ""; // 변수명 수정
$mobile = isset($_POST['mobile']) ? $_POST['mobile'] . "\n" : ""; // 변수명 수정
$email = isset($_POST['email']) ? $_POST['email'] . "\n" : "";

// 줄바꿈으로 구분하여 파일에 쓰기

fwrite($file, $businessNumber);
fwrite($file, $email);
fwrite($file, $businessName);
fwrite($file, $name);
fwrite($file, $address);


fwrite($file, $businessType);
fwrite($file, $businessItem);
fwrite($file, $phone);
fwrite($file, $fax);
fwrite($file, $mobile);


// 파일 닫기
fclose($file);

echo "Data saved successfully.";
?>
