<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

?>
<div id="login">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 text-center mt-4">
            <?= $this->Flash->render('auth'); ?>
            <?= $this->Form->create(); ?>
            <fieldset>
                <legend>
                    <?= __('Please login to access the admin area'); ?>
                </legend>
                <?php
                echo $this->Form->control('email', [
                    'label' => false,
                    'placeholder' => 'Email',
                    'title' => 'Enter your email address'
                ]);

                echo $this->Form->control('password', [
                    'label' => false,
                    'placeholder' => 'Password',
                    'title' => 'Enter your password'
                ]);
                ?>
            </fieldset>
            <?php
            echo $this->Form->submit('Login', ['class' => 'btn-block mb-3', 'size' => 'lg', 'secondary' => false, 'outline' => true]);
            echo $this->Form->end(); ?>
        </div>
    </div>
</div>
