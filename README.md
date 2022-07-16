# projectD_Laravel8_api

##public\Python\Yolov5_DeepSort_Pytorch_test
###YOLOv5の実行ファイルが入っています。

##public\Python\Yolov5_DeepSort_Pytorch_test
###YOLOv5の実行ファイルが入っています。

##API説明
###http://localhost:8000/api/register
###・ユーザー登録用

###http://localhost:8000/api/login
###・ログイン用。ログイン時のトークンとユーザー情報を返す

###http://localhost:8000/api/edit/3←URIの最後にユーザーIDを入れる
###・ログインしているユーザーが登録した全駐輪場の情報を返す

###http://localhost:8000/api/store/3←URIの最後にユーザーIDを入れる
###・駐輪場を登録する

###http://localhost:8000/api/delete/2←URIの最後に駐輪場のIDを入れる
###・登録した駐輪場の削除

###http://localhost:8000/api/labels/2←URIの最後に駐輪場のIDを入れる
###・ラベル付けの登録

###http://localhost:8000/api/start/2←URIの最後に駐輪場のIDを入れる
###・処理の開始

###http://localhost:8000/api/stop/2←URIの最後に駐輪場のIDを入れる
###・処理の停止

