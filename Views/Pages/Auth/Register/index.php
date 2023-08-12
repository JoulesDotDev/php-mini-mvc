<?php
$success = _CONTEXT("registered") ?? false;

if ($success) {
    Component("Success");
} else {
    Component("Form");
}
