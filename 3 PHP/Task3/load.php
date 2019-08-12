<?php

require_once('model/HumanManager.php');
require_once('model/Human.php');

var_dump($_FILES['file']);
if (isset($_FILES['file']))
{
    parseJson(file_get_contents($_FILES['file']['tmp_name']));
}

function parseJson($json)
{
    $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($json, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST);

    $humanManager = new HumanManager();

    foreach ($jsonIterator as $key => $val) {
        if(is_array($val)) {
            $human = new Human($val["fio"], $val["age"], $val["profession"]);
            $humanManager->addHuman($human);
        }
    }

    //$humanManager->show();

//    $humanManager->deleteHuman("fio", "Joffrey Barateon");
    $humanManager->show();
    $humanManager->addHuman($human);
    $humanManager->updateFile($_FILES['file']['tmp_name']);
}