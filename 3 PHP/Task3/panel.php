<?php

require_once('model/HumanManager.php');
require_once('model/Human.php');

if (isset($_FILES['file']))
{
    $json = file_get_contents($_FILES['file']['tmp_name']);
    $humanManager = parseJson($json);
    $data = serialize($humanManager->getHumans());

    //иллюстрация всех методов HumanManager

    $humanManager -> show();
    //добавление человека с параметрами фио, возраст и должность
    $humanManager -> addHuman(new Human("Ivanov I.I.", "65", "programmer"));
    $humanManager -> show();
    //удаление человека, чье поле возраст равно 65
    $humanManager -> deleteHuman("age", "65");
    $humanManager -> show();
    //очистка текущего состояния
    $humanManager -> clear();
    $humanManager -> show();
    //запись текущего состояния в файл на сервере
    //(тестировать, закомментировав предыдущие методы)
    $humanManager -> updateFile();
}

if (isset($_POST['type']))
{
    $humanManager = unserialize($_POST['data']);
    switch ($_POST['type']) {
        case "add":
            add($humanManager);
            break;
        case "delete":
            delete($humanManager, $_POST['field'], $_POST['meaning']);
            break;
        case "clear":
            clear($humanManager);
            break;
        case "write":
            write($humanManager);
            break;
        case "show":
            showAll($humanManager);
            break;
    }
}

function showAll(HumanManager $humanManager)
{
    $humanManager->show();
}

function add(HumanManager $humanManager)
{
    $humanManager->addHuman(new Human($_POST['fio'], $_POST['age'], $_POST['profession']));
}

function delete(HumanManager $humanManager, $field, $meaning)
{
    $humanManager->deleteHuman($field, $meaning);
}

function clear(HumanManager $humanManager)
{
    $humanManager->clear();
}

function write(HumanManager $humanManager)
{
    $humanManager->updateFile();
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

    return $humanManager;
}?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            width: 30%;
            margin-left: 35%;
        }
        input{
            margin-bottom: 10px;
            align-content: center;
            width: 100%;
        }
        textarea{
            margin-bottom: 10px;
        }
    </style>
    <script src="script/jquery.js"></script>
    <title>
        Task3
    </title>
</head>
<body>
<div class="container">
    Display
    <form id="showForm" method="post" onsubmit="send(this.id)">
        <input type="hidden" name="type" value="show">
        <input type="hidden" name="data" value=<?php echo $data?>>
        <input style = "width: 50%" type="submit" value="Send">
    </form>
</div>
<div class="container">
    Add human
    <form id="addForm" method="post" onsubmit="send(this.id)">
        <input type="text" name="fio" placeholder="Enter fio:" required>
        <input type="text" name="age" placeholder="Enter age:" required>
        <input type="text" name="profession" placeholder="Enter profession:" required>
        <input type="hidden" name="type" value="add">
        <input type="hidden" name="data" value=<?php echo $data?>>
        <input style = "width: 50%" type="submit" value="Send">
    </form>
</div>

<div class="container">
    Delete human
    <form id="deleteForm" method="post" onsubmit="send(this.id)">
        <input type="text" name="fio" placeholder="Enter field:" required>
        <input type="text" name="age" placeholder="Enter meaning:" required>
        <input type="hidden" name="type" value="delete">
        <input type="hidden" name="data" value=<?php echo $data?>>
        <input style = "width: 50%" type="submit" value="Send">
    </form>
</div>

<div class="container">
    Clear
    <form id="clearForm" method="post" onsubmit="send(this.id)">
        <input type="hidden" name="type" value="clear">
        <input type="hidden" name="data" value=<?php echo $data?>>
        <input style = "width: 50%" type="submit" value="Send">
    </form>
</div>

<div class="container">
    Write
    <form id="writeForm" method="post" onsubmit="send(this.id)">
        <input type="hidden" name="type" value="write">
        <input type="hidden" name="data" value=<?php echo $data?>>
        <input style = "width: 50%" type="submit" value="Send">
    </form>
</div>
<script>
    function send(id) {
        var message = $('#' + id).serialize();
        $.ajax({
            type: 'POST',
            url: 'panel.php',
            data: message,
            success: function(data) {
                alert(data);
            },
            error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
    }
</script>
</body>
</html>





