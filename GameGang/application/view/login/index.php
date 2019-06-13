<div class="container">
    <div class="loginContainer">
        <h3>This is the login page</h3>
        <div class="box">
            <form action="<?php echo URL; ?>login/doLogin" method="POST">
                <input type="text"      class="inputField"      name="username" placeholder="Username" value="" required  />
                <input type="password"  class="inputField"      name="password" placeholder="Password" value="" required />
                <input type="submit"    class="submitButton"    name="submit_do_login" value="Login" />
            </form>
        </div>
        <a href="<?php echo URL; ?>login/register">Don't have an account?</a>
    </div>
</div>