<?php

require_once ROOT_DIR . "/Views/Layouts/BaseHeader.php";

?>

<form action="/register" method="POST">
    <input type="hidden" name="action" value="auth:register">

    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Username">

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Password">

    <button type="submit">Register</button>
</form>

<?php

require_once ROOT_DIR . "/Views/Layouts/BaseFooter.php";
