<?php

Component("BaseHeader", ["title" => "Verify Email"]);

function valid()
{
?>
    <h1>Email verified</h1>
    <p>You can now <a href="/login">login</a></p>
<?php
}

function invalid()
{
?>
    <h1>Invalid token</h1>
    <p>The token you provided is invalid or has expired.</p>
<?php
}

function resent()
{
?>
    <h1>Verification email resent</h1>
    <p>Please check your email for the verification link.</p>
<?php
}

if ($data["resent"] ?? false) {
    resent();
} else {
    $data["valid"] ? valid() : invalid();
}


Component("BaseFooter");
