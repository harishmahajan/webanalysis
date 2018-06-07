<div class="hidden-xs ">
<p class="navbar-text navbar-right">
    Signed in as {$fullname}
    |
    <a href="/log/out">
        Logout
    </a>
</p>
</div>
<div class="visible-xs pull-right">
<button type="button" class="btn btn-warning" title=""  
      data-container="body" data-toggle="popover" data-placement="bottom" 
      data-content='Signed in as {$fullname}|<a href="/log/out">Logout</a>"' style="width:50px;">
      <span class="glyphicon glyphicon-user" style=""></span>
   </button>
</div>
  <script>$(function () 
      { $("[data-toggle='popover']").popover(
        {
          html:true
        });
      });
   </script>