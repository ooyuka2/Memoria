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
		$title = $json['title'];                                                    // �s�撬��
		$description = $json['description']['text'];            // �ڍ׏��
		$publicTime = $json['publicTime'];                              // �X�V����
	 
		// Location
		$city = $json['location']['city'];                              // ����
		$area = $json['location']['area'];                              // �֓�
		$prefecture = $json['location']['prefecture'];      // �����s
		$link = $json['link'];                                                      // URL
		foreach ($json['forecasts'] as $entry) {
			$dateLabel = mb_convert_encoding($entry['dateLabel'], "sjis-win", "auto");            // ���������������
			
			$telop = $entry['telop'];   
			$date = $entry['date'];                                                                                 // ���t
			$min = $entry['temperature']['min'];                                                        // �Œ�C��
			$max = $entry['temperature']['max'];                                                        // �ō��C��
			$mincelsius = $entry['temperature']['min']["celsius"];                  // �ێ�
			$minfahrenheit = $entry['temperature']['min']["fahrenheit"];        // �؎�
			$maxcelsius = $entry['temperature']['max']["celsius"];                  // �ێ�
			$maxfahrenheit = $entry['temperature']['max']["fahrenheit"];        // �؎�
			
			$image = $entry['image']["url"];                                                                // �A�C�R��
			// NULL
			if (!isset($min)) { $mincelsius = "--"; }
			if (!isset($max)) { $maxcelsius = "--"; }
			if (!isset($celsius)) { $min = "--"; }
			if (!isset($fahrenheit)) { $min = "--"; }
			
			for($i=1; $i<31; $i++) {
				if ($image == "http://weather.livedoor.com/img/icon/" . $i . ".gif") $image = $ini['dirhtml'] . "/img/weather/" . $i . ".png";
			}
			if(equal_word_str($dateLabel, "����")) echo  "<div class='col-xl-6 text-center'>" . $dateLabel . "<br><image src='".$image ."' style='max-width:80px'>";
			else echo  "<div class='col-xl-3 text-center'>" . $dateLabel . "<br><image src='".$image ."' style='max-width:50px'>";
			
			echo "<p>" . mb_convert_encoding($entry['telop'], "sjis-win", "auto") . "<br>" . $mincelsius . "�`" . $maxcelsius . "��";
			echo "</p></div>";
		}
	} else {
		echo "<p>�l�b�g�ɂ��܂��q�����ĂȂ������c�c</p>";
	}

?>
	</div>
</div>