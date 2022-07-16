<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Spot;
use App\Label;
use App\Bicycle;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $spots = Spot::where('users_id', $user['id'])->get();
        $spot = Spot::where('users_id', $user['id'])->get();
        return view('home', compact('user', 'spots','spot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //駐輪場の場所を登録
    public function store(Request $request, $id)
    {
        //
        $data = $request->all();
        $query = $data['spots_address'];
        $query = urlencode($query);
        $url = "http://www.geocoding.jp/api/";
        $url.= "?v=1.1&q=".$query;
        $line="";
        $fp = fopen($url, "r");
        while(!feof($fp)) {
            
            $line.= fgets($fp);
        }
        fclose($fp);
        $xml = simplexml_load_string($line);
        $insert_long = (string) $xml->coordinate->lng;
        $insert_lat= (string) $xml->coordinate->lat;
        $spot_id = Spot::insertGetId([
            'spots_name' => $data['spots_name'],
            'users_id' => $id, 
             'spots_longitude' => $insert_long, 
             'spots_latitude' => $insert_lat,
             'spots_url' => $data['spots_url'],
             'spots_address' => $data['spots_address'],
             'spots_status' => 'None',
             'spots_count' => 0,
             'spots_over_time' => 60,
             'spots_img' => '画像のパスが入ります',
        ]);
        return $data;
    }
    
    public function labels(Request $request, $id)
    {
        $data = $request->all();
        $mark = $data['label_mark'];
        $data_str = json_encode($data);

        //$jsonObject=json_decode(file_get_contents($data),true);
        $label_data = Label::insertGetId([
            'spots_id' => $id,
            'labels_json' => $data_str,

        ]);
        return  "ラベリングデータ $mark を登録しました";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $spots = Spot::where('users_id', $id)->get();
        //   dd($memo);
        return $spots;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request, $id)
    {
        $inputs = $request->all();
        // dd($inputs);
         Spot::where('spots_id', $id)->delete();
        return $inputs;
    }

    public function start(Request $request, $id)
    {
        $inputs = $request->all();
        $spots = Spot::where('spots_id', $id)->get();
        $spot_lis =  json_decode($spots , true); 
        //判定
        if ($spots[0]["spots_status"]=="Run" or $spots[0]["spots_status"]=="Run_process" or $spots[0]["spots_status"]=="Start"){
            return "処理中です";
        }else if ($spots[0]["spots_status"]=="None"){
           Spot::where('spots_id', $id)->update(['spots_status'=>'Start']);
           //実行ファイル
           $command = 'python C:\xampp\htdocs\bicycle_project_YOLOv5\laravel8-api\public\Python\Yolov5_DeepSort_Pytorch_test/start.py';
           popen('start "" ' . $command, 'r');
           return "処理を開始します";
        }
    }
    public function stop(Request $request, $id)
    {
        $inputs = $request->all();
        $spots = Spot::where('spots_id', $id)->get();
        $spot_lis =  json_decode($spots , true); 
        //判定
        if ($spots[0]["spots_status"]=="Run_process"){
           Spot::where('spots_id', $id)->update(['spots_status'=>'Stop']); 
           return '処理を停止します';
        }else if ($spots[0]["spots_status"]=="Start" or $spots[0]["spots_status"]=="Stop"){
            Spot::where('spots_id', $id)->update(['spots_status'=>'None']);
            return '無効な処理です';
        }
        else{
            return '処理が開始されていません';
        }
    }





    //動作テスト
    public function test()
    {
        $test = "Apiの動作テスト";
        return $test;
    }
}
