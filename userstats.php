<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?>

<?php $dosyaAdi = "userstats.txt";
$cache = "cache/".$dosyaAdi;
$sure = 230;

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start(); ?>	

										<?php if($rowayar[0]['userstats'] == 1) { ?>
										    <div id="content">
        <div class="haberBoxBg">
            <div class="haberBox">
                <h3 id="ranking-title" style="margin-top: 10px; font-size: 14px"><?= $dils['userstats']; ?></h3>
                                                                <div id="lineChart" style="height:400px"></div>
                    <br>
						<br>
                        <div id="rank-result" class="ranking-tables">
                                              <table>
                                <tbody>
                                <tr>
                                    <td width="30">Sıra</td>
                                    <td width="150">İsim</td>
                                    <td width="180"><?= $dils['userstats3']; ?></td>
                                    <td width="180"><?= $dils['userstats4']; ?></td>
                                </tr>
                              
                               

								<?PHP 
		$usersa = $users->link->db_conn_pann->query("select top 50 * from _OnlineOffline where Status = 'Online' order by Minutes desc ");

		$rank2 = 1;
		  foreach($usersa as $row){
			  $ranks2 = $rank2++;
		if($ranks2 == 1){ $sıra2 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks2 == 2){ $sıra2 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks2 == 3){ $sıra2 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra2 = ''.$ranks2.''; }
		if($row['GuildName'] == dummy){ $guild = '<a id="dumb-button"  onclick="return false;"><font color="darkgray">&lt;Guildsiz&gt;</font></a>'; }else{ $guild = $row['GuildName']; }
		  ?>

                                      <tr>
                                        <td><?= $sıra2 ?></td>
                                        <td>
                                            <b><a href="charinfo.php?q=<?php echo $row['CharID']; ?>"><?php echo $row['Charname']; ?></a></b>
                                        </td>
                                        <td><?php echo $row['mOnline']; ?></td>
                                        <td><?php echo $row['Minutes']; ?> Dakika</td>
                                    </tr>

		  <?php } ?>
                                                                </tbody>
                            </table>
                        </div>
						                        <script type="text/javascript">
                            var chartData = {
                                 labels: [<?PHP 
		$blogg = $users->link->db_conn_account->prepare(" SELECT 
      CONVERT(VARCHAR(5), dLogDate, 108) AS [time],
      nUserCount  AS [count]
    FROM SRO_VT_ACCOUNT.dbo._ShardCurrentUser
    WHERE CONVERT(VARCHAR(10), dLogDate, 104) = CONVERT(VARCHAR(10), GETDATE(), 104)
    ORDER BY [time]
  ");
		
		$blogg -> execute();
		$rank = 0;
		  foreach($blogg as $row){
		  ?>'<?php echo $row['time'] ?>',<?php } ?>],
                                counts: [<?PHP 
		$blogg = $users->link->db_conn_account->prepare("
 SELECT 
      CONVERT(VARCHAR(5), dLogDate, 108) AS [time],
      nUserCount AS [count]
    FROM SRO_VT_ACCOUNT.dbo._ShardCurrentUser
    WHERE CONVERT(VARCHAR(10), dLogDate, 104) = CONVERT(VARCHAR(10), GETDATE(), 104)
    ORDER BY [time]
");
		
		$blogg -> execute();
		
		  foreach($blogg as $row){
		  ?> [<?php echo $rank++; ?>,<?php echo $row['count'] + $rowayar[0]['fake']; ?>],<?php } ?>]};

                            jQuery(document).ready(function () {
                                jQuery.plot("#lineChart", [
                                    {data: chartData.counts}
                                ], {
                                    colors: ["##d50603"],
                                    series: {
                                        lines: {show: true},
                                        // points: {show: true<
                                    },
                                    grid: {
                                        hoverable: true,
                                        clickable: true,
                                        borderWidth: {
                                            top: 1,
                                            right: 1,
                                            bottom: 1,
                                            left: 1
                                        },
                                        color: "##d50603"
                                    },
                                    xaxis: {
                                        tickFormatter: function (x) {
                                            return chartData.labels[x];
                                        }
                                    },
                                    yaxis: {
                                        axisMargin: 10,
                                        tickDecimals: 0
                                    },
                                    shadowSize: 1,
                                    tooltip: {
                                        show: true,
                                        content: "<span class='text-danger'><?= $dils['userstats1']; ?> %x - %y <?= $dils['userstats2']; ?></span>"
                                    }
                                });
                            });
                        </script>
						
                        <script type="text/javascript" src="media/javascripts/jquery.flot.min.js"></script>
                        <script src="media/javascripts/jquery.flot.resize.min.js"></script>
                        <script src="media/javascripts/jquery.flot.tooltip.min.js"></script>
													<?php }else{
										echo '<div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3>'.$dils['userstats'].'</h3>
<br>
<div style="text-align: center">
<img src="media/images/error.png" alt />
<br><br>
<div class="bilgiilk hatu">
<br>
<font color="red" size="4px">'.$dils['userstats_1'].'</font>
</div>
</div>
</div>
</div>
</div>';
							} ?>
                                   
									
 <?php
			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}

?>  
</div>
</div>
</div>
</div>                               
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>