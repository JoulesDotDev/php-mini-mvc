<?php

Component("BaseHeader", ["title" => "Home"]);

$email = $data->email ?? "";
?>

<h1>Your Email is</h1>
<h2><?= $email ?></h2>

<?php

Component("BaseFooter");
