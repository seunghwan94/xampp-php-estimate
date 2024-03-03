<?
$pattern = '/^(.+)\((\d{4} 년 \d{2} 월 \d{2} 일)\)\.txt$/';
$txtFiles = glob('data/list/*.txt');
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
                            <td><button type="button" class="btn btn-dark" onclick="location.href='index.php?Theme=estimate_edit&edit=<?=$val?>'">수 정</button></td>
                        </tr>
                    <? $cnt++; ?>
                <? } ?>
            </tbody>
        </table>
    </div>
</div>