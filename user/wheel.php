<?php include('lib/header.php'); ?>
<style>
/* --- Loading --- */
.loader-circular {
    background: url("public/assets/images/loader.gif") no-repeat;
    background-size: 30px 30px;
    height: 34px;
    width: 34px;
    display: block;
}

.loader-horizontal {
    background: url("public/assets/images/loader_horizontal.gif") no-repeat;
    height: 11px;
    width: 43px;
    margin: 0 auto;
}

#ovd-loading {
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -22px;
    margin-left: -22px;
    background: url("public/assets/images/ovd_sprite.png") 0 -108px;
    opacity: 0.8;
    cursor: pointer;
    z-index: 8060;
}

#ovd-loading div {
    width: 44px;
    height: 44px;
    background: url("public/assets/images/ovd_loading.gif") center center no-repeat;
}

.ovd-overlay {
    position: absolute;
    top: 0;
    left: 0;
    overflow: hidden;
    z-index: 8010;
    background: url("public/assets/images/ovd_overlay.png");
}

.ovd-overlay-fixed {
    position: fixed;
    bottom: 0;
    right: 0;
}

.ovd-overlay {
    overflow: auto;
    overflow-y: scroll;
}

.post img {
    display: block;
    max-width: 100%;
    height: auto;
}

.refreshIconCaptcha {
    cursor: pointer;
}

.game-reward {
    font-weight: bold;
    display: flex;
    margin: 5px 0;
    padding: 2px;
    align-items: center;
}

.game-reward i.fa-caret-right {
    font-size: 18px;
}

.img-reward {
    display: inline-block;
    width: 30px;
    height: 30px;
    margin-right: 3px;
    background: transparent no-repeat center center;
    background-size: 100% 100%;
    -webkit-background-origin: border-box;
    background-origin: border-box;
    border: 2px solid transparent;
    border-radius: 50%;
    -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.6);
    -moz-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.6);
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.6);
}

.wrapper-canvas {
    max-width: 450px;
    margin: auto;
    background: url(public/assets/images/bg_wheel2.png) no-repeat center center;
    background-size: contain;
}

.winned {
    background: #00a65a;
}
</style>
<?PHP 
	   $usernamee=$_SESSION['username'];
       $query2 = $users->link->db_conn_pann->query("SELECT *,(select game_credit from sro_vt_account..tb_user where StrUserID = '$usernamee') as Kredim,(select WheelPrice from wheelsettings where ID = 1) as WheelPrice,(select type from Panel..wheelsettings where ID = 1) as wheel FROM dbo.game_rewards order by ratio asc");
	   $query22 = $query2->fetchAll();	
       foreach($query22 as $wheel_item)
                {
                    $wheel_items[] = array(
                        "id" => $wheel_item["id"],
                        "name" => $wheel_item["name"],
                        "image" => $wheel_item["image"],
                        "ratio" => $wheel_item["ratio"],
                        "color" => $wheel_item["color"],
                    );
                }
                $_wheel_items = $wheel_items;
              


 ?>
    <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title"></h4>
                                    <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="hesabim.php">Anasayfa</a></li>
                                        <li class="breadcrumb-item active">Çarkıfelek</li>
                                    </ol>


                                </div>
                                <div class="col-sm-6">

                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                   
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
<?php if($query22[0]["wheel"] == 1){ ?>	
                    <div class="col-lg-12">
                        <div class="card">
           <div class="card-body">
                                        <h4 class="mt-0 header-title mb-5">Çarkıfelek</h4>
               <div class="box-tools pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning">Mevcut Krediniz: <span class="text-bold"
                                                                                                  id="game-credit"><?php echo $query22[0]["Kredim"]; ?> Kredi</span>
                        </button>
                        
                    </div>
                
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                                            <div class="col-md-8">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="canvas-container">
                                        <div class="wrapper-canvas">
                                            <canvas id="spinner" width="430" height="430"></canvas>
                                        </div>
                                    </div><br>
                                </div>

                                <div class="col-sm-12 col-sm-offset-4">
                                    <div class="row">
                                        <div class="col-sm-12 col-sm-offset-4" >
                                            <button class="btn btn-block btn-success btn-flat btn-lg" id="spin-wheel">
                                                <i class="fa fa-play"></i> <b>&Ccedil;evir</b>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					
                        <div class="col-md-4">
                            <h4 class="page-header">&Ouml;d&uuml;ller</h4>
                            <ul class="list-unstyled">
                                  <?php foreach($wheel_items as $row){ ?>
                                                                    <li class="game-reward" id="reward-<?php echo $row['id']; ?>">
                                        <i class="fa fa-caret-right hidden" data-toggle="tooltip" data-placement="left"
                                           title=""></i>
                                        <i class="img-reward"
                                           style="border-color: <?php echo $row['color']; ?>; background-image: url('<?php echo $row['image']; ?>')"></i> <?php echo $row['name']; ?>
                                    </li> 
																<?php } ?>
										
                                                            </ul>
                        </div>
						
 <script type="text/javascript">
                            $(function () {

                                $("#reward_row").hide();

                                window.requestAnimationFrame = function () {
                                    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.msRequestAnimationFrame || window.oRequestAnimationFrame || function (a) {
                                            window.setTimeout(a, 1E3 / 60)
                                        }
                                }();
                                var DePiSpinner = {
                                    rewards: [], init: function () {
                                        this.now = 0;
                                        this.then = Date.now();
                                        this.interval = 1E3 / 60;
                                        this.delta = 0;
                                        this.pause = !1;
                                        this.canvas = document.getElementById("spinner");
                                        this.ctx = this.canvas.getContext("2d");
                                        this.container = $(this.canvas).parent();
                                        this.imagesize = 44;
                                        this.speed = this.roundStatus = 0;
                                        this.total = '100';
                                        this.rewardsAngle = this.targetRotation = this.rotation = 0;
                                        this.resize();
                                        $(window).resize(this.resize.bind(this));
                                        this.setRewards();
                                        this.start()
                                    }, resizeCalc: function (a) {
                                        return Math.round(this.canvas.width / 450 * 100 / 100 * a)
                                    }, calculateCircumference: function (value) {
                                        if (this.total > 0 && !isNaN(value)) {
                                            return (Math.PI * 2.0) * (value / this.total);
                                        }
                                        return 0;
                                    }, resize: function () {
                                        $(this.canvas).attr("width", $(this.container).width());
                                        $(this.canvas).attr("height", $(this.container).width());
                                        450 < this.canvas.width && (this.canvas.width = 450);
                                        450 < this.canvas.width && (this.canvas.height = 450);
                                        this.cx = this.canvas.width / 2;
                                        this.cy = this.canvas.height / 2
                                    }, setWinned: function (a) {
                                        for (var b in this.rewards)this.rewards[b].id == a && (this.winned = b);
                                        this.targetRotation = 25920 - this.rewardsAngle * this.winned;
                                        this.roundStatus = 2
                                    }, start: function () {
                                        this.speed = 15;
                                        this.rq = window.requestAnimationFrame(this.drawCanvas.bind(this))
                                    }, reset: function () {
                                        this.rq = window.requestAnimationFrame(this.drawCanvas.bind(this));
                                        if (0 != this.roundStatus || -1 != this.winned) this.speed = this.roundStatus = 0, this.rewards = [], this.rotation = 0, this.winned = -1, this.rewardsAngle = this.targetRotation = 0;

                                                    $("#reward_row").show().fadeIn(250);
                                    }, drawRewards: function () {
                                        for (var a in this.rewards) {
                                            var obj = new Image;
                                            obj.src = this.rewards[a].image;
                                            this.ctx.save();
                                            this.ctx.translate(this.cx, this.cy);
                                            this.ctx.rotate(this.degToRad(this.rotation + this.rewardsAngle * a));
                                            this.rewards[a].angle = this.rewardsAngle * a;
                                            this.ctx.beginPath();
                                            this.ctx.arc(0, -this.resizeCalc(150), this.resizeCalc(this.imagesize) / 2, 0, 2 * Math.PI);
                                            this.ctx.closePath();
                                            this.ctx.strokeStyle = this.rewards[a].color;
                                            this.ctx.lineWidth = 4;
                                            this.ctx.stroke();
                                            this.ctx.clip();
                                            this.ctx.drawImage(obj, -this.resizeCalc(this.imagesize) / 2, -this.resizeCalc(this.imagesize) / 2 - this.resizeCalc(150), this.resizeCalc(this.imagesize), this.resizeCalc(this.imagesize));
                                            this.ctx.restore();
                                        }
                                    }, drawCenterText: function () {
                                        this.ctx.fillStyle = "orange";
                                        this.ctx.textAlign = "center";
                                        this.ctx.font = this.resizeCalc(16) + "px Arial";
                                        this.ctx.fillText("Ücret", this.cx, this.cy - this.resizeCalc(2));
                                        this.ctx.font = this.resizeCalc(20) + "px Arial";
                                        this.ctx.fillText("<?= $query22[0]['WheelPrice']; ?> Kredi", this.cx, this.cy + this.resizeCalc(24));
                                    }, drawPercents: function () {
                                        var startAngle = 0, endAngle = 0;

                                        for (var i = 0; i < this.rewards.length; i++) {
                                            endAngle = startAngle + this.calculateCircumference(this.rewards[i].ratio);

                                            this.ctx.save();
                                            this.ctx.translate(this.cx, this.cy);
                                            this.ctx.rotate(-.5 * Math.PI);
                                            this.ctx.beginPath();
                                            this.ctx.arc(-2, 0, this.cx - this.resizeCalc(15), startAngle, endAngle);
                                            this.ctx.strokeStyle = this.rewards[i].color;
                                            this.ctx.lineWidth = this.resizeCalc(22);
                                            this.ctx.stroke();
                                            this.ctx.restore();

                                            if (i < this.rewards.length - 1) {
                                                startAngle = endAngle;
                                            }
                                        }
                                    }, showWinnedReward: function () {
                                        var reward = $("#reward-" + this.rewards[this.winned].id);

                                        reward.addClass("winned");
                                        reward.find('i.fa-caret-right').removeClass('hidden').animate({ padding: '0 10px 0 15px' });
                                        var a = this;
                                        setTimeout(function () {
                                            a.reset();
                                            a.setRewards();
                                            a.rq = window.requestAnimationFrame(a.drawCanvas.bind(a));
                                            $('#spin-wheel').attr("disabled", false);
                                            $('#refresh').trigger('click');
                                        }, 2000)
                                    }, drawCanvas: function () {
                                        this.rq = window.requestAnimationFrame(this.drawCanvas.bind(this));
                                        this.now = Date.now();
                                        this.delta = this.now - this.then;
                                        if (1 != this.pause && this.delta > this.interval) {
                                            this.then = this.now - this.delta % this.interval;
                                            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                                            if (-1 < this.winned) {
                                                this.rotation += this.speed;
                                                var a = this.targetRotation - this.rotation;
                                                if (0 < a) this.speed = 500 < a ? a / 20 : a / 40, .2 > this.speed && (this.speed = .2); else {
                                                    if (0 == this.rewards.length) {
                                                        this.reset();
                                                        return
                                                    }
                                                    this.rotation > this.rewards[this.winned].angle && (this.speed = 0, this.roundStatus = 3, window.cancelAnimationFrame(this.rq), this.showWinnedReward())
                                                }
                                            } else this.rotation += .5;
                                            this.drawCenterText();
                                            this.drawRewards();
                                            this.drawPercents();
                                        }
                                    }, degToRad: function (a) {
                                        return .017453292519943295 * a
                                    }, setRewards: function () {
                                        this.rewards = <?=json_encode($wheel_items)?>;
                                        this.rewardsAngle = 360 / this.rewards.length;
                                    }
                                };

                                DePiSpinner.init();

                                $('#spin-wheel').click(function () {


                                    swal({
                                        title: "Çark döndürülsün mü?",
                                        text: "Evete tıkladığınız taktirde işlem geri alınamaz! Bankanızda boş slot olup olmadığını kontrol edin",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Yes",
                                        closeOnConfirm: true,
                                        cancelButtonText: "No",
                                        html: false
                                    }, function () {
                                        $('#spin-wheel').attr("disabled", true);

                                        $('.game-reward i.fa-caret-right:not(.hidden)').animate({ padding: '0' }, 'slow', function () {
                                            $(this).addClass('hidden');
                                        });
                                        $('.game-reward.winned').removeClass('winned');

                                        $("#reward_row").hide().fadeOut(250);

                                        $.post("ajax-carkifelek.php",
                                            {
                                                '_token': '<?php echo $_SESSION['_token']; ?>'
                                            })
											
                                            .done(function (data) {
												var json_obj = $.parseJSON(data);
                                                if (json_obj.id) {
                                                    DePiSpinner.setWinned(json_obj.id);
                                                    setTimeout(
                                                    function() 
                                                    {
                                                        swal({
                                                            title: "Tebrikler!",
                                                            text: json_obj.name+" kazandınız. Eşyanız  itemse bankanıza silk yada tl ise hesabınıza gönderilmiştir. Eğer karakteriniz oyundaysa Return atınız!",
                                                            imageUrl: json_obj.image
                                                        });
                                                    }, 5300);
                                                    $("#game-credit").html(''+json_obj.remain_tl+' Kredi');
                                                  
                                                } else {
                                                    swal(json_obj.title,json_obj.message,'error');
                                                }
                                            })
                                            .fail(function (data) {
                                                
                                                if (data = data.responseJSON) {
                                                    swal({
                                                        title: data.title ? data.title : "Üzgünüz!",
                                                        text: data.text ? data.text : "Bir hata meydana geldi.",
                                                        type: data.type ? data.type : "error",
                                                        timer: 2000
                                                    });
                                                } else {
                                                    swal("Üzgünüz!", "Bir hata meydana geldi.", "error");
                                                }
                                            });
                                               
                                            
                                    });

                                    return false;
                                });
                            });
                        </script>
                                    </div>
<?php } ?>
            </div>
        </div>
    </div>
<br><br><br><br><br><br> <br>
<?php include('lib/footer.php'); ?>