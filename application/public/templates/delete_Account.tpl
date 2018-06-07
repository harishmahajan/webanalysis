<div class="modal fade" id="DelModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">        
         <div class="modal-body">
            Deleting this account will automatically delete all associated data.<br> 
            Do you want to continue?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal" style="width: 54px">
                No
            </button> 
            <a href="/account/delAc/{$accountID}" id="delYesClick" class="btn btn-danger">
                Yes
            </a>            
         </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<form id="backToConnection" method="post" action="/account/connections/{$accountID}">   
</form>
<script>
    $(window).load(function(){
        $('#DelModal').modal('show');
        $('body#changeColor').css('padding-right','0px');

        $('#DelModal').on('hide.bs.modal', function () {
          $("#backToConnection").submit();
        });
    });

    $('#delYesClick').click(function(){    
        $('#DelModal').modal('hide');
    });
</script>