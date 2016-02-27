<!DOCTYPE html>
<html>

<?php if($this->Session->read("Auth.User.role") == 'admin')
      {
        include("headeradmin.ctp");
      }
      else
      {
        include("header.ctp");
      }
?>

	<head>
		<title>Lista de Deseos</title>
	</head>
	<body>
		<?php include("header.ctp");?>
	</body>
</html>