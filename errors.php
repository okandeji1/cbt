<?php if(count($errors) > 0 ) : ?>
  <div class="alert alert-danger">
    <?php foreach($errors as $error) : ?>
     <p><?php echo $error ?></p>
     <?php endforeach ?>
  </div>

<?php endif ?>
<!-- Success -->
<?php if(count($success) > 0 ) : ?>
  <div class="alert alert-success">
    <?php foreach($success as $msg) : ?>
     <p><?php echo $msg ?></p>
     <?php endforeach ?>
  </div>

<?php endif ?>