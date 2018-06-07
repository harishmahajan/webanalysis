<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
            Create a New Account<br>
            <small>Connect your 3rd party social accoount to Webanalysis.co</small>
            </h4>
         </div>
         <div class="modal-body">
        <form class="form-horizontal" role="form" method="post">
            <fieldset class="addFieldSet">               

                {if $account_error}
                    <div class="form-group">
                        <p class="text-center text-danger">
                            {$account_error}
                        </p>
                    </div>
                {/if}

                <div class="row">
                    <div class="col-md-12">
                        <label for="inputAccountname" class="control-label">Account Name</label>
                    </div>
                </div>
                <div>&nbsp;</div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="inputAccountname" placeholder="" name="accountname">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputAccountname" class="control-label">Time Zone</label>
                    </div>
                </div>
                <div>&nbsp;</div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- <input type="text" class="form-control" id="inputAccountname" placeholder="" name="accountname"> -->
                        <SELECT class="form-control col-md-9" id="timeZone" name="timeZone">
                            <OPTION value="PST">Pacific Time Zone</OPTION>
                            <OPTION value="UTC">Coordinated Universal Time</OPTION>
                        </SELECT>
                    </div>
                </div>
                <div>
                  &nbsp;
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-info pull-right">Get Started</button>
                    </div>
                </div>

            </fieldset>
        <input type="hidden" name="action" value="addaccount">
       
    </form>
  </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
<form id="backToDeshbord" method="post" action="/dashboard/view/{$accountID}">    
</form>
<script type="text/javascript">
    $(window).load(function(){
        $('#myModal').modal('show');
    });//$(window).load

     $(function () { $('#myModal').on('hide.bs.modal', function () {
      $("#backToDeshbord").submit();
  })
 });//$(function () { $('#myModal').on
</script>