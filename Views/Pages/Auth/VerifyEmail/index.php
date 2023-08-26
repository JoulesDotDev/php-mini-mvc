<?php

$component = "";

if (_CONTEXT("resend")) {
    $component = "Resend";
} else {
    $component = _CONTEXT("valid") ? "Valid" : "Invalid";
}

Component($component, null, "Auth/VerifyEmail");
