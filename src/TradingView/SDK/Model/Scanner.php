<?php

namespace TradingView\SDK\Model;

class Scanner extends AbstractFilter
{
	protected $columns = ['name','close|1','volume|1','market_cap_calc','total_value_traded','ROC|1','Volatility.D','change|1','change_abs|1','Aroon.Up|1','Aroon.Down|1','RSI7|1','ADX|1','volume|5','ROC|5','change|5','change_abs|5','Aroon.Up|5','Aroon.Down|5','RSI7|5','ADX|5','volume|15','ROC|15','change|15','change_abs|15','Aroon.Up|15','Aroon.Down|15','RSI7|15','ADX|15'];
	public $container  = [];

    public function __construct(array $data = null)
    {		
		if(isset($data['data']) && !empty($data['data'])) {
			foreach($data['data'] as $item) {
				if($item['d']){
					$this->container[] = $this->escore(array_combine($this->columns, $item['d']));
				}
			}
		}
		
    }

    public function escore(array $item = null)
    {
		$escore = 0;

		if($item['volume|1'] > $item['volume|5']) {
			$escore += 10;
		}

		if($item['volume|5'] > $item['volume|15']) {
			$escore += 10;
		}

		if($item['ROC|1'] > 0.5 && $item['ROC|1'] < 5) {
			$escore += 6;
		}

		if($item['ROC|1'] > 5 && $item['ROC|1'] < 8) {
			$escore += 3;
		}

		if($item['ROC|1'] > 8) {
			$escore += 1;
		}

		if($item['ROC|5'] > 0.5 && $item['ROC|5'] < 5) {
			$escore += 1;
		}

		if($item['ROC|5'] > 5 && $item['ROC|5'] < 8) {
			$escore += 6;
		}

		if($item['ROC|5'] > 8) {
			$escore += 3;
		}

		if($item['ROC|15'] > 0.5 && $item['ROC|15'] < 5) {
			$escore += 1;
		}

		if($item['ROC|15'] > 5 && $item['ROC|15'] < 8) {
			$escore += 6;
		}

		if($item['ROC|15'] > 8) { //5
			$escore += 3;
		}
		
		/*

		if($item['Aroon.Up|1'] > 50) {
			$escore += 4;
		}

		if($item['Aroon.Up|1'] > 75) {
			$escore += 4;
		}

		if($item['Aroon.Up|1'] > 20) {
			$escore += 2;
		}
		*/
		
		if($item['Aroon.Up|5'] > 20) {
			$escore += 2;
		}

		if($item['Aroon.Up|5'] > 50) {
			$escore += 4;
		}

		if($item['Aroon.Up|5'] > 75) {
			$escore += 4;
		}

		if($item['Aroon.Up|15'] > 20) {
			$escore += 2;
		}

		if($item['Aroon.Up|15'] > 50) {
			$escore += 4;
		}

		if($item['Aroon.Up|15'] > 75) {
			$escore += 4;
		}

		if($item['Aroon.Down|1'] < 30) {
			$escore += 4;
		}

		if($item['Aroon.Down|1'] < 75) {
			$escore += 6;
		}

		if($item['Aroon.Down|5'] < 30) {
			$escore += 4;
		}

		if($item['Aroon.Down|5'] < 75) {
			$escore += 6;
		}
		
		if($item['Aroon.Down|15'] < 30) {
			$escore += 4;
		}

		if($item['Aroon.Down|15'] < 75) {
			$escore += 6;
		}

		if($item['RSI7|1'] < 30) {
			$escore += 6;
		}

		if($item['RSI7|1'] > 30 && $item['RSI7|1'] < 50) {
			$escore += 3;
		}

		if($item['RSI7|1'] > 50 && $item['RSI7|5'] < 75) {
			$escore += 1;
		}
		
		if($item['RSI7|5'] < 30) {
			$escore += 5;
		}

		if($item['RSI7|5'] < 50) {
			$escore += 4;
		}

		if($item['RSI7|5'] > 50 && $item['RSI7|5'] < 75) {
			$escore += 1;
		}
		
		if($item['RSI7|15'] < 30) {
			$escore += 5;
		}

		if($item['RSI7|15'] < 50) {
			$escore += 4;
		}

		if($item['RSI7|15'] > 50 && $item['RSI7|15'] < 75) {
			$escore += 1;
		}
		
		if($item['change|1'] > 0.2) {
			$escore += 1;
		}

		if($item['change|1'] > 0.5) {
			$escore += 2;
		}

		if($item['change|1'] > 0.75) {
			$escore += 2;
		}
		
		if($item['change|1'] > 1) {
			$escore += 2;
		}

		if($item['change|1'] > 1.5) {
			$escore += 1;
		}		
		if($item['change|5'] > 0.1) {
			$escore += 2;
		}

		if($item['change|5'] > 0.2) {
			$escore += 2;
		}

		if($item['change|5'] > 0.3) {
			$escore += 2;
		}
		
		if($item['change|5'] > 0.4) {
			$escore += 2;
		}

		if($item['change|5'] > 0.5) {
			$escore += 2;
		}
		
		if($item['change|15'] > 0.1) {
			$escore += 2;
		}

		if($item['change|15'] > 0.2) {
			$escore += 2;
		}

		if($item['change|15'] > 0.3) {
			$escore += 2;
		}
		
		if($item['change|15'] > 0.4) {
			$escore += 2;
		}

		if($item['change|15'] > 0.5) {
			$escore += 2;
		}

		if($item['ADX|1'] > 20) {
			$escore += 4;
		}

		if($item['ADX|1'] > 25) {
			$escore += 6;
		}

		if($item['ADX|5'] > 20) {
			$escore += 4;
		}

		if($item['ADX|5'] > 25) {
			$escore += 6;
		}

		if($item['ADX|15'] > 20) {
			$escore += 4;
		}

		if($item['ADX|15'] > 25) {
			$escore += 6;
		}

		if($item['Volatility.D'] > 0.5 && 'Volatility.D' < 5) {
			$escore += 6;
		}

		if($item['Volatility.D'] > 5 && 'Volatility.D' < 8) {
			$escore += 4;
		}
		
		$item['escore'] = $escore;
		
		return $item;

    }
}
