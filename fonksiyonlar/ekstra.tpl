 <?php	
    $fortresstime=array();
   $specialtime=array();
   $roctime=array();
   $medusatime=array();
   $selkistime=array();
   $anubistime=array();
   $sethtime=array();
   $ctftime=array();
   $barandomtime=array();
   $bapartymtime=array();
   $baguildtime=array();
   $bajobtime=array();
   $fortresstime2=array();
   $specialtime2=array();
   $roctime2=array();
   $medusatime2=array();
   $selkistime2=array();
   $anubistime2=array();
   $sethtime2=array();
   $ctftime2=array();
   $barandomtime2=array();
   $bapartymtime2=array();
   $baguildtime2=array();
   $bajobtime2=array();  
 $ara = time();
 


?>	
 <?php	
    function get_day_name($num)
    {
        $day = null;
        switch($num)
        {
            default:
            case 1:
                $day = "Sunday";
                break;
            case 2:
                $day = "Monday";
                break;
            case 3:
                $day = "Tuesday";
                break;
            case 4:
                $day = "Wednesday";
                break;
            case 5:
                $day = "Thursday";
                break;
            case 6:
                $day = "Friday";
                break;
            case 7:
                $day = "Saturday";
                break;
        }

        return $day;
    }

?>	
<?php
        $schedule = [];
        $schedule["SIEGE_WAR"] = array(
            "type" => 6,
            "time" => "fortresstime",
			"icon" => "fa fa-shield",
			"time2" => "fortresstime2",
            "name" => "Fortress War",
            "tag" => "fortress_war",
        );
        $schedule["MEDUSA"] = array(
            "type" => 2,
            "time" => "medusatime",
			"icon" => "fa fa-cube",
			"time2" => "medusatime2",
            "name" => "Medusa",
            "tag" => "medusa",
        );
        $schedule["ROC"] = array(
            "type" => 1,
            "time" => "roctime",
			"icon" => "fa fa-cube",
			"time2" => "roctime2",
            "name" => "Roc",
            "tag" => "roc",
        );		
        $schedule["SPECIAL_GOODS"] = array(
            "type" => 3,
            "time" => "specialtime",
			"icon" => "fa fa-cube",
			"time2" => "specialtime2",
            "name" => "Special Goods",
            "tag" => "special_goods",
        );		
        $schedule["EGYPT_SN"] = array(
            "type" => 9,
            "time" => "selkistime",
			"icon" => "fa fa-cube",
			"time2" => "selkistime2",
            "name" => "Selkis/Neith",
            "tag" => "selkis_neith",
        );
        $schedule["EGYPT_AI"] = array(
            "type" => 10,
            "time" => "anubistime",
			"icon" => "fa fa-cube",
			"time2" => "anubistime2",
            "name" => "Anubis/Isis",
            "tag" => "anubis_isis",
        );
        $schedule["EGYPT_HS"] = array(
            "type" => 11,
            "time" => "sethtime",
			"icon" => "fa fa-cube",
			"time2" => "sethtime2",
            "name" => "Haroeris/Seth",
            "tag" => "haroeris_seth",
        );
        $schedule["CTF"] = array(
            "type" => 12,
            "time" => "ctftime",
			"icon" => "fa fa-flag",
			"time2" => "ctftime2",
            "name" => "Capture Flag",
            "tag" => "capturetheflag",
        );
        
        $schedule["BA_RANDOM"] = array(
            "type" => 16,
            "time" => "barandomtime",
			"icon" => "fa fa-trophy",
			"time2" => "barandomtime2",
            "name" => "B.A. (Random)",
            "tag" => "ba_random",
        );
        
        $schedule["BA_PARTY"] = array(
            "type" => 18,
            "time" => "bapartymtime",
			"icon" => "fa fa-trophy",
			"time2" => "bapartymtime2",
            "name" => "B.A. (Party)",
            "tag" => "ba_party",
        );
        $schedule["BA_GUILD"] = array(
            "type" => 20,
            "time" => "baguildtime",
			"icon" => "fa fa-trophy",
			"time2" => "baguildtime2",
            "name" => "B.A. (Guild)",
            "tag" => "ba_guild",
        );
        $schedule["BA_JOB"] = array(
            "type" => 22,
            "time" => "bajobtime",
			"icon" => "fa fa-trophy",
			"time2" => "bajobtime2",
            "name" => "B.A. (Job)",
            "tag" => "ba_job",
        );
?> 
<?php 
$data25 .= <<<EOT
                                            <tr>
                    <td><span style="font-weight: bold">Sunucu Saati</span></td>
                    <td><span id="cur_time">00:00:00</span></td>
                </tr>
EOT;
$data23 .= <<<EOT

				<script>

EOT;
$zaman=date('Y-m-d H:i:s');
$data2 .= <<<EOT
						<script>
						var iTimeStamp = "{$ara}" - Math.round(+new Date() / 1000);
                                 var ServerTime = new Date('{$zaman}');
        window.setInterval('serverTime()', 999);
		</script>
EOT;
echo $data2;
$data3 .= <<<EOT

			</script>
EOT;
?>
 <?php $dosyaAdi = "takvim.txt";
$cache = "cache/".$dosyaAdi;
$sure = 300;

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start(); 
		?>
  <?php $aliance =  $users->link->db_conn_shard->query("SELECT * from _Schedule where ScheduleDefineIdx in(1,2,3,6,9,10,11,12,16,18,20,22) order by ScheduleDefineIdx asc");
   $rank=1; $rank1=1; $rank2=1;

foreach($aliance as $row){
if($row['SubInterval_StartTimeHour']==0){ $time='00'; }else{ $time=$row['SubInterval_StartTimeHour']; };
$time2=$row['SubInterval_StartTimeMinute'];
 if($row["MainInterval_Type"] == 1 && $row["MainInterval_TypeDate"] == 1) {
  $date = ''.date('Y').'-'.date('m').'-'.date('d').' '.$time.':'.$time2.':00';              
 }
else if($row["MainInterval_Type"] == 3 && $row["MainInterval_TypeDate"] == 1) {
 $datey = date('d', strtotime(get_day_name($row['SubInterval_DayOfWeek'])));			
 $date = ''.date('Y').'-'.date('m').'-'.$datey.' '.$time.':'.$time2.':00';
 }
$timestamp = strtotime($date);

if($row['ScheduleDefineIdx'] == 6){
	$fortresstime[]="".$timestamp."";
	$fortresstime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 3){
	$specialtime[]="".$timestamp."";
	$specialtime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 1){
	$roctime[]="".$timestamp."";
	$roctime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 2){
	$medusatime[]="".$timestamp."";
	$medusatime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 9){
	$selkistime[]="".$timestamp."";
	$selkistime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 10){
	$anubistime[]="".$timestamp."";
	$anubistime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 11){
	$sethtime[]="".$timestamp."";
	$sethtime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 12){
	$ctftime[]="".$timestamp."";
	$ctftime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 16){
	$barandomtime[]="".$timestamp."";
	$barandomtime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 18){
	$bapartymtime[]="".$timestamp."";
	$bapartymtime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 20){
	$baguildtime[]="".$timestamp."";
	$baguildtime2[]="".$row['SubInterval_DurationSecond']."";
}
if($row['ScheduleDefineIdx'] == 22){
	$bajobtime[]="".$timestamp."";
	$bajobtime2[]="".$row['SubInterval_DurationSecond']."";
}
}
   function closest($number,$array,$type,$time) {
	   
if($type == 3){
$daysas = $time[0]-1800;
}else if($type == 6){
$daysas = $time[0]-1800;
}else if($type == 10){
$daysas = $time[0]-1800;
}else if($type == 11){
$daysas = $time[0]-1800;
}else if($type == 9){
$daysas = $time[0]-1800;
}else{
$daysas = $time[0];
}
 
        sort($array);
        foreach ($array as $a) {
            if ($a >= $number-$daysas) return $a;
        }
      
	   return end($array);
    }

?>
  <?php 
foreach($schedule as $key => $_schedule) {
	$hello=$schedule[$key]["time"];
	$hello2=$schedule[$key]["time2"];
	$func = closest($ara, $$hello,$schedule[$key]["type"],$$hello2);
	$test= $$schedule[$key]["time2"];
	if(!empty($func)){
	if($schedule[$key]["type"] == 3){
$daysas = $func + $test[0] - 1800 > time();
}else if($schedule[$key]["type"] == 6){
$daysas = $func + $test[0] - 1800 > time();
}else if($schedule[$key]["type"] == 10){
$daysas = $func + $test[0] - 1800 > time();
}else if($schedule[$key]["type"] == 11){
$daysas = $func + $test[0] - 1800 > time();
}else if($schedule[$key]["type"] == 9){
$daysas = $func + $test[0] - 1800 > time();
}else{
$daysas = $func + $test[0] > time();
}
if($daysas){
	$data .= <<<EOT
 <tr>
    <td><span style="font-weight: bold">{$schedule[$key]["name"]}</span></td>
    <td><span id="{$schedule[$key]["tag"]}">00:00:00</span></td>
 </tr> 	

EOT;
}
} 
} 

foreach($schedule as $key => $_schedule) {
	$hello=$schedule[$key]["time"];
	$hello2=$schedule[$key]["time2"];
	$func = closest($ara, $$hello,$schedule[$key]["type"],$$hello2);
	$test= $$schedule[$key]["time2"];
	if(!empty($func)){
	if($schedule[$key]["type"] == 3){
$daysas = $func + $test[0] - 1800 > time();
}else if($schedule[$key]["type"] == 6){
$daysas = $func + $test[0] - 1800 > time();
}else if($schedule[$key]["type"] == 10){
$daysas = $func + $test[0] - 1800 > time();
}else if($schedule[$key]["type"] == 11){
$daysas = $func + $test[0] - 1800 > time();
}else if($schedule[$key]["type"] == 9){
$daysas = $func + $test[0] - 1800 > time();
}else{
$daysas = $func + $test[0] > time();
}
if($daysas){

	$data4 .= <<<EOT
				tTimer(iTimeStamp, "{$func}", "{$schedule[$key]["tag"]}");
        window.setInterval('tTimer(iTimeStamp,"{$func}","{$schedule[$key]["tag"]}")', 250);
EOT;
		}
		}
}
echo $data25;
echo $data;
echo $data23;
echo $data4;
echo $data3;

?>
     <?php 		
$ac = fopen($cache, "w+");
fwrite($ac, ob_get_contents());
fclose($ac);		
ob_end_flush();
}
?>	