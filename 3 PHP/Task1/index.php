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
        Task1
    </title>
</head>
<body>
<div class="container">
    <form id="emailForm" method="post" onsubmit="send()">
        <input type="text" name="subject" placeholder="Enter subject:" required>
        <input type="text" name="email" placeholder="Enter e-mail:" required>
        <textarea rows="10" cols="50" name="message" placeholder="Enter message:"></textarea>
        <input style = "width: 50%" type="submit" value="Send">
    </form>
</div>
<script>
    function send() {
        var message = $('#emailForm').serialize();
        $.ajax({
            type: 'POST',
            url: 'send.php',
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




