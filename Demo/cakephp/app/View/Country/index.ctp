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


    <h3><?php echo "Countries" ?></h3>
    <?php foreach ($countries as $country): ?>
            <tr>
                 <div id = "info">
                     <?php echo $country['Country']['country_name']; ?>

                 </div>
            </tr>
        <?php endforeach; ?>
    <?php unset($platforms); ?>
</html>