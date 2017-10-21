<?php
namespace chat\chat;

require 'public/vendor/autoload.php';

use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use Hybridauth\Exception\HttpRequestFailedException;
// 야후 주가 데이터 PHP API

use Scheb\YahooFinanceApi\ApiClient;
use Scheb\YahooFinanceApi\ApiClientFactory;
use GuzzleHttp\Client;

class Chat
{
  public function handleHello($bot)
  {
	$bot->reply("hello Sir !");
  }
  public function handleKorHello($bot)
  {
  	$attachment = new Image('https://images.vexels.com/media/users/3/137290/isolated/lists/5124c244de26b681949b5c6d6b8cc1e2-hand-hello-gesture-fingers.png',
  			['custom_payload' => true,]);

  	$message = OutgoingMessage::create('즐거운 겨울맞이 축제 보내세요 !')->withAttachment($attachment);

  	$bot->reply($message);
  }
  public function handleStockData($bot)
  {
  	$client = ApiClientFactory::createApiClient();

	$historicalData = $client->getHistoricalData("KOSPI.KS", ApiClient::INTERVAL_1_DAY, new \DateTime("-1 days"), new \DateTime("today"));
	$KOSPI = "";
	foreach ($historicalData as $key => $value)
	{
	  $KOSPI = $value->getClose();
	}
	
	$historicalData = $client->getHistoricalData("^KOSDAQ", ApiClient::INTERVAL_1_DAY, new \DateTime("-1 days"), new \DateTime("today"));
	$KOSDAQ = "";
	foreach ($historicalData as $key => $value)
	{
	  $KOSDAQ = $value->getClose();
	}
	
	$bot->reply("<br />코스피 : $KOSPI<br />코스닥 : $KOSDAQ 입니다.");
  }
}