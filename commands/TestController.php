<?php

namespace app\commands;

use yii\console\Controller;

class TestController extends Controller
{
	public function actionPrompt()
	{
		function prompt($prompt): string
		{
			echo $prompt;
			$handle = fopen("php://stdin", "r");
			$line = fgets($handle);
			return trim($line);
		}
		
		$day = prompt("Введите день вашего рождения: ");
		$month = prompt("Введите месяц вашего рождения: ");
		$year = prompt("Введите год вашего рождения: ");
		
		echo "Вы родились: $day/$month/$year\n";
	}
}