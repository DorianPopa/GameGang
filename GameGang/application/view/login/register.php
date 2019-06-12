<div class="container">
    <h3>This is the register page!</h3>
    <div class="box">
        <form action="<?php echo URL; ?>login/doRegister" method="POST">
            <input type="text" name="username" value="" placeholder="Username" required />
            <input type="password" name="password" value="" placeholder="Password" required />
            <input type="submit" name="submit_do_register" value="Submit" />
        </form>
    </div>

</div>