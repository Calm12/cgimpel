<?php

	class Date{

		public static function convertDate($datetime){
			return self::rus_date(('j M Y в G:i'), strtotime($datetime));
		}

		private function rus_date(){
			$translate = array(
				"am" => "дп",
				"pm" => "пп",
				"AM" => "ДП",
				"PM" => "ПП",
				"Monday" => "Понедельник",
				"Mon" => "Пн",
				"Tuesday" => "Вторник",
				"Tue" => "Вт",
				"Wednesday" => "Среда",
				"Wed" => "Ср",
				"Thursday" => "Четверг",
				"Thu" => "Чт",
				"Friday" => "Пятница",
				"Fri" => "Пт",
				"Saturday" => "Суббота",
				"Sat" => "Сб",
				"Sunday" => "Воскресенье",
				"Sun" => "Вс",
				"January" => "января",
				"Jan" => "янв",
				"February" => "февраля",
				"Feb" => "фев",
				"March" => "марта",
				"Mar" => "мар",
				"April" => "апреля",
				"Apr" => "апр",
				"May" => "мая",
				"June" => "июня",
				"Jun" => "июн",
				"July" => "июля",
				"Jul" => "июл",
				"August" => "августа",
				"Aug" => "авг",
				"September" => "сентября",
				"Sep" => "сен",
				"October" => "октября",
				"Oct" => "окт",
				"November" => "ноября",
				"Nov" => "ноя",
				"December" => "декабря",
				"Dec" => "дек",
				"st" => "ое",
				"nd" => "ое",
				"rd" => "е",
				"th" => "ое",
			);

			if(func_num_args() > 1){
				$timestamp = func_get_arg(1);
				return strtr(date(func_get_arg(0), $timestamp), $translate);
			}
			else{
				return strtr(date(func_get_arg(0)), $translate);
			}
		}

	}