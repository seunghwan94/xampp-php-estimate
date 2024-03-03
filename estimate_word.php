<?
$txtFiles = txtRead('data/var.txt');

$btn_color =[
    '하늘색' => 'btn-primary',
    '회색' => 'btn-secondary',
    '연두색' => 'btn-success',
    '남색' => 'btn-info',
    '주황색' => 'btn-warning',
    '빨간색' => 'btn-danger',
    '흰색' => 'btn-light',
    '검정색' => 'btn-dark',
];
?>

<div style="margin:20px;">
    <div style="margin:20px;display:flex;">
        <div style="width:185px; margin-right:10px;">
            <select class="form-select" id="SelectColor">
                <option value="">버튼 색 선택</option>
                <?php foreach ($btn_color as $key => $val) { ?>
                    <option value="<?=$val?>"><?=$key?></option>
                <?php } ?>
            </select>
        </div>    
        <input class="form-control me-sm-2" type="search" id="add_word" placeholder="추가할 단어를 쓰세요" style="width:80%;">
        <button class="btn btn-secondary my-2 my-sm-0" type="button" style="width:20%;" onclick="add()">추 가</button>
    </div>
    <div style="margin:20px;">
        <table class="table table-hover" style="text-align: center;">
            <thead>
                <tr class="table-dark">
                <th scope="col">번호</th>
                <th scope="col">이름</th>
                <th scope="col">비고</th>
                </tr>
            </thead>
            <tbody>
                <?  $cnt = 1;
                if ($txtFiles[0]!='' ){
                    foreach($txtFiles as $key => $val){?>
                    <? $active = ''; ?>
                    <? if($cnt%2==0) $active='table-active'; ?>
                        <tr class="<?=$active?>">
                            <td scope="row"><?=$cnt?></td>
                            <td scope="row"><button class="btn <?=explode("|",$val)[0]?> my-2 my-sm-0" type="button"><?=explode("|",$val)[1]?></button></td>
                            <td><button type="button" class="btn btn-dark" onclick="removeWord('<?=$val?>')">삭 제</button></td>
                        </tr>
                    <? $cnt++; ?>
                <? }
                }?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('add_word').addEventListener('keypress', function(event) {
        // 'Enter' 키가 눌렸는지 확인
        if (event.key === 'Enter') {
            event.preventDefault(); // 폼 제출을 방지
            add(); // 여기서 'add' 함수는 단어를 추가하는 함수입니다.
        }
    });
    function add() {
        // 색상 선택 여부 확인
        var selectedColor = document.getElementById('SelectColor').value;
        if (!selectedColor) {
            alert("버튼 색을 선택해주세요.");
            return; // 색상이 선택되지 않았으면 함수 실행을 중단
        }

        var word = document.getElementById('add_word').value;
        if (!word.trim()) {
            alert("단어를 입력해주세요.");
            return; // 단어가 입력되지 않았으면 함수 실행을 중단
        }

        if (!confirm("이 단어를 추가하시겠습니까?")) {
            return; // 사용자가 취소를 클릭하면 여기서 중단
        }

        var xhr = new XMLHttpRequest(); // XMLHttpRequest 객체 생성
        xhr.open("POST", "ajax/ajax_estimate_word.proc.php", true); // POST 방식으로 요청 설정
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // 콘텐츠 타입 설정

        xhr.onreadystatechange = function() { // 요청 상태 변경 시 처리할 함수
            if (xhr.readyState == 4 && xhr.status == 200) {
                // alert(xhr.responseText); // 요청이 성공적으로 완료되면 응답 출력
                window.location.reload();
            }
        };
        // 단어와 선택한 색상의 value 값을 함께 전송
        xhr.send("word=" + encodeURIComponent(word) + "&color=" + encodeURIComponent(selectedColor) + "&type=add");
    }

    function removeWord(word) {
        if (!confirm("이 단어를 삭제하시겠습니까?")) {
            return; // 사용자가 취소를 클릭하면 여기서 중단
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/ajax_estimate_word.proc.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // alert(xhr.responseText); // 요청이 성공적으로 완료되면 응답 출력
                window.location.reload();
            }
        };

        xhr.send("word=" + encodeURIComponent(word)+"&type=delete");
    }
</script>