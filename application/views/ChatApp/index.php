<div class="page-header">
<h1>Botman testing application <small>test ver.</small></h1>
</div>
<div>
<div id="chatWindow" class="well chat" style="width:100%;">
</div>
<form>
<div class="input-group">
<input id="chatMessage" name="message" type="text" class="form-control" />
<span class="input-group-btn">
<input name="sender" class="btn btn-default" type="button" value="보내기"/>
</span>
</div>
</form>
<br />
<div class="btn-group" role="group">
<button id="chatClear" type="button" class="btn btn-default">대화 지우기</button>
</div>
</div>
<script>

// 채팅관련 요청 및 화면구현
function Chat()
{
this.sendMessage = function(message)
{
$.ajax({
type: "post",
url: "http://localhost:6081/chatapp/message",
data: "message=" + message,
dataType: "json",
success : function(result) {
if(typeof result.messages[0] !== 'undefined')
{
if(typeof result.messages[0].text !== 'undefined')
{
if(result.messages[0].attachment != null)
{
$("#chatWindow").append("<div style='text-align:left'><img src='" + result.messages[0].attachment.url + "' height='50' width='50' /></div>");
$("#chatWindow").append("<div style='text-align:left'> <b>TestBot :</b> " + result.messages[0].text + "</div>");
} else {
$("#chatWindow").append("<div style='text-align:left'> <b>TestBot :</b> " + result.messages[0].text + "</div>");
}

} else {
$("#chatWindow").append("<div style='text-align:left'> <b>TestBot :</b> 미구현 </div>");
}
} else {
$("#chatWindow").append("<div style='text-align:left'> <b>TestBot :</b> 미구현 </div>");
}
},
error : function(e) {
$("#chatWindow").append("<div style='text-align:left'> <b>TestBot :</b> 서버와 연결이 되어있지 않습니다. </div>");
}
});
}
this.showUserMessage = function(message)
{
$("#chatWindow").append("<div style='text-align:right'> Me : " + message + "</div>");
}
}

// XSS 체크
function XSS_Check(strTemp, level) {
  if ( level == undefined || level == 0 ) {
  strTemp = strTemp.replace(/\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-/g,"");
  }
  else if (level != undefined && level == 1 ) {
  strTemp = strTemp.replace(/\</g, "&lt;");
  strTemp = strTemp.replace(/\>/g, "&gt;");
  }
  return strTemp;
  }
</script>
<script>

var chat = new Chat();

// 이벤트 정의
$("input[name=sender]").click(function() {
var message = XSS_Check($("#chatMessage").val());
chat.showUserMessage(message);
chat.sendMessage(message);
});

$("#chatClear").click(function(){
$("#chatWindow").html("");
});
</script>