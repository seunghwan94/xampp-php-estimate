<?
if (isset($_GET['line'])) $line = $_GET['line'];
// 파일명
$filename = 'data/var.txt';
$var = txtRead($filename);

if (isset($_GET['edit'])){
    $edit = $_GET['edit'];
    $edit_array = txtRead($edit);
}else{
    $edit = '';
}




// 파일 경로 설정
$filePath = 'data/estimate_form_default.txt';

// 파일에서 데이터 읽기
if (file_exists($filePath)) {
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);

    $data = array_map('trim', $lines); // 각 줄의 앞뒤 공백 제거

    // 각 항목에 대한 값을 배열에서 추출, 존재하지 않을 경우 기본값으로 빈 문자열 설정
    $businessNumber = $data[0] ?? '';
    $email = $data[1] ?? '';
    $businessName = $data[2] ?? '';
    $name = $data[3] ?? '';
    $address = $data[4] ?? '';
    $businessType = $data[5] ?? '';
    $businessItem = $data[6] ?? '';
    $phone = $data[7] ?? '';
    $fax = $data[8] ?? '';
    $mobile = $data[9] ?? '';
} else {
    // 파일이 없거나 읽을 수 없는 경우, 모든 값을 빈 문자열로 설정
    $businessNumber = $email = $businessName = $name = $address = $businessType = $businessItem = $phone = $fax = $mobile = '';
}

?>


<style>
   table {
    border: none !important; /* 테이블 상단 테두리 제거 */
    border-collapse: collapse; /* 테두리 사이의 공간을 없앱니다 */
    width: 210mm;
    min-height: 297mm;
    font-size:15px;
  }
  
  thead th {
        background-color: transparent; /* 배경색 투명 설정 */
        border: none; /* 테두리 제거 */
        width: auto; /* 너비 설정, 필요에 따라 조정 */
    }
  th, td {
    border: 2px solid black; /* 모든 셀에 검은색 1px 실선 테두리를 적용합니다 */
    padding: 5spx; /* 셀 안의 내용과 테두리 사이의 공간을 설정합니다 */
    text-align: center; /* 텍스트를 왼쪽 정렬합니다 */
  }

  th {
    text-align: center; /* 제목 셀의 텍스트를 가운데 정렬합니다 */
    background-color: #f2f2f2; /* 제목 셀의 배경색을 설정합니다 */
  }

  .header {
    font-size: 24px; /* 헤더의 글씨 크기를 설정합니다 */
  }

  .sub-header {
    font-size: 18px; /* 서브 헤더의 글씨 크기를 설정합니다 */
  }
  .textarea-right {
    border: none; 
    outline: none; 
    height: 28px; 
    resize: none; 
    text-align : right;
    width: 100%;
    font-weight: bold;
  }
  .textarea-left {
    border: none; 
    outline: none; 
    height: 28px; 
    resize: none; 
    text-align : left;
    width:100%;
    font-weight: bold;
  }
  .textarea-center {
    border: none; 
    outline: none; 
    height: 28px; 
    resize: none; 
    text-align : center;
    width:100%;
    font-weight: bold;
  }
</style>

<div style="display:flex; justify-content: center;">
    <div style="margin-right:10px;">
    <div class="card bg-secondary mb-3" style="width:271px;">
        <div class="card-header">줄 수</div>
            <div class="card-body">
                <div>
                    <?foreach ($lineList as $key => $val) {?>
                        <button type="button" class="btn btn-primary" onclick="location.href='index.php?Theme=estimate_edit&line=<?=$val?>'"><?=$val?></button>
                    <? } ?>
                </div>
            </div>
        </div>



        <div style="width: 271px;">
            <?if(!$var){
                foreach ($var as $key => $val) {?>
                <button type="button" class="btn <?=explode("|", $val)[0]?>" id="editButton<?=$key?>" draggable="true" ondragstart="drag(event, '<?=explode("|", $val)[1]?>')" style="margin:2px;"><?=explode("|", $val)[1]?></button>
            <? }
            } ?>
        </div>
    </div>
    <div style="width:1002px;">
        <div id="printableArea">
            <?
            if (isset($edit_array) && $edit_array!='' ){
                foreach ($edit_array as $key => $val){
                    echo $val;
                }
            }else{?>
                <table style="border: 1px solid black; font-weight: 600;color:black;">
                    <thead>
                        <tr>
                        <th scope="col" style="width: 12mm;"></th>
                        <th scope="col" style="width: 8mm;"></th>
                        <th scope="col" style="width: 5mm;"></th>
                        <th scope="col" style="width: 35mm;"></th>
                        <th scope="col" style="width: 10mm;"></th>
                        <th scope="col" style="width: 26mm;"></th>
                        <th scope="col" style="width: 30mm;"></th>
                        <th scope="col" style="width: 30mm;"></th>
                        <th scope="col" style="width: 30mm;"></th>
                        <th scope="col" style=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan='7' style=" color:black;font-weight:bold;font-size: 35px;">견 적 서</td>
                            <td colspan='3'><textarea id="date" class="textarea-center"><?=date("Y 년 m 월 d 일")?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan='4' rowspan='3'>
                                <div style="display:flex;justify-content: space-evenly;">
                                    <textarea id="target" class="textarea-center" style="width:65%"></textarea>귀 하
                                </div>
                            </td>
                            <td rowspan='6' style="writing-mode: vertical-rl;min-height: 100px;">공 급 자</td>
                            <td>사업자 번호</td>
                            <td colspan='4'><?=$businessNumber?></td>
                        </tr>
                        <tr>
                            <td>상호 (법인명)</td>
                            <td colspan='2'><?=$businessName?></td>
                            <td>성명</td>
                            <td><?=$name?></td>
                        </tr>
                        <tr>
                            <td>사업장 주소</td>
                            <td colspan='4'><?=$address?></td>
                        </tr>
                        <tr>
                            <td colspan='2'>공급가액</td>
                            <td colspan='2'>
                                <div style="display:flex;justify-content: flex-end;">
                                    ₩ <textarea id ="sum1" class="textarea-right" readonly></textarea>
                                </div>
                            </td>
                            <td>업태</td>
                            <td colspan='2'><?=$businessType?></td>
                            <td>종목</td>
                            <td><?=$businessItem?></td>
                        </tr>
                        <tr>
                            <td colspan='2'>부가세액</td>
                            <td colspan='2'>
                                <div style="display:flex;justify-content: flex-end;">
                                    ₩ <textarea id ="sum2" class="textarea-right" readonly></textarea>
                                </div>
                            </td>
                            <td>TEL</td>
                            <td colspan='2'><?=$phone?></td>
                            <td>FAX</td>
                            <td><?=$fax?></td>
                        </tr>
                        <tr>
                            <td colspan='2'>합계금액</td>
                            <td colspan='2'>
                                <div style="display:flex;justify-content: flex-end;">
                                    ₩ <textarea id ="sum3" class="textarea-right" readonly></textarea>
                                </div>
                            </td>
                            <td>Phone</td>
                            <td colspan='2'><?=$mobile?></td>
                            <td>E-mail</td>
                            <td>
                                <?if($email){?>
                                <?=explode("@",$email)[0]?></br>@<?=explode("@",$email)[1]?>
                                <?}?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='10'>아래와 같이 견적합니다</td>
                        </tr>
                        <tr>
                            <td >번 호</td>
                            <td colspan='3'> 품명 </td>
                            <td >규격</td>
                            <td >수량</td>
                            <td >단가</td>
                            <td >공급가액</td>
                            <td >부가세액</td>
                            <td >비고</td>
                        </tr>
                        <?php for($i=1;$i <= $line; $i++) { ?>
                            <tr>
                                <td><?=$i?></td>
                                <td colspan='3'> <textarea id="product_name_<?=$i?>" class="textarea-center dropTarget" ondrop="drop(event)" ondragover="allowDrop(event)"></textarea></td>
                                <td><textarea id="product_standard_<?=$i?>" class="textarea-center"></textarea></td>
                                <td>
                                    <textarea id="num1-<?=$i?>" class="textarea-center" oninput="validateNumber(this); calculateProduct(<?=$i?>)"></textarea>
                                </td>
                                <td>
                                    <textarea id="num2-<?=$i?>" class="textarea-center" oninput="validateNumber(this); calculateProduct(<?=$i?>)"></textarea>
                                </td>
                                <td>
                                    <textarea id="product1-<?=$i?>" class="textarea-center" readonly></textarea>
                                </td>
                                <td>
                                    <textarea id="product2-<?=$i?>" class="textarea-center" readonly></textarea>
                                </td>
                                <td><textarea id="etc" class="textarea-center"></textarea></td>
                            </tr>      
                        <?php } ?>

                        <tr>
                            <td colspan='10'> < 공 사 내 역 > </td>
                        </tr>
                        <?for($i=1;$i<=5;$i++){?>
                            <tr>
                                <td><?=$i?></td>
                                <td colspan='10'><textarea id="contents_<?=$i?>" class="textarea-left"></textarea></td>
                            </tr>
                        <? } ?>     
                        <tr>
                            <td colspan='3'> 총 계 </td>
                            <td colspan='7'>
                                <div style="display:flex;justify-content: flex-end;">
                                    ₩ <textarea id="sum4" class="textarea-right" style="width:20%"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <? } ?>
        </div>



        <div style="text-align: right;margin-top:5px;">
            <button type="button" class="btn btn-dark" onclick="save()">저  장</button>
        </div>
    </div>
    
</div>

<script>
    function drag(ev, text) {
        // 드래그하는 요소의 텍스트 값을 데이터로 설정
        ev.dataTransfer.setData("text/plain", text);
    }

    function allowDrop(ev) {
        ev.preventDefault(); // 기본 이벤트 방지
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text/plain");

        // 드롭된 위치가 dropTarget 클래스를 가진 TEXTAREA 태그인 경우에만 값을 삽입
        if (ev.target.classList.contains('dropTarget')) {
            ev.target.value = data;
        }
    }

    function calculateProduct(index) {
        var num1 = document.getElementById('num1-' + index).value.replace(/,/g, ''); // 콤마 제거
        var num2 = document.getElementById('num2-' + index).value.replace(/,/g, ''); // 콤마 제거
        
        // 숫자로 변환하여 계산
        var product = (parseFloat(num1) || 0) * (parseFloat(num2) || 0);
        
        // 결과에 다시 콤마 추가하여 표시
        document.getElementById('product1-' + index).value = numberWithCommas(Math.floor(product));
        document.getElementById('product2-' + index).value = numberWithCommas(Math.floor(product));
        
        // 총합 계산 함수를 여기에 호출할 수 있습니다.
        sumProducts();
    }

    function numberWithCommas(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }
    function validateNumber(textarea) {
        // 숫자 이외의 모든 문자를 제거
        var num = textarea.value.replace(/,/g, '').replace(/[^\d.]/g, '');
        // 천 단위마다 콤마 추가
        textarea.value = numberWithCommas(num);
    }

    function sumProducts() {
        var sum = 0;
        <?php for($i = 1; $i <= $line; $i++) { ?>
            // 콤마를 제거하고 숫자로 변환
            var value = document.getElementById('product1-<?php echo $i; ?>').value.replace(/,/g, '');
            sum += Number(value);
        <?php } ?>
        // 계산된 합계를 천 단위마다 콤마가 찍히도록 포맷팅
        document.getElementById('sum1').value = numberWithCommas(Math.floor(sum));
        document.getElementById('sum2').value = numberWithCommas(Math.floor(sum / 10));
        document.getElementById('sum3').value = numberWithCommas(Math.floor(sum / 10 + sum));
        document.getElementById('sum4').value = numberWithCommas(Math.floor(sum / 10 + sum));
    }

    function save() {

        <? if($edit==""){ ?>
            var userInput = prompt("양식 이름을 작성해주세요.", "");

            if (userInput == null) {
                return;
            }

            var filename = "../data/estimate_form_list/" + userInput + "(" +document.getElementById('date').value+ ').txt'
        <? }else{ ?>
            var filename = "../<?=$edit?>";
        <? } ?>
        

        var printableArea = document.getElementById('printableArea').cloneNode(true);
        var textareas = printableArea.querySelectorAll('textarea');


        // 원본 document의 textarea 값들을 복사본에 반영
        textareas.forEach(function(textarea, index) {
            // console.log(textarea.id);
            textarea.textContent = document.getElementById(textarea.id).value;
        });

        var printContents = printableArea.innerHTML;
        saveContentToFile(filename,printContents);
    }

    function saveContentToFile(filename, printContents) {

        var xhr = new XMLHttpRequest(); // XMLHttpRequest 객체 생성
        xhr.open("POST", "ajax/ajax_estimate_form_list.proc.php", true); // POST 방식으로 요청 설정
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // 콘텐츠 타입 설정

        console.log(filename);

        xhr.onreadystatechange = function() { // 요청 상태 변경 시 처리할 함수
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText); // 요청이 성공적으로 완료되면 응답 출력
                // alert("양식이 저장 되었습니다."); // 요청이 성공적으로 완료되면 응답 출력
                window.location.href = "http://localhost/index.php?Theme=estimate_form_list";
            }
        };
        // 여러 파라미터를 쿼리 스트링 형식으로 결합하여 전송
        xhr.send("textToWrite=" + encodeURIComponent(printContents) + "&filename=" + encodeURIComponent(filename));
    }

</script>