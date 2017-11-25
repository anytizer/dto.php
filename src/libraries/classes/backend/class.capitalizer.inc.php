<?php
namespace backend;

class capitalizer
{
	private $capitalizable_words = array();
	
	public function __construct()
	{
		$csv = dirname(__FILE__)."/words.csv";
		$this->capitalizable_words = file($csv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		
		// optional
		$this->capitalizable_words = array_map("strtolower", $this->capitalizable_words);
	}
	
	public function capitalize(string $input): string
	{
		$words = preg_split("/[\_|\ ]/is", $input);
		foreach($words as $w => $word)
		{
			if(in_array(strtolower($word), $this->capitalizable_words))
			{
				$words[$w] = strtoupper($word);
			}
			else
			{
				$words[$w] = ucfirst($word);
			}
		}
		
		return implode(" ", $words);
	}
}