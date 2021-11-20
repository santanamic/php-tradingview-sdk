<?php

namespace TradingView\SDK\Requests\Scanner;

use TradingView\SDK\Requests\AbstractRequest;

class Crypto extends AbstractRequest
{
    public function run()
    {
        $url = 'https://scanner.tradingview.com/crypto/scan';

        parent::getClient()->getConfig()->setHost($url);
        parent::setMethod('POST');
        parent::setHttpBody('{"filter":[{"left":"ADX|1","operation":"nempty"},{"left":"exchange","operation":"equal","right":"BINANCE"}],"options":{"lang":"pt"},"symbols":{"query":{"types":[]},"tickers":[]},"columns":["name","close|1","volume|1","market_cap_calc","total_value_traded","ROC|1","Volatility.D","change|1","change_abs|1","Aroon.Up|1","Aroon.Down|1","RSI7|1","ADX|1","volume|5","ROC|5","change|5","change_abs|5","Aroon.Up|5","Aroon.Down|5","RSI7|5","ADX|5","volume|15","ROC|15","change|15","change_abs|15","Aroon.Up|15","Aroon.Down|15","RSI7|15","ADX|15"],"sort":{"sortBy":"ADX|1","sortOrder":"desc"},"range":[0,2500]}');
        parent::addHeaderParams(['Content-Type' => 'application/json; charset=utf-8']);
        parent::setTypeResponse('TradingView\SDK\Model\Scanner');

        return parent::sendRequest();
    }
}