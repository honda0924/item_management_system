<?php echo e($inquiry["inquirer_name"]); ?>様
以下の内容でお問い合わせを承りました。

email:<?php echo e($inquiry["email"]); ?>

tel:<?php echo e($inquiry["tel"]); ?>

性別:<?php echo e($inquiry["gender"]); ?>

<?php if($inquiry["gender"]=="男性"): ?>
    趣味:<?php echo e($inquiry["hobby"]); ?>

<?php else: ?>
    特技:<?php echo e($inquiry["skill"]); ?>

<?php endif; ?>
お問い合わせ内容：<?php echo e($inquiry["inquiry_text"]); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/inquiry/mail.blade.php ENDPATH**/ ?>