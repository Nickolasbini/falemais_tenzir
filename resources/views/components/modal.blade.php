<div id="master-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title h4">Título</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="openModal(true, 'master-modal')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body h5"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary negative-btn" data-dismiss="modal" onclick="openModal(true, 'master-modal')">Fechar</button>
            <button type="button" class="btn btn-primary positive-btn">Confirmar</button>
        </div>
      </div>
    </div>
</div>

<script>
    /* Modal methods */
    function openModal(close = false, id = 'master-modal'){
        $('modal').modal();
        if(close == false){
            $('#'+id).modal('show');
        }else{
            $('#'+id).modal('hide');
        }
    }
    function addModalContent(title = '', message = '', showFooter = false, id = 'master-modal'){
        $('#'+id).find('.modal-title').text(title);
        $('#'+id).find('.modal-body').html(message);
        if(showFooter == false){
            $('#'+id).find('.modal-footer').hide();
        }else{
            $('#'+id).find('.modal-footer').find('.negative-btn').text(showFooter['negativeBtn']);
            $('#'+id).find('.modal-footer').find('.positive-btn').text(showFooter['positiveBtn']);
        }
    }
    function addModalFooterData(cancelMessage = 'Fechar', confirmMessage = 'Confirmar', id = 'master-modal'){
        $('#'+id).find('.negative-btn').text(cancelMessage);
        $('#'+id).find('.positive-btn').text(confirmMessage);
    }
    function hideModalElement(classToHide = null){
        if(classToHide == null){
            return;
        }
        $('.'+classToHide).hide();
    }
</script>