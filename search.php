<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?><div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3><?=$dils['search'];?></h3>
<br>
<div class="siralama-top">
<select id="idSelectValue" class="rank-select" title="Lütfen arama tipini seçin!">
<option value="player">Oyuncu</option>
<option value="guild">Guild</option>
</select>
<input type="text" class="input-sm" id="searchInput" placeholder="Ara...">
<button class="btn btn-sm btn-default" onclick="doAjaxSearch();">
<i class="fa fa-search"></i>
</button>
</div>
<div id="ranking-result" class="ranking-tables">
<table>
<tr class="first">
<td width="10">Sıra</td>
<td width="230">Oyuncu Adı</td>
<td width="190">Guild</td>
<td width="94">Level</td>
<td width="94">Item Puanı</td>
</tr>

</table>
</div>
<script type="text/javascript">
                    var xhr, fastSearch, searchType = 'player';

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
                        var sValue = $('#searchInput').val().replace(/[^a-zA-Z0-9_]/gi, ''), loader = $('#search').find('#ajaxloader');
                        if (sValue.length < 2) {
                            return;
                        }
                        if (xhr && xhr.readyState != 4) {
                            xhr.abort();
                        }

                        loader.append('<div class="loaderHorizontal"></div>');
                        $('#ranking-result').empty().show('blind');
                        $.post('ranks.php?name='+sValue,{action:searchType})
                            .done(function (data) {
                                loader.find('.loaderHorizontal').remove();
                                $('#ranking-result').html(data).show('blind');
                            })
                            .fail(function (data) {
                                loader.find('.loaderHorizontal').remove();
                                $('#ranking-result').html('İstek Gerçekleştirilemedi').show('blind');
                            });

                        return false;
                    }

                    $('#idSelectValue').click(function () {
                        var sel = document.getElementById('idSelectValue');
                        if (sel.options[sel.selectedIndex].value == 'guild') {
                            searchType = 'guild';
                        } else {
                            searchType = 'player';
                        }
                    });
                </script>
			<script type="text/javascript">
                    $(document).ready(function () {
                        var loader = $('#ranking').find('#ajaxloader');

                        loader.append('<div class="loaderHorizontal"></div>');
                        $.post('ranks.php', {action: 'playerrank'})
                            .done(function (data) {
                                loader.find('.loaderHorizontal').remove();
                                $('#ranking-result').html(data).show('blind');
                            })
                            .fail(function () {
                                loader.find('.loaderHorizontal').remove();
                                $('#ranking-result').html('İşlem gerçekleştirilemedi.').show('blind');
                            });

                        return false;
                    });

                    $('#ranking-menu').find('a').click(function () {
                        var btn = $(this), link = btn.data('link'), loader = $('#ranking').find('#ajaxloader'), title = btn.text();
                        remo.loaderOn();
                        $('#ranking-result').empty().show('blind');
                        $.post('ranks.php', link)
                            .done(function (data) {
                                btn.parent().find('.active').removeClass('active');
                                btn.addClass('active');
                                $('#ranking-title').find('span').text(title);
                                remo.loaderOff();
                                $('#ranking-result').html(data).show('blind');
                            })
                            .fail(function (data) {
                                remo.loaderOff();
                                $('#ranking-result').html('İşlem gerçekleştirilemedi.').show('blind');
                            });

                        return false;
                    })
                </script>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>