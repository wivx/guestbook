<?php

// 要寫入的文字
$_text = $_GET["text"];
// 存檔檔名 *.txt
$_filename = $_GET["filename"];

// 檢查有沒有少欄位，有少就顯示錯誤訊息
header('Content-Type: application/json');
http_response_code(200);
if(empty($_text) || empty($_filename)) {
    http_response_code(400);
    echo '{"status": "invalid paramater"}';
// 沒有少就寫入檔案
} else {
    writeTextFile($_text, $_filename);
}

////////////////////////////////////////////////////////
// 以下為工具函數
////////////////////////////////////////////////////////

// 把留言存成文字檔
function writeTextFile($text, $filename) {
    $writefile = fopen("./db/${filename}.txt", "w") or die("Unable to open file!");
    fwrite($writefile, $text);
    fclose($writefile);
    echo '{"status": "success"}';
}

?>