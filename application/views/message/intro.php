<?php
$data = json_decode(file_get_contents('php://input'), true);

// 받은 요청에서 content 항목 설정
$content = $data["content"];



// '시작하기' 버튼 처리
if( $content == "시작하기" )
{
	echo <<< EOD
    {
        "message": {
            "text": "아직 개발중이라 대답을 잘 못해도 이해해줘^^;"
        }
    }
EOD;
}
// '도움말' 버튼 처리
else if( $content == "도움말")
{
	echo <<< EOD
    {
        "message": {
            "text": "이제 곧 정식 버전이 출시될거야. 조금만 기다려~~~"
        }
    }
EOD;
}
// '안녕'이란 단어가 포함되었을때 처리
else if( strpos($content, "안녕") !== false )
{
	echo <<< EOD
    {
        "message": {
            "text": "안녕~~ 반가워 ㅎㅎ"
        }
    }
EOD;
}
// 그밖의 문장일때
else
{
	echo <<< EOD
    {
        "message": {
            "text": "나랑 놀자 ㅋㅋㅋ"
        }
    }
EOD;
}