<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php if($this->Session->read("Auth.User.role") == 'admin')
      {
        include("headeradmin.ctp");
      }
      else
      {
        include("header.ctp");
      }
?>

<h1></h1>
    <?php

    ?>
</body>
</html>
