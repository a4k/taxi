<?php

require_once "app/App.php";
require_once "app/Store.php";
require_once "app/User.php";

$SITE_DIR = __DIR__;
$USER = $_COOKIE['user'];

$SETTINGS = include 'config/config.php';
$APP = new App($SETTINGS);

$DB = App::getConnection();
$STORE = new Store();
$RESULT = $STORE->getTables();
$RESULT['user'] = $_COOKIE['user'];

if (isset($_GET['api']) && $_GET['api'] === 'all') {

    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json;');
    print_r(json_encode($RESULT));
    die();
}


if (isset($_POST['api']) && $_POST['api'] === 'update') {
    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json;');

    $data = json_decode($_POST['data'], true);

    if (isset($data) && is_array($data)) {

        // login
        User::auth($data['user']);

        // update data
        foreach ($data as $tableName => $rows) {

            if(!is_array($rows)) continue;

            foreach ($rows as $row) {
                if (isset($row['created_at']) && $row['created_at'] === 1) {
                    // create row

                    Store::createRow($row, $tableName);
                }

                if (isset($row['updated_at']) && $row['updated_at'] === 1) {
                    // update row

                    Store::updateRow($row, $tableName);

                }


            }
        }
    }
    print_r(json_encode(['status' => true]));
}
