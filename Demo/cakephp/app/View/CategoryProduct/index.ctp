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

<?php foreach ($CategoryProductList as $cp): ?>
<tr>
    <div id="info">
        <h3><?php echo 'Id de produucto: '.$cp['CategoryProduct']['product_id']; ?></h3>
		<h3><?php echo 'Id de categoría: '.$cp['CategoryProduct']['category_id']; ?></h3>
        <div>&nbsp;</div>
    </div>
</tr>
<?php endforeach; ?>
<?php unset($CategoryProductList); ?>
</html>
