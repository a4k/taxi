<?php

require "head.php";

global $USER;
if (!isset($USER)):?>
    <script>window.location.href = '/login.php';</script>
    <? die();
endif;
?>


<? if (User::isDriver($USER)): ?>
    <? include App::getTemplatesDir() . '/driver_panel.php'; ?>

<? elseif (User::isAdmin($USER)): ?>
    <? include App::getTemplatesDir() . '/admin_panel.php'; ?>

<? else: ?>
    <? include App::getTemplatesDir() . '/client_panel.php'; ?>

<? endif; ?>

<?
require "footer.php";

?>