# projectD_Laravel8_api

### public\Python\Yolov5_DeepSort_Pytorch_test
### YOLOv5の実行ファイルが入っています。

## API説明
### http://localhost:8000/api/login
### ・ログイン用。ログイン時のトークンとユーザー情報を返す。

### http://localhost:8000/api/edit_spot/3 ←URIの最後にユーザーIDを入れる
### ・ログインしているユーザーが登録した全駐輪場の情報を返す
### http://localhost:8000/api/edit_camera/3 ←URIの最後に駐輪場IDを入れる
### ・登録した駐輪場の全カメラの情報を返す

### http://localhost:8000/api/store_spot/3 ←URIの最後にユーザーIDを入れる
### ・駐輪場を登録する
### http://localhost:8000/api/store_camera/3 ←URIの最後に駐輪場IDを入れる
### ・カメラを登録する

### http://localhost:8000/api/delete_spot/2 ←URIの最後に駐輪場のIDを入れる
### ・登録した駐輪場とカメラの削除
### http://localhost:8000/api/delete_camera/2 ←URIの最後にカメラのIDを入れる
### ・登録したカメラのみ削除

### http://localhost:8000/api/labels/2 ←URIの最後に駐輪場のIDを入れる
### ・ラベル付けの登録

### http://localhost:8000/api/start/2 ←URIの最後に駐輪場のIDを入れる
### ・処理の開始
### http://localhost:8000/api/stop/2 ←URIの最後に駐輪場のIDを入れる
### ・処理の停止

### http://127.0.0.1:8080/api/violation/1 ←URIの最後にカメラのIDを入れる
### ・違反した自転車の情報をカメラ単位で返す

### http://127.0.0.1:8080/api/bicycle/1 ←URIの最後にカメラのIDを入れる
### ・カメラに映るラベリングした範囲内の全自転車の情報をカメラ単位で返す（pythonが動いている間のみ。停止中は何も返さない）

