# Guestbook

### Guestbook 佈署方式
安裝 [XAMPP](https://www.apachefriends.org/index.html) 後，將本 repo 內容放置於 htdocs，並啟用 apache

---

### 留言板操作介面
存取網址
```
http://localhost/guestbook
```

## API

### 讀取留言 API
```
[GET]
http://localhost/guestbook/read.php
```

範例輸出：

有留言時：
```
["留言訊息1","留言訊息2"]
```

無留言時：
```
["無資料"]
```

### 新增留言 API
```
[GET]
http://localhost/guestbook/post.php?text=Allen&filename=06
```
參數：
- text 留言內容
- filename 留言檔名

範例輸出：

成功新增：
```
{"status": "success"}
```

新增失敗 - 參數錯誤：
```
{"status": "invalid parameter"}
```
