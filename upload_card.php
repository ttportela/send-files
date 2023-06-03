
<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
<!--form id="upload" action="#" method="POST" enctype="multipart/form-data"-->
    <!--div class="demo-separator mdl-cell--1-col"></div-->
    <div class="demo-options mdl-card mdl-color--deep-purple-500 mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet mdl-cell--12-col-desktop">
        <div class="mdl-card__supporting-text mdl-color-text--blue-grey-50">
        <h3>Upload</h3>
            <div id="filedrag-dad" ondrop="upload_file(event)" ondragover="return false">
                <!--input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000"-->

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="file" id="selectfile" name="selectfile[]" multiple="multiple">
                    <!--label class="mdl-textfield__label" for="fileselect">Selecione Arquivos</label-->
                    <div id="filedrag" class="" style="display: block;">ou arraste os arquivos aqui</div>
                </div>

            </div>
        </div>
        <!--div class="mdl-card__actions mdl-card--border">
        <div class="mdl-layout-spacer"></div>
        <div id="submitbutton">
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--blue-grey-50" type="submit">Carregar</button>
        </div-->
        </div>
    </div>
<!--/form-->
<script>
  $(document).ready(function () {
    $("html").on("dragover", function (e) {
      e.preventDefault();
      e.stopPropagation();
    });
 
    $("html").on("drop", function (e) {
      e.preventDefault();
      e.stopPropagation();
    });
 
    $('#filedrag').on('dragover', function () {
      $(this).addClass('hover');
      return false;
    });
 
    $('#filedrag').on('dragleave', function () {
      $(this).removeClass('hover');
      return false;
    });
 
    $('#filedrag-dad').on('drop', function (e) {
      $('#filedrag').removeClass('hover');
      return false;
    });
  });
</script>
</div>