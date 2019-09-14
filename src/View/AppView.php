<?php

namespace App\View;

use App\View\Helper\AppHelper;
use Authentication\View\Helper\IdentityHelper;
use Cake\View\View;

/**
 * @property IdentityHelper Identity
 * @property AppHelper      App
 */
class AppView extends View {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->loadHelper('Authentication.Identity');
    }
}
