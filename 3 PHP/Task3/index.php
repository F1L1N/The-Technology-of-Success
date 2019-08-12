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
    </style>
    <title>Task3</title>
</head>
<body>
<div class="container">
    <form action="load.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file"/>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>