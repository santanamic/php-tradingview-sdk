<?php

namespace TradingView;

use  TradingView\SDK\Requests\Scanner\Crypto;

require_once('../vendor/autoload.php');

try {
    $crypto = (new Crypto)->run();
	//var_dump( $crypto->filter( [ 'name' => ['>=', 45],'ROC|1' => ['>=', 45], 'Aroon.Up|1' => ['>=', 45] ] ) );
	//var_dump( $crypto->filter( [ 'ROC|1' => ['>=', 0.5], 'ROC|5' => ['>=', 0], 'ROC|15' => ['>=', 3], 'Aroon.Down|1' => ['<=', 50], 'RSI7|1' => ['<=', 75], 'ADX|1' => ['>=', 20], 'ADX|5' => ['>=', 17], 'ADX|15' => ['>=', 15], 'Volatility.D' => ['>=', 1] ] ) );
	//var_dump( $crypto->filter( [ 'ROC|1' => ['>=', 45], 'Aroon.Down|1' => ['<=', 50], 'Aroon.Down|5' => ['<=', 30], 'RSI7|1' => ['<=', 75], 'ADX|1' => ['>=', 25], 'ADX|5' => ['>=', 25] ] ) );
	//var_dump( $crypto->filter( [ 'name' => 'DOGEUSDT' ] ) );
	//var_dump( $crypto->filter( [ 'name' => ['LIKE', '%USDT'], 'ROC|1' => ['>=', 0.5], 'Aroon.Up|1' => ['>=', 50], 'RSI7|1' => ['<=', 75], 'ADX|1' => ['>=', 20], 'Volatility.D' => ['>=', 1], 'volume|1' => ['>=', '$volume|5'] ] ) );

	//bom mas tem que ajustar a identificação de quedas $array = $crypto->filter( [ 'name' => ['LIKE', '%USDT'] ] );
	//$array = $crypto->filter( [ 'name' => ['LIKE', '%USDT'], 'escore' => ['>=', 100], 'ROC|1' => ['>=', 0.5], 'Aroon.Down|1' => ['<=', 50], 'RSI7|1' => ['<=', 75], 'ADX|1' => ['>=', 20], 'ADX|5' => ['>=', 17], 'ADX|15' => ['>=', 15], 'Volatility.D' => ['>=', 1], 'volume|1' => ['>=', '$volume|5'] ] );
	$array = $crypto->filter( [ 'name' => ['LIKE', '%USDT'], 'escore' => ['>=', 100], 'ROC|1' => ['>=', -1], 'Aroon.Down|1' => ['<=', 75], 'RSI7|5' => ['<=', 95], 'ADX|1' => ['>=', 20], 'ADX|5' => ['>=', 17], 'ADX|15' => ['>=', 15], 'Volatility.D' => ['>=', 1], 'change|1' => ['>=', -0.25] ] );
	if(!empty($array))
		$array = $crypto->filter( [ 'name' => ['NOT LIKE', '%DOWN%'] ], $array );
	if(!empty($array))
		$array = $crypto->filter( [ 'name' => ['NOT LIKE', '%UP%'] ], $array );
	if(!empty($array2))
		$array = $crypto->filter( [ 'name' => ['NOT LIKE', '%_PREMIUM%'] ], $array );
	
	usort($array, function($a, $b) {
		return $a['escore'] < $b['escore'];
	});
	
	var_dump($array);
	
	//var_dump( $crypto->filter( [ 'name' => ['LIKE', '%USDT'], 'ROC|1' => ['>=', 0.5], 'Aroon.Down|1' => ['<=', 50], 'RSI7|1' => ['<=', 75], 'ADX|1' => ['>=', 20], 'ADX|5' => ['>=', 17], 'ADX|15' => ['>=', 15], 'Volatility.D' => ['>=', 1], 'volume|1' => ['>=', '$volume|5'] ] ) );

} catch (Exception $e) {
    var_dump($e);
    echo 'Exception when calling Bank crypto->run: ', $e->getMessage(), PHP_EOL;
}
