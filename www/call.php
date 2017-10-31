<?php
require_once(__DIR__."/../vendor/autoload.php");
use Twilio\Rest\Client;

$tel =  filter_input(INPUT_POST,'tel',FILTER_SANITIZE_NUMBER_INT);
$msg =  filter_input(INPUT_POST,'msg',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if( $tel && $msg ){
    $sid   = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
    $token = 'YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY';
    $from  = '+819999999999'; 

$response = <<<EOL
<Response>
<Say voice="woman" language="ja-jp">{$msg}</Say>
</Response>
EOL;

    $twiml =  "http://twimlets.com/echo?Twiml=" . urlencode($response);

    $client = new Client($sid, $token);
    $call = $client->calls->create($tel,$from,array('url' => $twiml));
    $sid  = $call->sid;

}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twilio Test</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <h1>Twilio Test<img src="http://2.bp.blogspot.com/-1DVfCJhxpUY/UrlnDdbLpZI/AAAAAAAAcM0/tuotN_YtHVY/s800/denwa_business_woman.png" height=100></h1>
        <h2>Call</h2>
        <div class="form-group">
          <form action="/call.php" method="post">
            <label for="tel">Tel:</label><input class="form-control"  type="number" id="tel" name="tel" value="81"><br>
            <label for="msg">Msg:</label><input class="form-control"  type="text"   id="msg" name="msg" size=80 ><br>
            <input  class="btn btn-primary" type="submit" value="Call">
          </form>
        </div>
        <h2>Result</h2>
        <div class="col-md-6">
        ▼TWIML URL
        <pre>
<?php echo $twiml; ?>
        </pre>
        ▼SID
        <pre>
<?php echo $sid; ?>
        </pre>
        </div>
      </div>
    </div>
  </body>
</html>
