<?php

namespace app\commands;

use yii\console\Controller;

class TestController extends Controller
{
	public function actionGetBirthday()
	{
		$day = self::actionPromptCustom("Введите день вашего рождения: ");
		$month = self::actionPromptCustom("Введите месяц вашего рождения: ");
		$year = self::actionPromptCustom("Введите год вашего рождения: ");
		
		echo "Вы родились: $day/$month/$year\n";
	}
	
	public function actionGetDayWeek()
	{
		$day = self::actionPromptCustom("Введите день: ");
		$month = self::actionPromptCustom("Введите месяц: ");
		$year = self::actionPromptCustom("Введите год: ");
		
		// Создаем объект DateTime с заданной датой
		$date = \DateTime::createFromFormat('j-n-Y', "$day-$month-$year");
		
		// Проверяем, что дата создана корректно
		if ($date === false) {
			echo "Некорректная дата\n";
		}
		
		// Получаем номер дня недели (0 для воскресенья, 6 для субботы)
		$dayOfWeekNumber = $date->format('w');
		
		// Массив с названиями дней недели
		$daysOfWeek = [
			'Воскресенье',
			'Понедельник',
			'Вторник',
			'Среда',
			'Четверг',
			'Пятница',
			'Суббота',
		];
		
		// Возвращаем название дня недели
		echo "День недели: $daysOfWeek[$dayOfWeekNumber]\n";
	}
	
	public function actionIsLeapYear() {
		$year = self::actionPromptCustom("Введите год: ");
		
		// Год является високосным, если он делится на 4, но не делится на 100,
		// за исключением годов, которые делятся на 400.
		if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
			echo "$year год является високосным\n";
		} else {
			echo "$year год не является високосным\n";
		}
	}
	
	public function actionGetUserAge() {
		$day = self::actionPromptCustom("Введите день: ");
		$month = self::actionPromptCustom("Введите месяц: ");
		$year = self::actionPromptCustom("Введите год: ");
		
		// Получаем текущую дату
		$currentDate = new \DateTime();
		
		// Создаем объект даты рождения
		$birthDate = \DateTime::createFromFormat('j-n-Y', "$day-$month-$year");
		
		// Проверяем, что дата создана корректно
		if ($birthDate === false) {
			return "Некорректная дата";
		}
		
		// Вычисляем разницу между текущей датой и датой рождения
		$age = $currentDate->diff($birthDate)->y;
		
		echo "Вам $age лет\n";
	}

	public function actionShowTerminalDate() {
		$day = self::actionPromptCustom("Введите день: ");
		$month = self::actionPromptCustom("Введите месяц: ");
		$year = self::actionPromptCustom("Введите год: ");
		
		$date = sprintf("%02d %02d %04d", $day, $month, $year);
		
		$lines = ["", "", "", "", ""];
		
		// Преобразуем строку в массив символов
		$chars = str_split($date);
		
		foreach ($chars as $char) {
			if ($char === ' ') {
				for ($i = 0; $i < 5; $i++) {
					$lines[$i] .= "   ";
				}
			} else {
				$digitPatterns = self::actionDigitToStars((int)$char);
				for ($i = 0; $i < 5; $i++) {
					$lines[$i] .= $digitPatterns[$i] . " ";
				}
			}
		}
		
		// Выводим строки
		foreach ($lines as $line) {
			echo $line . PHP_EOL;
		}
	}
	
	private static function actionDigitToStars($digit) {
		$patterns = [
			0 => [
				" *** ",
				"*   *",
				"*   *",
				"*   *",
				" *** "
			],
			1 => [
				"  *  ",
				" **  ",
				"  *  ",
				"  *  ",
				" *** "
			],
			2 => [
				" *** ",
				"*   *",
				"   * ",
				"  *  ",
				"*****"
			],
			3 => [
				" *** ",
				"*   *",
				"  ** ",
				"*   *",
				" *** "
			],
			4 => [
				"   * ",
				"  ** ",
				" * * ",
				"*****",
				"   * "
			],
			5 => [
				"*****",
				"*    ",
				"**** ",
				"    *",
				"**** "
			],
			6 => [
				" *** ",
				"*    ",
				"**** ",
				"*   *",
				" *** "
			],
			7 => [
				"*****",
				"   * ",
				"  *  ",
				" *   ",
				"*    "
			],
			8 => [
				" *** ",
				"*   *",
				" *** ",
				"*   *",
				" *** "
			],
			9 => [
				" *** ",
				"*   *",
				" ****",
				"    *",
				" *** "
			]
		];
		
		return $patterns[$digit];
	}
	
	private static function actionPromptCustom($prompt): string
	{
		echo $prompt;
		$handle = fopen("php://stdin", "r");
		$line = fgets($handle);
		return trim($line);
	}
}