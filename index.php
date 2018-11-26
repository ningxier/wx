<?php
    //获得参数 signature nonce token timestamp echostr
    $nonce     = $_GET['nonce'];
    $token     = 'nyx';
    $timestamp = $_GET['timestamp'];
    $echostr   = $_GET['echostr'];
    $signature = $_GET['signature'];
    //形成数组，然后按字典序排序
    $array = array();
    $array = array($nonce, $timestamp, $token);
    sort($array);
    //拼接成字符串,sha1加密 ，然后与signature进行校验
    $str = sha1( implode( $array ) );
    if( $str == $signature && $echostr ){
        //第一次接入weixin api接口的时候
        echo  $echostr;
        exit;
    }
$postArr=$GLOBALS['HTTP_RAW_POST_DATA'];
$postObj=simplexml_load_string($postArr);
if(strtolower($postObj->MsgType)=='event'){
if(strtolower($postObj->Event=='subscribe')){
  $toUser=$postObj->FromUserName;
  $fromUser=$postObj->ToUserName;
  $time=time();
  $msgType='text';
  $content='hello';
  $template="<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
  </xml>";
  $info=sprintf($template,$toUser,$fromeUser,$time,$msgType,$content);
  echo $info;
} 
}
if(strtolower($postObj->MsgType)=='text'){
  //接收文本消息
  $content=$postObj->Content;
  $toUser=$postObj->FromUserName;
  $fromUser=$postObj->ToUserName;
  $time=time();
  $msgType='text';
   $text1="<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
  <FuncFlag>0</FuncFlag>
  </xml>";
    $contentStr="【".$content."预报】\n"
      ."2018年11月22日 14：40发布\n"
      ."实时天气\n"
      ."晴 -3~9° 南风3级\n"
     ."温馨提示：天气寒冷，多穿衣服\n"
      ."明天：\n"
      ."晴 -3~7°东北风2级\n"
      ."后天：\n"
      ."-3~10°";
     $text2=sprintf($text1,$toUser,$fromeUser,$time,$msgType,$contentStr);
     echo $text2;
}
