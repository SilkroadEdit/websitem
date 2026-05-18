<?php echo !defined("ADMIN") ? die("Hacking?"): null;?>
<div class="content-wrapper">
        <section class="content">
            <div class="row">
			<?php 

			$kullanici = $_SESSION['username2'];
			$testquery = $admin->link->db_conn_account->query(" SELECT
        active_user = (SELECT TOP 1 nUserCount
                       FROM SRO_VT_ACCOUNT.dbo._ShardCurrentUser
                       ORDER BY dLogDate DESC),
        total_user = (SELECT COUNT(JID)
                      FROM SRO_VT_ACCOUNT.dbo.TB_User),
        total_char = (SELECT COUNT(CharID)
                      FROM SRO_VT_SHARD.dbo._Char),
        china_char = (SELECT COUNT(CharID)
                      FROM SRO_VT_SHARD.dbo._Char
                      WHERE RefObjID <= 1932),
        europe_char = (SELECT COUNT(CharID)
                       FROM SRO_VT_SHARD.dbo._Char
                       WHERE RefObjID > 1932),
        male_char = (SELECT COUNT(CharID)
                     FROM SRO_VT_SHARD.dbo._Char
                     WHERE RefObjID BETWEEN 1907 AND 1919 OR RefObjID BETWEEN 14875 AND 14886),
        female_char = (SELECT COUNT(CharID)
                       FROM SRO_VT_SHARD.dbo._Char
                       WHERE RefObjID BETWEEN 1920 AND 1932 OR RefObjID BETWEEN 14888 AND 14900),
        total_guild = (SELECT COUNT(ID)
                       FROM SRO_VT_SHARD.dbo._Guild)");
					   $rowayar = $testquery ->fetchAll();
?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Aktif Kullanıcı</span>
                <span class="info-box-number"><?php echo $rowayar[0]['active_user']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Toplam Kullanıcı</span>
                <span class="info-box-number"><?php echo $rowayar[0]['total_user']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-shield"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Toplam Guild</span>
                <span class="info-box-number"><?php echo $rowayar[0]['total_guild']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-male"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Toplam Karakter</span>
                <span class="info-box-number"><?php echo $rowayar[0]['total_char']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Karakter Cinsiyet Dağılımları</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="chart-responsive">
                            <canvas id="pieChart" height="150"></canvas>
                        </div>
                        <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <ul class="chart-legend clearfix">
                            <li><i class="fa fa-circle-o text-light-blue"></i> Erkek Karakterler</li>
                            <li><i class="fa fa-circle-o text-red"></i> Kadın Karakterler</li>
                        </ul>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Karakter Irk Dağılımları</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="chart-responsive">
                            <canvas id="pieChart2" height="150"></canvas>
                        </div>
                        <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <ul class="chart-legend clearfix">
                            <li><i class="fa fa-circle-o text-green"></i> Çinli Karakterler</li>
                            <li><i class="fa fa-circle-o text-yellow"></i> Avrupalı Karakterler</li>
                        </ul>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
   <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Global Chat Geçmişi</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool pull-right" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool pull-right" onclick="refreshGlobals();"><i
                                class="fa fa-refresh"></i></button>
                    <div id="searchForm" class="input-group input-group-sm pull-right" style="width: 150px;">
                        <input type="text" class="form-control pull-right" id="searchInput" placeholder="Karakter Adı">
                        <div class="input-group-btn">
                            <button onclick="doAjaxSearch();" class="btn btn-default"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body" id="global-logs">
                <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Karakter Adı</th>
            <th>Mesaj</th>
            <th>Tarih</th>
        </tr>

        </thead><tbody>
							<?php 	
		$sayfada = 10;
		$toplam_icerik = $admin->toplam_icerikglobal();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["page"]) ? $_GET["page"] : 1;
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
                <td><?php echo $date1; ?></td>
         
                
				  <?php } ?> </tbody>
    </table>
</div>
<div class="row">
    <div class="col-sm-12">
               <ul class="pagination" id="pager">
		
		  	   <?php $pgn->Pagination($getfonk, $toplam_sayfa);?>
		  </ul>
    </div>
</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Notice Geçmişi</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool pull-right" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool pull-right" onclick="refreshNotices();"><i
                                class="fa fa-refresh"></i></button>
                </div>
            </div>
            <div class="box-body" id="notice-logs">
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
			
		$getfonk =(int)isset($_GET["page"]) ? $_GET["page"] : 1;
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
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Saatlik Aktif Kullanıcı Grafiği</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="lineChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
    </div>
		
			<!-- js -->
<script type="text/javascript">
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

jQuery.fn.poo = function(conf){
    
    var config = jQuery.extend({
		number : null,
		speed: 6
	}, conf);

    return this.each(function(){
        
        var $this = $(this),
            current = 0,
            number = config.number; // current number
            
        if ( number == null ){
            number = parseFloat( $this.data('number') );
        }
            
        $this.text( current );
        
        var interval = setInterval(function(){
            
            current += Math.ceil(Math.random() * ( number / config.speed ))
            if ( current > number ){
                current = number;
                clearInterval(interval);
            }
            
            $this.text( current.format() );
            
        }, 100);
        
    });

};

$(".overview_count").poo();

</script>

<script src="plugins/chartjs/Chart.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var areaChartData = {
                labels: [<?PHP 
		$blogg = $admin->link->db_conn_account->prepare("    SELECT
      DATEPART(HH, dLogDate) AS [time],
      max(nUserCount)        AS [count]
    FROM SRO_VT_ACCOUNT.dbo._ShardCurrentUser
    GROUP BY DATEPART(HH, dLogDate), CONVERT(VARCHAR(10), dLogDate, 104)
    HAVING CONVERT(VARCHAR(10), dLogDate, 104) = CONVERT(VARCHAR(10), GETDATE(), 104)
    ORDER BY [time]
 ");
		
		$blogg -> execute();
		$rank = 0;
		  foreach($blogg as $row){
		  ?>'<?php echo $row['time'] ?>:00',<?php } ?>],
                datasets: [
                    {
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: [<?PHP 
		$blogg = $admin->link->db_conn_account->prepare("    SELECT
      DATEPART(HH, dLogDate) AS [time],
      max(nUserCount)        AS [count]
    FROM SRO_VT_ACCOUNT.dbo._ShardCurrentUser
    GROUP BY DATEPART(HH, dLogDate), CONVERT(VARCHAR(10), dLogDate, 104)
    HAVING CONVERT(VARCHAR(10), dLogDate, 104) = CONVERT(VARCHAR(10), GETDATE(), 104)
    ORDER BY [time]
 ");
		
		$blogg -> execute();
		$rank = 0;
		  foreach($blogg as $row){
		  ?><?php echo $row['count'] ?>,<?php } ?>]
                    }
                ]
            };

            var areaChartOptions = {
                //Boolean - If we should show the scale at all
                showScale: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: false,
                //String - Colour of the grid lines
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - Whether the line is curved between points
                bezierCurve: true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension: 0.3,
                //Number - Radius of each point dot in pixels
                pointDotRadius: 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth: 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius: 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke: true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth: 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill: true,
                //String - A legend template
                legendTemplate: "<ul class=\"<\%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<\%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><\%=datasets[i].label%><%}%></li><%}%></ul>",
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                tooltipTemplate: "Saat <\%=label%> - <\%=value %> Aktif Kullanıcı"
            };

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas);
            var lineChartOptions = areaChartOptions;
            lineChartOptions.datasetFill = false;
            lineChart.Line(areaChartData, lineChartOptions);

            //-------------
            //- PIE CHART -
            //--------------
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d"), pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas), pieChart2 = new Chart(pieChartCanvas2);
            var PieData = [
                {
                    value: '<?php echo $rowayar[0]['male_char']; ?>',
                    color: "#00c0ef",
                    highlight: "#00c0ef",
                    label: "Erkek"
                },
                {
                    value: '<?php echo $rowayar[0]['female_char']; ?>',
                    color: "#f56954",
                    highlight: "#f56954",
                    label: "Kadın"
                }
            ];
            var PieData2 = [
                {
                    value: '<?php echo $rowayar[0]['china_char']; ?>',
                    color: "#00a65a",
                    highlight: "#00a65a",
                    label: "Çinli"
                },
                {
                    value: '<?php echo $rowayar[0]['europe_char']; ?>',
                    color: "#f39c12",
                    highlight: "#f39c12",
                    label: "Avrupalı"
                }
            ];
            var pieOptions = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke: true,
                //String - The colour of each segment stroke
                segmentStrokeColor: "#fff",
                //Number - The width of each segment stroke
                segmentStrokeWidth: 1,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps: 100,
                //String - Animation easing effect
                animationEasing: "easeOutBounce",
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate: true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale: false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: false,
                //String - A legend template
                legendTemplate: "<ul class=\"<\%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<\%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><\%=segments[i].label%><%}%></li><%}%></ul>",
                tooltipTemplate: "<\%=value %> <\%=label%> Karakter"
            };
            pieChart.Doughnut(PieData, pieOptions);
            pieChart2.Doughnut(PieData2, pieOptions);
        });
    </script>
    
<!--#js -->
    <script type="text/javascript">
        var xhr, fastSearch, saveRequest = '';

        $('#searchInput').keydown(function () {
            if (xhr && xhr.readyState != 4) {
                xhr.abort();
            }
            window.clearTimeout(fastSearch);
            fastSearch = window.setTimeout(function () {
                doAjaxSearch();
            }, 500);
        });

        function doAjaxSearch() {
            var sValue = $('#searchInput').val().replace(/[^a-zA-Z0-9_]/gi, '');
            if (sValue.length < 2) {
                return;
            }
            if (xhr && xhr.readyState != 4) {
                xhr.abort();
            }
            overOverLayer();
            saveRequest = sValue + '/';
            $('#global-logs').load("faqs.php?name11=" + sValue, function (response, status, xhr) {
                if (status != "success") {
                    swal({
                        title: 'Opps...',
                        text: xhr.statusText,
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
                overOverLayerClose();
            });
        }

        function switchPage(page) {
            overOverLayer();

            var route, type;

            if ($(event.target).parent('#notice-logs ul > li').length) {
                route = "faqs.php?pagenotice=" + page;
                type = 'notice';
            } else {
                route = "faqs.php?pageglobal=" + page;
                type = 'global';
            }

            $('#' + type + '-logs').load(route, function (response, status, xhr) {
                if (status != "success") {
                    swal({
                        title: 'Opps...',
                        text: xhr.statusText,
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
                overOverLayerClose();
            });
        }

        function refreshNotices() {
            overOverLayer();

            $('#notice-logs').load("faqs.php?pagenotice=1", function (response, status, xhr) {
                if (status != "success") {
                    swal({
                        title: 'Opps...',
                        text: xhr.statusText,
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
                overOverLayerClose();
            });
        }

        function refreshGlobals() {
            overOverLayer();

            $('#global-logs').load("faqs.php?pageglobal=1", function (response, status, xhr) {
                if (status != "success") {
                    swal({
                        title: 'Opps...',
                        text: xhr.statusText,
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
                overOverLayerClose();
            });
        }

    </script>
<?php include('footer.php'); ?>