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

    <?php foreach ($platforms as $platform): ?>
            <tr>
                 <div id="info">
                    <h3><?php echo $platform['Platform']['name']; ?></h3>
                     <div>&nbsp;</div>
                 </div>
            </tr>
        <?php endforeach; ?>
    <?php unset($platforms); ?>
</html>