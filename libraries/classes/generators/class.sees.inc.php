<?php
namespace generators;

//admin->sees(index, features[])

/**
 * Purpose: Auto HTML Tempalte genration with the URL Links pre-defined
 */
/*
$sees = new sees();
$sees->logo("/index");
#$sees->page("/index", "Home", array("Dashboard", "Reports", "Attendance", "Performance"));
$sees->page("/reports", "Reports", array("daily", "weekly", "monthly", "annually", "all"));
$sees->page("/attendance", "Attendance", array("Missing", "Late", "Early", "On Leave"));
$sees->page("/performance", "Performance", array("Excellent", "Satisfactory", "Poor"));
$sees->index();
echo $sees->get("/index");
print_r($sees);
*/
class sees
{
	public $logo;
	public $pages = array();

	public function logo(string $index)
	{
		$this->logo = $logo;
	}
	
	public function page(string $page, string $title, array $links)
	{
		// get template
		// replace
		if(!isset($this->pages[$page]))
		{
			$this->pages[$page] = array();
		}
		
		$this->pages[$page] = array_merge($this->pages[$page], array_values($links));
	}
	
	public function index()
	{
		$this->index = array();
		foreach($this->pages as $index => $page)
		{
			$this->index[] = $index;
		}
	}
	
	public function get(string $index): string
	{
		return "";
	}
	
	private function _link($object)
	{
		#print_r($object);
		#$html = "<a href='#'>{$object}</a>";
		#return $html;
		
		return "";
	}
	
	private function _html()
	{
		$dashboard = array_map(array($this, "_link"), $this->pages);
		return implode("\r\n", $dashboard);
	}
	
	public function __ToString(): string
	{
		# Convert to HTML
		$html = $this->_html();
		return "###";
	}
}