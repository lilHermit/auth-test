<?php

namespace App\Controller;

use App\Model\Entity\User;
use ArrayAccess;
use Authentication\Controller\Component\AuthenticationComponent;
use Cake\Controller\Component\FlashComponent;
use Cake\Controller\Controller;
use Cake\Controller\Exception\SecurityException;
use Cake\Event\Event;

/**
 *
 * @property FlashComponent          Flash
 * @property AuthenticationComponent Authentication
 */
class AppController extends Controller {

    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Authentication.Authentication', [
            'logoutRedirect' => ['_name' => 'login']
        ]);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        $this->loadComponent('Security');
    }

    public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

        if (!$this->isOpen() && !$this->Authentication->getResult()->isValid()) {

            return $this->redirect($this->Authentication->getConfig('logoutRedirect') + [
                    '?' => ['referer' => $this->request->getUri()->getPath()]
                ]);
        }

        $this->Security->setConfig('blackHoleCallback', 'blackhole');
    }

    public function blackhole($type, SecurityException $exception)
    {
        if ($exception->getMessage() === 'Request is not SSL and the action is required to be secure') {
            // Reword the exception message with a translatable string.
            $exception->setMessage(__('Please access the requested page through HTTPS'));
        }

        // Re-throw the conditionally reworded exception.
        throw $exception;

        // Alternatively, handle the error, e.g. set a flash message &
        // redirect to HTTPS version of the requested page.
    }

    /**
     * Determine if this action should be open
     *
     * @return bool
     */
    protected function isOpen() {
        return in_array($this->request->getParam('action'), $this->Authentication->getUnauthenticatedActions());
    }

    /**
     * Returns the currently authenticated user
     *
     * @return User|ArrayAccess|null
     */
    protected function getUser() {
        if ($this->Authentication->getIdentity() !== null) {
            return $this->Authentication->getIdentity()->getOriginalData();
        }

        return null;
    }

    /**
     * Determine if we are logged in
     *
     * @return bool
     */
    protected function isLoggedIn() {
        return $this->Authentication->getResult()->isValid();
    }
}
