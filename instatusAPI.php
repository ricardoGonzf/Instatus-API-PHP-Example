<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"/>
    <title>Instatus API PHP Example</title>
    <style media="screen">
      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');
      body {
        font-family: 'Roboto', sans-serif;
      }

      .container {
        padding-right: 150px;
        padding-left: 150px;
        margin-right: auto;
        margin-left: auto;
      }
      
      h1.header {
        text-align: left;
        font-size: 300%;
      }
      
      a.link {
        color: BLACK;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1 class="header">Components</h1>
      <?php
        $curl = curl_init("https://api.instatus.com/v1/[YOUR PAGE ID]/components");

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/json",
          "Authorization: Bearer [YOUR API KEY]"
        ));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $json_res = curl_exec($curl);

        $array_res = json_decode($json_res);
      ?>
      <div class="components">
        <?php
          foreach ($array_res as $component) {
        ?>
        <div class="server">
          <h2><?php echo $component->name; ?></h2>
          <p>
            Group: <?php echo $component->group->name ?>
          </p>
          <p>
            Description: <?php echo $component->description; ?>
          </p>
          <a href="#" class="link">
            <?php
              if ($component->status == "OPERATIONAL") {
                echo "Operational";
              } elseif ($component->status == "UNDERMAINTENANCE") {
                echo "Under Maintenance";
              } elseif ($component->status == "PARTIALOUTAGE") {
                echo "Partial Outage";
              } elseif ($component->status == "DEGRADEDPERFORMANCE") {
                echo "Degraded Perfomance";
              } elseif ($component->status == "MINOROUTAGE") {
                echo "Minor Outage";
              } elseif ($component->status == "MAJOROUTAGE") {
                echo "Major Outage";
              } else {
                echo $component->status;
              }
            ?>
          </a>
        </div>
        <br><br>
        <?php
          }
        ?>
      </div>
    </div>
  </body>
</html>
