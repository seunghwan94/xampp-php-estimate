<?php
// 파일 경로 설정
$filePath = 'data/estimate_form_default.txt'; // 실제 경로에 맞게 조정해주세요.

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
<div style="display:flex;justify-content: space-around;">
    <div style="width:45%;">
        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="businessNumberInput">사업자 번호</label>
                <input class="form-control" id="businessNumberInput" type="text" placeholder="사업자 번호 입력..." value="<?php echo htmlspecialchars($businessNumber); ?>" oninput="validateBusinessNumber()">
                <div class="feedback" id="businessNumberFeedback" style="display: none;"></div>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="emailInput">이메일 주소</label>
                <input class="form-control" id="emailInput" type="email" placeholder="이메일 주소 입력..." value="<?php echo htmlspecialchars($email); ?>" oninput="validateEmail()">
                <div class="feedback" id="emailFeedback" style="display: none;"></div>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="businessNameInput">상호 (법인명)</label>
                <input class="form-control" id="businessNameInput" type="text" placeholder="상호 (법인명)" value="<?php echo htmlspecialchars($businessName); ?>" oninput="validateBusinessName()">
                <div class="feedback" id="businessNameFeedback" style="display: none;"></div>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="nameInput">이름</label>
                <input class="form-control" id="nameInput" type="text" placeholder="이름 입력..." value="<?php echo htmlspecialchars($name); ?>">
                <div class="feedback" id="nameFeedback" style="display: none;"></div>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="addressInput">사업장 주소</label>
                <input class="form-control" id="addressInput" type="text" placeholder="사업장 주소 입력..." value="<?php echo htmlspecialchars($address); ?>">
                <div class="feedback" id="addressFeedback" style="display: none;"></div>
            </fieldset>
        </div>
    </div>

    <div style="width:45%;">
        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="businessTypeInput">업태</label>
                <input class="form-control" id="businessTypeInput" type="text" placeholder="업태 입력..." value="<?php echo htmlspecialchars($businessType); ?>">
                <div class="feedback" id="businessTypeFeedback" style="display: none;"></div>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="businessItemInput">종목</label>
                <input class="form-control" id="businessItemInput" type="text" placeholder="종목 입력..." value="<?php echo htmlspecialchars($businessItem); ?>">
                <div class="feedback" id="businessItemFeedback" style="display: none;"></div>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="phoneInput">전화번호</label>
                <input class="form-control" id="phoneInput" type="text" placeholder="전화번호 입력..." value="<?php echo htmlspecialchars($phone); ?>">
                <div class="feedback" id="phoneFeedback" style="display: none;"></div>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="faxInput">팩스번호</label>
                <input class="form-control" id="faxInput" type="text" placeholder="팩스번호 입력..." value="<?php echo htmlspecialchars($fax); ?>">
                <div class="feedback" id="faxFeedback" style="display: none;"></div>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset>
                <label class="form-label mt-4" for="mobileInput">핸드폰번호</label>
                <input class="form-control" id="mobileInput" type="text" placeholder="핸드폰번호 입력..." value="<?php echo htmlspecialchars($mobile); ?>">
                <div class="feedback" id="mobileFeedback" style="display: none;"></div>
            </fieldset>
        </div>
        <div style="padding-top:10px; text-align:right;">
        <button class="btn btn-dark my-2 my-sm-0" type="button" onclick="add()">저 장</button>
        </div>
    </div>
</div>



<script>
function add() {
    if (!confirm("이 정보를 추가하시겠습니까?")) {
        return; // 사용자가 취소를 클릭하면 여기서 중단
    }

    // 입력 필드의 값을 가져옵니다.
    var businessNumber = document.getElementById('businessNumberInput').value;
    var email = document.getElementById('emailInput').value;
    var businessName = document.getElementById('businessNameInput').value;
    var name = document.getElementById('nameInput').value;
    var address = document.getElementById('addressInput').value;
    var businessType = document.getElementById('businessTypeInput').value;
    var businessItem = document.getElementById('businessItemInput').value;
    var phone = document.getElementById('phoneInput').value;
    var fax = document.getElementById('faxInput').value;
    var mobile = document.getElementById('mobileInput').value;

    // XMLHttpRequest 객체 생성
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/ajax_estimate_form_default.proc.php", true); // POST 방식으로 요청 설정, 실제 서버의 URL로 수정 필요
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // 콘텐츠 타입 설정

    // 요청 상태 변경 시 처리할 함수
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert("추가되었습니다.");
            window.location.reload();
            // 성공 시 페이지 새로고침 또는 사용자에게 알림 등의 처리를 할 수 있습니다.
        }
    };

    // 데이터 전송
    xhr.send(
        "businessNumber=" + encodeURIComponent(businessNumber) +
        "&email=" + encodeURIComponent(email) +
        "&businessName=" + encodeURIComponent(businessName) +
        "&name=" + encodeURIComponent(name) +
        "&address=" + encodeURIComponent(address) +
        "&businessType=" + encodeURIComponent(businessType) +
        "&businessItem=" + encodeURIComponent(businessItem) +
        "&phone=" + encodeURIComponent(phone) +
        "&fax=" + encodeURIComponent(fax) +
        "&mobile=" + encodeURIComponent(mobile)
    );
}
function validateBusinessNumber() {
    var businessNumber = document.getElementById('businessNumberInput').value;
    var feedback = document.getElementById('businessNumberFeedback');
    var regex = /^\d{3}-\d{2}-\d{5}$/;

    if (regex.test(businessNumber)) {
        feedback.style.display = 'block';
        feedback.className = 'feedback valid-feedback';
        feedback.textContent = '유효한 사업자 번호입니다.';
    } else {
        feedback.style.display = 'block';
        feedback.className = 'feedback invalid-feedback';
        feedback.textContent = '유효하지 않은 사업자 번호입니다.';
    }
}

function validateEmail() {
    var email = document.getElementById('emailInput').value;
    var feedback = document.getElementById('emailFeedback');
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (regex.test(email)) {
        feedback.style.display = 'block';
        feedback.className = 'feedback valid-feedback';
        feedback.textContent = '유효한 이메일 주소입니다.';
    } else {
        feedback.style.display = 'block';
        feedback.className = 'feedback invalid-feedback';
        feedback.textContent = '유효하지 않은 이메일 주소입니다.';
    }
}

function validateBusinessName() {
    var businessName = document.getElementById('businessNameInput').value;
    var feedback = document.getElementById('businessNameFeedback');

    // 상호명이 비어있지 않은지 기본적으로 확인
    if (businessName.trim() !== '') {
        feedback.style.display = 'block';
        feedback.className = 'feedback valid-feedback';
        feedback.textContent = 'Okay.';
    } else {
        feedback.style.display = 'block';
        feedback.className = 'feedback invalid-feedback';
        feedback.textContent = '상호명을 입력해주세요.';
    }
}

// 추가된 입력 필드에 대한 유효성 검사 함수 구현
function validateField(inputId, feedbackId, validationFunction, validMsg, invalidMsg) {
    var inputValue = document.getElementById(inputId).value;
    var feedback = document.getElementById(feedbackId);

    if (validationFunction(inputValue)) {
        feedback.style.display = 'block';
        feedback.className = 'feedback valid-feedback';
        feedback.textContent = validMsg;
    } else {
        feedback.style.display = 'block';
        feedback.className = 'feedback invalid-feedback';
        feedback.textContent = invalidMsg;
    }
}

// 전화번호, 팩스번호, 핸드폰번호에 대한 간단한 형식 검사 예시
function validatePhoneFaxMobile() {
    var phoneRegex = /^\d{2,3}-\d{3,4}-\d{4}$/;
    validateField('phoneInput', 'phoneFeedback', value => phoneRegex.test(value), '유효한 전화번호입니다.', '유효하지 않은 전화번호 형식입니다.');
    validateField('faxInput', 'faxFeedback', value => phoneRegex.test(value), '유효한 팩스번호입니다.', '유효하지 않은 팩스번호 형식입니다.');
    validateField('mobileInput', 'mobileFeedback', value => phoneRegex.test(value), '유효한 핸드폰번호입니다.', '유효하지 않은 핸드폰번호 형식입니다.');
}

// 사업장 주소, 업태, 종목에 대한 기본적인 검사 (여기서는 비어있지 않은지만 확인)
function validateAddressBusinessTypeItem() {
    validateField('addressInput', 'addressFeedback', value => value.trim() !== '', 'Okay.', '사업장 주소를 입력해주세요.');
    validateField('businessTypeInput', 'businessTypeFeedback', value => value.trim() !== '', 'Okay.', '업태를 입력해주세요.');
    validateField('businessItemInput', 'businessItemFeedback', value => value.trim() !== '', 'Okay.', '종목을 입력해주세요.');
}

// 페이지 로드 시 또는 필요한 이벤트에 validatePhoneFaxMobile과 validateAddressBusinessTypeItem 호출
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('phoneInput').oninput = validatePhoneFaxMobile;
    document.getElementById('faxInput').oninput = validatePhoneFaxMobile;
    document.getElementById('mobileInput').oninput = validatePhoneFaxMobile;
    document.getElementById('addressInput').oninput = validateAddressBusinessTypeItem;
    document.getElementById('businessTypeInput').oninput = validateAddressBusinessTypeItem;
    document.getElementById('businessItemInput').oninput = validateAddressBusinessTypeItem;
});

</script>
