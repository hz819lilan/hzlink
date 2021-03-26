<?php
$url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=UC0tX7rAh_xvj06hOxxUk76A&maxResults=1&order=date&type=video&key=AIzaSyDaIbedxKXCUwbSRTA0hwIc0-wuumqCvC0',

//ローカルjsonファイル名
$filename = 'game.json';

//データ更新
function update($filename,$url){
	$json = @file_get_contents($filename);
	$handle = fopen($filename, 'w');
	if(flock($handle, LOCK_EX)){
		if($data = @file_get_contents($url)){
			$json = $data;
		}
		fwrite($handle, $json);
	}
	fclose($handle);
}

//ローカルjson更新時間チェック
if(file_exists($filename)){
	$updatetime = filemtime($filename);
	$diff = time() - $updatetime;
	if($diff >= 1800) {
		update($filename,$url);
	}
}else{
	update($filename,$url);
}

//ローカルjson出力
$json = @file_get_contents($filename);
header('Content-Type: application/json');
echo $json;
?>