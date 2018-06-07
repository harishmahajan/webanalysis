<div class="modal fade" id="ErrModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h3 class="modal-title" style="color: orange" id="myModalLabel">
               Mayday,Mayday!
            </h3>
         </div>       
         <div class="modal-body">
            <h4>Something went wrong. Please follow the instructions below.</h4><br>
            <table class="table">
                <tr>
                    <th>Error Code</th>
                    <th>Instructions</th>
                    <th>Error</th>
                </tr>
            {foreach $ConErr->ConnectionID as $err}
            <tr>
                <td>{$ConErr->ErrorCode}</td>
                {if $ConErr->ErrorMessage eq 'The user must be an administrator of the page in order to impersonate it.'} 
                   
                        <td>The user must be an administrator of the page in order to view data.</td>     
                    
                {else}
                    
                        <td>{$ConErr->ErrorMessage}</td>     
                    
                {/if}
               
                <td>{$ConErr->Site}</td>              
            </tr>
            {/foreach}

            {if !empty($FbNullTok) OR $ConErr->Site eq 'facebook'} 
            <tr>
                <td>00</td>
                <td>
                    Please Follow Steps<br>
                    1. Click on "Go to Manage Connection".<br>
                    2. Select "Load data for Facebook".<br>
                    3. Pick any Date range.<br>
                    4. Import Data.
                </td>
                <td>Missing Facebook <br>Connection</td>              
            </tr>
            {/if}
            <tr><td colspan="3"><b>Reconnect to Facebook/Twitter to solve the problems.</b><td></tr>
            </table>
            {if empty($ConErr->AccountID)}
                <input type="hidden" value="0" id="txtAcID"/>
            {else}
                <input type="hidden" value="{$AccID}" id="txtAcID"/>
            {/if}
            
         </div>
         <div class="modal-footer"> 
            <a href="#" id="ErrHide" class="btn btn-success">
                Go to manage Connection
            </a>            
         </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<form id="frmHideErr" method="post" action="/account/connections/{$AccID}">   
</form>
<script>
    $(window).load(function(){
        $('#ErrModal').modal('show');
        $('body#changeColor').css('padding-right','0px');

        /*$('#DelModal').on('hide.bs.modal', function () {
          $("#frmHideErr").submit();
        });*/
    });

    $('#ErrHide').click(function(){    
        //$("#frmHideErr").submit();
        var ACID;
        
        $.ajax({
            type: "POST",
            url: "/account/hideErr/",
            data: {
                accountID : "{$ConErr->AccountID}"
            },
            dataType: 'text',
            success:function(resultFB){
                $('#ErrModal').modal('hide');
                $("#frmHideErr").submit();
            }//suecss
        });
    });
</script>
