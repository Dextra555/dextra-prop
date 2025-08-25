<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Property Approved</title>
</head>
<body style="font-family: Arial, sans-serif; color:#222;">
  <p>Hi <?php echo e($user_name); ?>,</p>
  <p>Your property <strong><?php echo e($property_title); ?></strong> has been approved and is now live.</p>
  <?php if(!empty($property_image)): ?>
  <p>
    <img src="<?php echo e($property_image); ?>" alt="<?php echo e($property_title); ?>" style="max-width: 100%; height: auto; border-radius: 6px;" />
  </p>
  <?php endif; ?>
  <?php if(!empty($property_url)): ?>
  <p>View it here: <a href="<?php echo e($property_url); ?>" target="_blank"><?php echo e($property_url); ?></a></p>
  <?php endif; ?>
  <p>Thank you for using <?php echo e(getcong('site_name')); ?>.</p>
</body>
</html>
<?php /**PATH C:\Users\USER\Documents\Dextra Properties\realestate.dextragroups.com\realestate.dextragroups.com\resources\views/emails/property_approved.blade.php ENDPATH**/ ?>