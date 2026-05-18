<?php
session_start();
if(isset($_SESSION['loginadmin'])){
		include('../fonksiyonlar/admin.php');
			$admin = new Admin();
			include('inc/paginiation-class.php');
$pgn = new Pagenation();
			if(isset($_GET['pagekullanici'])){
 ?>	
						             <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>JID</th>
            <th>Kullanıcı Adı</th>
            <th>Email Adresi</th>
            <th>Kayıt IP</th>
            <th>GM Durumu</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>


							<?php 	
		$sayfada = 25;
		$toplam_icerik = $admin->toplam_icerik();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pagekullanici"]) ? $_GET["pagekullanici"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $admin->link->db_conn_account->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY JID asc) AS Row, * FROM tb_user) AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);
		

		  foreach($blogg as $row){
 ?>
                    <tr>
                <td><?php echo $row['Row']; ?></td>
                <td><?php echo $row['JID']; ?></td>
                <td><?php echo $row['StrUserID']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['reg_ip']; ?></td>
                <td><?php if($row['sec_primary'] == 3){ echo 'Player'; } else{ echo 'GameMaster'; } ?></td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-xs btn-info" title="Düzenle"
                                onclick="window.location.href = 'admin.php?do=useredit&jid=<?php echo $row['JID']; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
		<?php } ?>
                </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-12">
               <ul class="pagination" id="pager">
			   
<?php $pgn->Pagination($getfonk, $toplam_sayfa);?>
		  </ul>
    </div>
</div>
			<?php } ?>
			
<?php if(isset($_GET['name'])){ 
$name = anti_injection(htmlspecialchars($_GET['name']));
?>	
						             <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>JID</th>
            <th>Kullanıcı Adı</th>
            <th>Email Adresi</th>
            <th>Kayıt IP</th>
            <th>GM Durumu</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
<?php
		$player = $admin->link->db_conn_account->query("select top 25 * from tb_user WHERE StrUserID like '%' + '$name' + '%' AND JID > 0 AND StrUserID NOT LIKE '%[[]GM]%'");
$ranks = 1;

	foreach($player as $row){
	$ranks1 = $rank++;
 ?>
                     <tr>
                <td><?php echo $ranks++; ?></td>
                <td><?php echo $row['JID']; ?></td>
                <td><?php echo $row['StrUserID']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['reg_ip']; ?></td>
                <td><?php if($row['sec_primary'] == 3){ echo 'Player'; } else{ echo 'GameMaster'; } ?></td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-xs btn-info" title="Düzenle"
                                onclick="window.location.href = 'admin.php?do=useredit&jid=<?php echo $row['JID']; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
		<?php } ?>
                </tbody>
    </table>
</div>

<?php } ?>		

<?php 	if(isset($_GET['pagekarakter'])){
			?>
						             <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Karakter Adı</th>
            <th>Job Adı</th>
            <th>Irk</th>
            <th>Level</th>
            <th>İşlem</th>
        </tr>
        </thead>
        <tbody>

							<?php 	
		$sayfada = 25;
		$toplam_icerik = $admin->toplam_icerik2();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pagekarakter"]) ? $_GET["pagekarakter"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $admin->link->db_conn_shard->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY CharID asc) AS Row, * FROM _Char where not CharName16 ='d') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);
		

		  foreach($blogg as $row){
 ?>
                    <tr>
                <td><?php echo $row['Row']; ?></td>
                <td><?php echo $row['CharName16']; ?></td>
                <td><?php if(empty($row['NickName16'])){ echo 'Yok'; } else{ echo '*'.$row["NickName16"].''; } ?></td>
                <td><?php if($row['RefObjID'] <= 1932){ echo 'China'; } else{ echo 'European'; } ?></td>
                <td><?php echo $row['CurLevel']; ?></td>
	
                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-xs btn-info" title="Düzenle"
                                onclick="window.location.href = 'admin.php?do=karakteredit&charid=<?php echo $row['CharID']; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
		<?php } ?>
                </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-12">
               <ul class="pagination" id="pager">
 <?php $pgn->Pagination($getfonk, $toplam_sayfa);?>
		  </ul>
    </div>
</div>
			<?php } ?>
			<?php if(isset($_GET['name2'])){ 
$name2 = anti_injection(htmlspecialchars($_GET['name2']));
?>	
						             <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Karakter Adı</th>
            <th>Job Adı</th>
            <th>Irk</th>
            <th>Level</th>
            <th>İşlem</th>
        </tr>
        </thead>
        <tbody>
<?php
		$player = $admin->link->db_conn_shard->query("select top 25 * from _Char WHERE CharName16 like '%' + '$name2' + '%' AND CharID > 0 AND CharName16 NOT LIKE '%[[]GM]%'");
$ranks = 1;

	foreach($player as $row){
	$ranks1 = $rank++;
 ?>
                    <tr>
                <td><?php echo $ranks++; ?></td>
                <td><?php echo $row['CharName16']; ?></td>
                <td><?php if(empty($row['NickName16'])){ echo 'Yok'; } else{ echo '*'.$row["NickName16"].''; } ?></td>
                <td><?php if($row['RefObjID'] <= 1932){ echo 'China'; } else{ echo 'European'; } ?></td>
                <td><?php echo $row['CurLevel']; ?></td>

                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-xs btn-info" title="Düzenle"
                                onclick="window.location.href = 'admin.php?do=karakteredit&charid=<?php echo $row['CharID']; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>

                </td>
            </tr>
		<?php } ?>
                </tbody>
    </table>
</div>

<?php } ?>		

<?php 	if(isset($_GET['pageguild'])){
			?>
						             <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Guild</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>




							<?php 	
		$sayfada = 25;
		$toplam_icerik = $admin->toplam_icerik3();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pageguild"]) ? $_GET["pageguild"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $admin->link->db_conn_shard->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY ID asc) AS Row, * FROM _Guild where not Name = 'dummy') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);
		

		  foreach($blogg as $row){
 ?>
                    <tr>
                <td><?php echo $row['Row']; ?></td>
                <td><?php echo $row['Name']; ?></td>
 
                <td><?php echo $row['Lvl']; ?></td>

                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-xs btn-info" title="Düzenle"
                                onclick="window.location.href = 'admin.php?do=guildedit&guildid=<?php echo $row['ID']; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
		<?php } ?>
                </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-12">
               <ul class="pagination" id="pager">
		 <?php $pgn->Pagination($getfonk, $toplam_sayfa);?>
		  </ul>
    </div>
</div>
			<?php } ?>
			<?php if(isset($_GET['name4'])){ 
$name4 = anti_injection(htmlspecialchars($_GET['name4']));
?>	
						             <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Guild</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
<?php
		$player = $admin->link->db_conn_shard->query("select top 25 * from _Guild WHERE Name like '%' + '$name4' + '%' AND ID > 0 AND Name NOT LIKE '%[[]GM]%'");
$ranks = 1;

	foreach($player as $row){
	$ranks1 = $rank++;
 ?>
                    <tr>
                <td><?php echo $ranks++; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Lvl']; ?></td>

                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-xs btn-info" title="Düzenle"
                                onclick="window.location.href = 'admin.php?do=guildedit&guildid=<?php echo $row['ID']; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>

                </td>
            </tr>
		<?php } ?>
                </tbody>
    </table>
</div>

<?php } ?>	

<?php 	if(isset($_GET['pagemembers'])){
	$guildid = (int)anti_injection(htmlspecialchars($_GET['guildid']));
			?>
            <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Character</th>
            <th>Race</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
		
							<?php 	
		$sayfada = 10;
		$toplam_icerik = $admin->toplam_icerik4($guildid);
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pagemembers"]) ? $_GET["pagemembers"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $admin->link->db_conn_shard->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY GuildID asc) AS Row, * from _GuildMember where GuildID = '$guildid') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);
		

		  foreach($blogg as $row){
 ?>
                    <tr>
                <td><?php echo $row['Row']; ?></td>
                <td><?php echo $row['CharName']; ?></td>
                <td><?php if($row['RefObjID'] <= 1932){ echo 'China'; } else{ echo 'European'; } ?></td>
                <td><?php echo $row['CharLevel']; ?></td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-xs btn-info" title="Düzenle"
                                onclick="window.location.href = 'admin.php?do=karakteredit&charid=<?php echo $row['CharID']; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
		  <?php } ?>
                </tbody>
    </table>
</div>
<div class="row">
    <div class="col-sm-12">
              <ul class="pagination" id="pager">
	<?php $pgn->Pagination($getfonk, $toplam_sayfa);?>
		  </ul>
         </div>
</div>
			<?php } ?>
<?php 	if(isset($_GET['pageadminlogs'])){
			?>
	                <div class="table-responsive">
    <table  class="table table-striped"> 
        <thead>
        <tr>
            <th>#</th>
            <th>Kullanıcı Adı</th>
            <th>İşlem</th>
            <th>Veri</th>
            <th>IP Adresi</th>
            <th>İşlem Zamanı</th>
        </tr>
        </thead>
        <tbody>
							<?php 	
		$sayfada = 25;
		$toplam_icerik = $admin->toplam_icerik103();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pageadminlogs"]) ? $_GET["pageadminlogs"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $admin->link->db_conn_pann->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY id desc) AS Row, * FROM AdminLog) AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);

		  foreach($blogg as $row){
		 
 ?>


   <tr>
                <td><?php echo $row['Row']; ?></td>
                
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['type']; ?></td>
         
                <td>
                                            <a href="#" class="fa fa-info-circle text-danger" title="İşlem Verileri" data-toggle="modal"
                           data-target="#data-modal-<?php echo $row['Row']; ?>">
                        </a>
						 <div id="data-modal-<?php echo $row['Row']; ?>" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
<?php echo html_entity_decode($row['bilgi']) ?>
<td><?php echo $row['ipadres']; ?></td>
<td><?php echo $row['tarih']; ?></td>
				 <?php } ?>

  </tbody>
</table>


</div>

<div class="row">
    <div class="col-sm-12">
               <ul class="pagination" id="pager">
	<?php $pgn->Pagination($getfonk, $toplam_sayfa);?>
		  </ul>
    </div>
</div>
			<?php } ?>	
<?php
    function kisalt($metin, $uzunluk){
  	// substr ile belirlenen uzunlukta kesiyoruz
        $metin = substr($metin, 0, $uzunluk)."...";
	// kesilen metindeki son kelimeyi buluyoruz
        $metin_son = strrchr($metin, " ");
	// son kelimeyi " ..." ile değiştiriyoruz
        $metin = str_replace($metin_son," ...", $metin);
        
        return $metin;
    }
?>				
<?php 	if(isset($_GET['pageglobal'])){
			?>
                <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Karakter Adı</th>
            <th>Mesaj</th>
            <th>Tarih</th>
        </tr>
        </thead>
		      <tbody>
	
							<?php 	
		$sayfada = 10;
		$toplam_icerik = $admin->toplam_icerikglobal();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pageglobal"]) ? $_GET["pageglobal"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $admin->link->db_conn_logger->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY Date desc) AS Row, * FROM _LogGlobal ) AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);
		foreach($blogg as $row){
				  
		$date1 = date('d.m.Y  H:i:s', strtotime($row['Date']));
			?>
  
                    <tr>
                <td><?php echo $row['Row']; ?></td>
                <td><?php echo $row['CharName']; ?></td>
                <td><span class="text-warning" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row['Msg']; ?>"><?php echo kisalt($row['Msg'], 10); ?></span></td>
                <td><?php echo $date1; ?></td></tr>
       
				  <?php } ?> 
    </table>  </tbody>
</div>
<div class="row">
    <div class="col-sm-12">
               <ul class="pagination" id="pager">
		
		  	   <?php $pgn->Pagination($getfonk, $toplam_sayfa);?>
		  </ul>
    </div>
</div>
			<?php } ?>	
			<?php if(isset($_GET['name11'])){ 
$name11 = anti_injection(htmlspecialchars($_GET['name11']));
?>	
                <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Karakter Adı</th>
            <th>Mesaj</th>
            <th>Tarih</th>
        </tr>

        </thead>
        <tbody>
			
<?php
		$player = $admin->link->db_conn_logger->query("select top 10 ROW_NUMBER() OVER(ORDER BY ID ASC) AS Row,* from _LogGlobal WHERE CharName like '%' + '$name11' + '%' AND CharName NOT LIKE '%[[]GM]%'");
	foreach($player as $row){
$date1 = date('d.m.Y  H:i:s', strtotime($row['Date']));

 ?>
                    <tr>
                <td><?php echo $row['Row']; ?></td>
                <td><?php echo $row['CharName']; ?></td>
                <td><span class="text-warning" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row['Msg']; ?>"><?php echo kisalt($row['Msg'], 10); ?></span></td>
                <td><?php echo $date1; ?></td></tr>
		<?php } ?>
                </tbody>
    </table>
</div>

<?php } ?>	

<?php 	if(isset($_GET['pagenotice'])){
			?>
                <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Mesaj</th>
            <th>Tarih</th>
        </tr>
		<tbody>
        </thead>
							<?php 	
		$sayfada = 10;
		$toplam_icerik = $admin->toplam_iceriknotice();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pagenotice"]) ? $_GET["pagenotice"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $admin->link->db_conn_logger->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY Date desc) AS Row, * FROM _LogNotice ) AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);
		foreach($blogg as $row1){
				  
		$date = date('d.m.Y  H:i:s', strtotime($row1['Date']));
			?>
        
		<tr>
                <td><?php echo $row1['Row']; ?></td>
                <td><span class="text-warning" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row1['Msg']; ?>"><?php echo kisalt($row1['Msg'], 25); ?></span></td>
				<td><?php echo $date; ?></td>
			</tr>
                
				 <?php } ?> 
   </tbody> </table>
</div>
<div class="row">
    <div class="col-sm-12">
               <ul class="pagination" id="pager">
		
		  	   <?php $pgn->Pagination($getfonk, $toplam_sayfa);?>
		  </ul>        
    </div>
</div>
			<?php } ?>			<?php } ?>	