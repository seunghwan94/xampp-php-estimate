드래그 앤 드랍 견적서 작성 프로그램
이 프로그램은 타자가 느린 분들을 위해 드래그 앤 드랍으로 견적서 양식을 쉽게 작성하고 인쇄할 수 있도록 만들어진 웹 애플리케이션입니다.

시작하기 전에
본 프로그램을 사용하기 위해서는 먼저 XAMPP를 설치해야 합니다. XAMPP는 Apache, MySQL, PHP, Perl을 포함한 PHP 개발 환경입니다.

설치 방법
1. XAMPP 설치
XAMPP를 공식 웹사이트에서 다운로드하고 설치합니다.

2. PHP 설정 변경
설치 후, php.ini 파일을 찾아 다음 설정을 변경합니다:

graphql
Copy code
short_open_tag=On
이 설정은 PHP 단축 태그를 활성화합니다.

3. 가상 호스트 설정
C:\xampp\apache\conf\extra\httpd-vhosts.conf 파일을 열고 다음 코드를 추가합니다:

apache
Copy code
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host2.example.com
    DocumentRoot "C:\xampp\htdocs\estimate"
    ServerName estimate
    ErrorLog "logs/estimate-error.log"
    CustomLog "logs/estimate-access.log" common
</VirtualHost>
이 설정은 estimate라는 이름의 로컬 웹사이트를 설정합니다.

4. 호스트 파일 수정
Windows의 경우, C:\Windows\System32\drivers\etc\hosts 파일을 관리자 권한으로 열고 다음 줄을 추가합니다:

Copy code
127.0.0.1 estimate
이는 로컬 도메인 estimate을 로컬호스트 IP 주소에 매핑합니다.

5. 프로젝트 폴더 생성
C:\xampp\htdocs 내에 estimate라는 이름의 폴더를 만들고, 해당 폴더에 프로그램 코드를 넣습니다.

XAMPP 자동 실행
XAMPP Control Panel을 사용하여 Apache와 MySQL을 자동으로 시작하도록 설정할 수 있습니다. XAMPP Control Panel을 열고, Apache와 MySQL 옆의 'Service' 체크박스를 선택하여 시스템 시작 시 자동으로 실행되도록 합니다.

사용 방법
모든 설정이 완료되면, 웹 브라우저에서 http://estimate/로 접속하여 프로그램을 사용할 수 있습니다.
