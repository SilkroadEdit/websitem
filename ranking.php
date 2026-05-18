<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?>
<div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3><?=$dils['rank'];?></h3>
<br>
<ul class="rankings-nav" id="ranking-menu">
<li class="active"><a href="#" data-type="playerrank"><span class="img char"></span><span>Player Rank</span></a>
</li>
<li><a href="#" data-type="guildrank"><span class="img guild"></span><span>Guild Rank</span></a></li>
<li><a href="#" data-type="unionrank"><span class="img guild"></span><span>Union Rank</span></a></li>
<li><a href="#" data-type="honorrank"><span class="img guild"></span><span>Honor Rank</span></a></li>
<li><a href="#" data-type="thiefrank"><span class="img job"></span><span>Thief Rank</span></a></li>
<li><a href="#" data-type="traderrank"><span class="img job"></span><span>Trader Rank</span></a></li>
<li><a href="#" data-type="hunterrank"><span class="img job"></span><span>Hunter Rank</span></a></li>
<li><a href="#" data-type="uniquerank"><span class="img unique"></span><span>Unique Rank</span></a></li>
<li><a href="#" data-type="extunique"><span class="img unique"></span><span>Anlık Unique</span></a>
</li>
<li><a href="#" data-type="pvprank"><span class="img char"></span><span>PvP Rank</span></a></li>
<li><a href="#" data-type="extpvp"><span class="img char"></span><span>Anlık PvP</span></a></li>
</ul>
<h3 id="ranking-title" style="margin-top: 10px; font-size: 14px">Player Rank</h3>
<div id="ranking-result" class="ranking-tables">
</div>
<script type="text/javascript">
                         $(document).ready(function () {
                            loading();
                            $.post('ranks.php', {action: 'playerrank'})
                                .done(function (data) {
                                    $('#ranking-result').html(data);
                                    loading('hide');
                                })
                                .fail(function (data) {
                                    $('#ranking-result').html('Bad Request');
                                    loading('hide');
                                });

                            $('#ranking-menu').find('li a').click(function () {
                                var type = $(this).data('type'), list = $(this).parent('li'),
                                    title = list.find('span:last-child()').text();
                                loading();
                                $.post('ranks.php', {action: type})
                                    .done(function (data) {
                                        $('#ranking-menu').find('li.active').removeClass('active');
                                        list.addClass('active');
                                        $('#ranking-title').text(title);
                                        $('#ranking-result').html(data);
                                        loading('hide');
                                    })
                                    .fail(function (data) {
                                        $('#ranking-result').html('İstek Gerçekleştirilemedi');
                                        loading('hide');
                                    });

                                return false;
                            })
                        });
                    </script>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>