<?php

// 找出所有留言內容
$directoryFiles = listDir();

// 印出每則留言
$posts = array();
for($i=0; $i<count($directoryFiles); $i++) {
    // 留言檔名
    $postFileName = $directoryFiles[$i];
    // 檢查副檔名是 txt 的才讀取
    $path_parts = pathinfo($postFileName);
    if($path_parts['extension'] != 'txt') {
        continue;
    }
    // 讀取留言內容
    $postText = readTextFile("./db/$postFileName");
    // 印出留言內容
    $posts[] = $postText;
}

// 將結果印出
header('Content-Type: application/json');
http_response_code(200);
if(count($posts) == 0) {
    http_response_code(404);
    echo '["無資料"]';
} else {
    echo json_encode($posts);
}

////////////////////////////////////////////////////////
// 以下為工具函數
////////////////////////////////////////////////////////

// 讀取文字檔
function readTextFile($filename) {
    $readfile = fopen($filename, "r") or die("Unable to open file!");
    $result = '';
    if(filesize($filename) > 0) {
        $result = fread($readfile,filesize($filename));
    }
    fclose($readfile);
    return $result;
}

// 取得目錄清單
function listDir() {
    return scandir('./db/');
}

?>