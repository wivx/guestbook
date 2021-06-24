<!DOCTYPE html>
<html>
<head>
<style>
    #post p {
      padding: 1em;
      border: 2px #ca7 solid;
    }

    #post p.nodata {
      border: 2px #ccc solid;
      background-color: #fafafa;
    }

    #postResult, #newResult {
      padding: .5em;
      background: #ccc;
    }

    #newPostMessage {
      color: blue;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  // 按 [讀取留言] 按鈕之後的行為
  $("button#read").click(function(){
    // 呼叫 posts API，讀取留言
    $.get("read.php", function(posts, status){
      // 處理讀回來的資料
      $("#postResult").html(JSON.stringify(posts));
      let postBlockHtml = "";
      // 處理成特定格式
      for(let i=0; i<posts.length; i++) {
        postBlockHtml += "<p>"+posts[i]+"</p>";
      }
      // 顯示在畫面上
      $("#post").html(postBlockHtml);
    }).fail(function(errorResponse) {
      $("#postResult").html(JSON.stringify(errorResponse.responseJSON));
      let postBlockHtml = '<p class="nodata">' + errorResponse.responseJSON[0] + '</p>';
      // 顯示在畫面上
      $("#post").html(postBlockHtml);
    });
  });

  // 按 [新增留言] 按鈕之後的行為
  $("button#new").click(function(){
    $("#newPostMessage").html('');
    // 讀取畫面上使用者輸入的欄位資料
    let text = $("#message").val();
    let filename = $("#filename").val();
    // 新增留言
    let postData = "text=" + text + "&filename=" + filename;
    // 呼叫新增留言 API
    $.get("post.php", postData, function(responseData){
      $("#newResult").html(JSON.stringify(responseData));
      $("#newPostMessage").html('新增留言成功');
    }).fail(function(errorResponse) {
      $("#newResult").html(JSON.stringify(errorResponse.responseJSON));
      $("#newPostMessage").html('新增留言失敗 請確認輸入之留言或檔名正確');
    });
  });

});
</script>
</head>
<body>


<!-- 讀取留言區 -->
<h1>當前留言</h1>
<button id="read">讀取留言</button>
<div id="post"></div>

<p>讀取留言 API 回傳結果 /read.php</p>
<div id="postResult"></div>

<hr />

<!-- 新增留言區 -->
<h1>新增留言</h1>
<table>
    <tr>
        <td>留言</td>
        <td><textarea id="message">平安就是福</textarea></td>
    </tr>
    <tr>
        <td>檔名</td>
        <td><input id="filename" value="04" /></td>
    </tr>
</table>
<button id="new">新增留言</button>
<div id="newPostMessage"></div>

<p>新增留言 API 回傳結果 /post.php </p>
<div id="newResult"></div>

</body>
</html>