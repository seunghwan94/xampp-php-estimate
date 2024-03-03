<?
$pattern = '/^(.+)\((\d{4} 년 \d{2} 월 \d{2} 일)\)\.txt$/';
$txtFiles = glob('data/estimate_form_list/*.txt');
?>

<div style="margin:20px;">
    <div style="margin:20px;">
        <table class="table table-hover" style="text-align: center;">
            <thead>
                <tr class="table-dark">
                <th scope="col">번호</th>
                <th scope="col">이름</th>
                <th scope="col">날짜</th>
                <th scope="col">비고</th>
                </tr>
            </thead>
            <tbody>
                <?  $cnt = 1;
                    foreach($txtFiles as $key => $val){ 
                        preg_match($pattern, $val, $matches);
                        $name = $matches[1]; // 파일 이름 부분
                        $date = $matches[2]; // 날짜 부분  ?>
                    <? $active = ''; ?>
                    <? if($cnt%2==0) $active='table-active'; ?>
                        <tr class="<?=$active?>">
                            <th scope="row"><?=$cnt?></th>
                            <td><?=explode("/",$name)[2]?></td>
                            <td><?=$date?></td>
                            <td>
                            <div style="display:flex;justify-content: center;">
                                <button type="button" class="btn btn-dark" style="margin-right:10px;" onclick="location.href='index.php?Theme=estimate_new&edit=<?=$val?>'">수 정</button>
                                <button type="button" class="btn btn-dark" style="margin-right:10px;" onclick="location.href='index.php?Theme=estimate_edit&edit=<?=$val?>'">선 택</button>
                                <button type="button" class="btn btn-dark" onclick="removeWord('<?=$val?>')">삭 제</button>
                            </td>
                        </tr>
                    <? $cnt++; ?>
                <? } ?>
            </tbody>
        </table>
    <div style="display: flex;justify-content: flex-end;">
        <button type="button" class="btn btn-dark" style="margin-right:10px;" onclick="location.href='index.php?Theme=estimate_edit'">견적서 작성</button>
        <button type="button" class="btn btn-dark" onclick="location.href='index.php?Theme=estimate_new'">양식 추가</button>
    </div>
    </div>

</div>

<script>
    function removeWord(filename) {
        console.log(filename);
        if (!confirm("이 양식을 삭제하시겠습니까?")) {
            return; // 사용자가 취소를 클릭하면 여기서 중단
        }
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/ajax_estimate_form_delete.proc.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText); // 요청이 성공적으로 완료되면 응답 출력
                window.location.reload();
            }
        };

        xhr.send("filename=" + encodeURIComponent(filename));
    }
</script>