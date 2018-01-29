<?php 

namespace SqlFire;

class Helper
{
    public function dropdown($options,$value)
    {
		$html = array();
        foreach($options as $key => $val){
			$selected = "";
			if($key == $value){
				$selected = " selected ";
			}
			$html[] = "<option $selected value=\"$key\">$val</option>";
		}
		return join($html);
    }
	
	function years($year = ""){
		if(empty($year)) $year = date("Y");
		$starting_year  =date('Y', strtotime('-5 year'));
		$ending_year = date('Y', strtotime('+10 year'));
		$html = array();
		for($starting_year; $starting_year <= $ending_year; $starting_year++) {
			$selected = "";
			if($starting_year == $year){
				$selected = " selected ";
			}
			$html[] = "<option $selected value=\"$starting_year\">$starting_year</option>";
		}
		return join($html);
	}
	
	function months($selctedMonth = ""){
		if(empty($selctedMonth)) $selctedMonth = date("m");
		
		$formattedMonthArray = array(
			"1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April",
			"5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus",
			"9" => "September", "10" => "Oktober", "11" => "Nopember", "12" => "Desember",
		);
		$months = array();
		foreach($formattedMonthArray as $key => $month){
			$selected = "";
			if($selctedMonth == $key){
				$selected = " selected ";
			}
			$months[] = "<option $selected value=\"$key\">$month</option>";
		}  
		
		return join($months);
	}
}