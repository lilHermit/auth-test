<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>


    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<?= $this->element('header'); ?>
<div class="container p-0 mb-5">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
<?= $this->element('footer'); ?>
</body>
</html>
