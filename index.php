<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    
    <title>ExileInfo</title>
    <meta name="description" content="Stats about current path of exile league.">
    <meta name="author" content="Kaic Bastidas">
    
    <!-- jQuery -->
    <script  src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
    <script>
      function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
      }
    </script>
    <script>
        function sc_ascendancies() {
            document.getElementById("content").innerHTML='<iframe class="col-md-12" src="sc_ascendancies.php" frameborder="0" scrolling="no" onload="resizeIframe(this)"></iframe>';
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="container">
            <a class="btn btn-default" href ="#" onclick="sc_ascendancies()">SC Ascendancies</a>
        </div>
        <div class="col-md-12" id ="content"> </div>
    </div>
</body>
</html>