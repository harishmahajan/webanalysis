<div class="row" style="margin-top:70px;">
    <div class="col-lg-6">
        <div class="well bs-component">
            <form class="form-horizontal" method="post" action="/log/in">
                <fieldset>

                    <legend>Register</legend>

                    {if $register_error}
                        <div class="form-group">
                            <p class="text-center text-danger">
                                {$register_error}
                            </p>
                        </div>
                    {/if}

                    <div class="form-group">
                        <label for="inputFirstname" class="col-lg-3 control-label">First Name</label>
                        <div class="col-lg-9">
                            <input type="text" name="firstname" class="form-control" id="inputFirstname" placeholder="First Name" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLastname" class="col-lg-3 control-label">Last Name</label>
                        <div class="col-lg-9">
                            <input type="text" name="lastname" class="form-control" id="inputLastname" placeholder="Last Name" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-3 control-label">Email</label>
                        <div class="col-lg-9">
                            <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-3 control-label">Password</label>
                        <div class="col-lg-9">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </fieldset>
                <input type="hidden" name="action" value="register">
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="bs-component">
            <form class="form-horizontal" method="post" action="/log/in">
                <fieldset>

                    {if $login_error}
                        <div class="form-group">
                            <p class="text-center text-danger">
                                {$login_error}
                            </p>
                        </div>
                    {/if}

                    <legend>Log in</legend>

                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-3 control-label">Email</label>
                        <div class="col-lg-9">
                            <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-3 control-label">Password</label>
                        <div class="col-lg-9">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </fieldset>
                <input type="hidden" name="action" value="login">
            </form>
        </div>
    </div>
</div>