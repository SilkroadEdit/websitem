<?PHP echo !defined("ADMIN") ? die("Hacking?"): null; ?>	
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-sm-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Job Adı İle Tüm Bilgileri Bul</h3>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box-tools -->
            </div>

<script src="plugins/sweetalert/sweetalert.min.js"></script>


	
            <form class="form-horizontal" method="post" id="info-username">
               
			<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="box-body">
                    <div class="form-group" id="group-username">
                        <label for="username" class="col-sm-3 control-label">Job Adı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </div>
					 <input type="hidden" name="avcıara" id="avcıara">
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-default" onclick="window.location.replace('https://tasarim12.remopanel.com/admin')">Vazgeç</button>
                    <button type="submit" class="btn btn-info pull-right">Gönder</button>
                </div>
            </form>
        </div>
    </div>
    <div id="info-content">

    </div>
   <script type="text/javascript">
        $('#info-username').submit(function () {
            var form = $(this);
            form.find('button[type=submit]').attr("disabled", true);
            removeFormErrors(form);
            removeAlertBox(form);
            $('#info-content').empty();
            $.post("kontrol.php", form.serialize())
                    .done(function (data) {
                        $('#info-content').html(data);
                        form.find('button[type=submit]').attr("disabled", false);
                    })
                    .fail(function (data) {
                        if (data.responseJSON) {
                            appendFormErrors(form, data.responseJSON)
                        } else {
                            swal("Üzgünüz!", "Bir hata meydana geldi.", "error");
                        }
                        form.find('button[type=submit]').attr("disabled", false);
                    });
            return false;
        });
    </script>

</article>
 
	<?php include('footer.php'); ?>
