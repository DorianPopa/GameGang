<div class="container">
    <h3>This is the login page!</h3>
    <div class="box">
        <form action="<?php echo URL; ?>login/doLogin" method="POST">
            <label>Username</label>
            <input type="text" name="username" value="" required />
            <label>Password</label>
            <input type="password" name="password" value="" required />
            <input type="submit" name="submit_do_login" value="Submit" />
        </form>
    </div>

    <a href="<?php echo URL; ?>login/register">Don't have an account?</a>

</div>