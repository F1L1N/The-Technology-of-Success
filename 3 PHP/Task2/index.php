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
	<script src="script/jquery.js"></script>
    <title>Task2</title>
</head>
<body>
    <div class="container">
        <form id="emailForm" method="post" onsubmit="check()">
            <input type="text" name="email" placeholder="Enter e-mail:" required>
            <input style = "width: 50%" type="submit" value="Check">
        </form>
    </div>
	<script>
        function check() {
            var message = $('#emailForm').serialize();
            $.ajax({
                type: 'POST',
                url: 'check.php',
                data: message,
                success: function(data) {
                    normalizeAnswer(data);

                },
                error:  function(xhr, str){
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            });
        }

        function normalizeAnswer(answer) {
            if (Boolean(Number(answer)))
            {
                alert("Right email address.");
            }
            else
            {
                alert("Wrong email address.");
            }
        }
	</script>
</body>
</html>