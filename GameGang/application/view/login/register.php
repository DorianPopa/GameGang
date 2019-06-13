<div class="container">
    <div class="loginContainer">
        <h3>This is the register page!</h3>
        <div class="box">
            <form action="<?php echo URL; ?>login/doRegister" method="POST">
                <input type="text"      class="inputField"      name="username" value="" placeholder="Username" required />
                <input type="password"  class="inputField"      name="password" value="" placeholder="Password" required />
                <input type="submit"    class="submitButton"    name="submit_do_register" value="Register" />
            </form>
        </div>
    </div>
</div>