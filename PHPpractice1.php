<?php

$date = date('y-m-d',time());
$tar = "2017/05/24";
$year = "Array ([0]=>2012 [1]=>396 [2]=>300 [3]=>2000 [4]=>1100 [5]=>1089)";


echo "The value of $date: ". '<br />';
echo "The value of $tar: " . '<br />';
echo "The value of $year: " . '<br />';

$date =str_replace('-','/',"2018/05/22");

//#2
echo "2.$date with - replaced with/" . $date1 .'<br />';

$difer= $date - $tar;

if ($difer > 0){
	$difer2 = "The Future";
}
elseif ($difer < 0){
	$difer2 = "The Past";
}
else {
	$difer2 ="Opps";
}
//#3
echo "3.$date compared to $tar:" . $difer2 .'<br />';
//#4
for ($i=0; $i<=10; $i++) {
	if ($date[$i]== "/")
	{
	$date_in .= $i. ' ';
	}
}
 echo'4) Positions of "/" in $date:'. $date_in .'<br />'; 

//#5
$newdate =str_replace(' ','/',"2018/05/22");
$newdate2 =substr_count($newdate,' ');
$newdate3= $newdate2++;
echo "5.Number of Words in $date: ". $newdate3. '<br />';

//6
echo "6.Length of $date String: " . strlen($date) .'<br />';
//7
echo "7.ASCII value of first char in $date string: ".ord($date[0]). '<br />';
//8
echo "8. ".substr($date,-2,strlen($date)).'<br />';
//9
$new_data="2018/05/22";
echo "9. Date Array: ".'<br />';
$date_array = explode("/", $new_data);
print_r($date_array);

//10
echo "<br /> Foreach and if statements <br />";
foreach ($year as $value) {
	$str_value = "value";
	$int_value = intval($str_value);
	echo $int_value;
	if ($int_value % 4 == 0){
		echo ': True | ';
	} else {
		echo ': False | ';
	}

}
echo '<br />Switch and foreach statements<br />';
foreach ($year as $value){
	$str_value = "value";
	$int_value = intval($str_value);
	$switch_var = $int_value %4;
	switch($switch_var) {
		case 0:
			echo $int_value . ':'. ' True '. '|'. ' ';
			break;
		case 1;
			echo $int_value . ':'. ' False '. '|'. ' ';
			break;
	}
}
?>