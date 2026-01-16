<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2022/3/13
 * Time: 06:29
 */



$response = file_get_contents("data.txt");

$result  = array();
$response = str_replace("`"," ",$response);
$response = explode(PHP_EOL, $response);
$len = count($response);
//$num_data = explode(',', $dc_arr[$len - 2]);


foreach ($response as $key=>$val){
    if($key != 0 && $key < $len - 2){
        if(strpos($val, ',') !== false){
            $data = explode(',', $val);
            $data[37] = "机构编号";//"扩展字段4"  替换成 "代理机构编号"
        }
        $result[] = $data;
    }
}
//$handler = fopen('result.txt','a+');
//$content = PHP_EOL."================对账单数据处理结果123===================".PHP_EOL;
//$flag = fwrite($handler,$content.json_encode($result).$result[2][0]);
////echo '数据条数：'.count($response).PHP_EOL;
//fclose($handler);


foreach ($result as $k=>$v){
    $arr[$v['25']][] = $v;
    $leixing[$v['10']] = $v['25'];
}

foreach ($arr as $k=>$v){
    $feilvarr[$k] = array_sum(array_map(function($val){return $val[33];}, $v));;
    
}
echo json_encode($feilvarr);
echo print_r($leixing);
//echo print_r($arr);
//echo json_encode($arr);
//echo array_sum(array_map(function($val){return $val[33];}, $result));

//$handler = fopen('result.txt','a+');
//$content = PHP_EOL."================对账单数据处理结果123===================".PHP_EOL;
//$flag = fwrite($handler,$content.json_encode($result).$result[2][0]);
////echo '数据条数：'.count($response).PHP_EOL;
//fclose($handler);
//echo json_encode($result);