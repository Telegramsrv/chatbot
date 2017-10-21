<?php
require 'public/vendor/autoload.php';
require 'application/libs/Chat.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Web\WebDriver;

class ChatApp extends Controller
{
	public function index()
	{
		require 'application/views/_template/header.php';
		require 'application/views/ChatApp/index.php';
		require 'application/views/_template/footer.php';
	}
	public function message()
	{
		$config = [];
		DriverManager::loadDriver(WebDriver::class);
		$botman = BotManFactory::create($config);
		
		$botman->hears('hello', 'chat\chat\Chat@handleHello');
		$botman->hears('안녕', 'chat\chat\Chat@handleKorHello');
		$botman->hears('^.*증시.*', 'chat\chat\Chat@handleStockData');
		
		$botman->listen();
	}
}