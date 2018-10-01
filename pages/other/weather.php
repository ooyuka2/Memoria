<div class="card col-xl-12">
	<div class="card-body row">
<?php

	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) {
		$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
		include_once($ini['dirWin'].'/pages/function.php');
	}
	$url = "http://weather.livedoor.com/forecast/webservice/json/v1?city=110010";
	$response = @file_get_contents($url);
	if ($response !== false) {
		$json = file_get_contents($url, true);
		$json = json_decode($json, true);
	 
		// Pubric
		$title = $json['title'];                                                    // 市区町村
		$description = $json['description']['text'];            // 詳細情報
		$publicTime = $json['publicTime'];                              // 更新時間
	 
		// Location
		$city = $json['location']['city'];                              // 東京
		$area = $json['location']['area'];                              // 関東
		$prefecture = $json['location']['prefecture'];      // 東京都
		$link = $json['link'];                                                      // URL
		foreach ($json['forecasts'] as $entry) {
			$dateLabel = mb_convert_encoding($entry['dateLabel'], "sjis-win", "auto");            // 今日･明日･明後日
			
			$telop = $entry['telop'];   
			$date = $entry['date'];                                                                                 // 日付
			$min = $entry['temperature']['min'];                                                        // 最低気温
			$max = $entry['temperature']['max'];                                                        // 最高気温
			$mincelsius = $entry['temperature']['min']["celsius"];                  // 摂氏
			$minfahrenheit = $entry['temperature']['min']["fahrenheit"];        // 華氏
			$maxcelsius = $entry['temperature']['max']["celsius"];                  // 摂氏
			$maxfahrenheit = $entry['temperature']['max']["fahrenheit"];        // 華氏
			
			$image = $entry['image']["url"];                                                                // アイコン
			// NULL
			if (!isset($min)) { $mincelsius = "--"; }
			if (!isset($max)) { $maxcelsius = "--"; }
			if (!isset($celsius)) { $min = "--"; }
			if (!isset($fahrenheit)) { $min = "--"; }
			
			for($i=1; $i<31; $i++) {
				if ($image == "http://weather.livedoor.com/img/icon/" . $i . ".gif") $image = $ini['dirhtml'] . "/img/weather/" . $i . ".png";
			}
			if(equal_word_str($dateLabel, "今日")) echo  "<div class='col-xl-6 text-center'>" . $dateLabel . "<br><image src='".$image ."' style='max-width:80px'>";
			else echo  "<div class='col-xl-3 text-center'>" . $dateLabel . "<br><image src='".$image ."' style='max-width:50px'>";
			
			echo "<p>" . mb_convert_encoding($entry['telop'], "sjis-win", "auto") . "<br>" . $mincelsius . "～" . $maxcelsius . "℃";
			echo "</p></div>";
		}
	} else {
		echo "<p>ネットにうまく繋がってないかも……</p>";
	}

?>
	</div>
</div>