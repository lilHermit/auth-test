<?php

namespace App\Controller;

use App\Model\Entity\User;
use Cake\Event\Event;
use Cake\Http\Response;

class UsersController extends AppController {

    public function beforeFilter(Event $event) {

        $this->Authentication->allowUnauthenticated(['login']);
        return parent::beforeFilter($event);
    }

    /**
     * Handle Admin login
     *
     * @return Response|null
     */
    public function login() {
        /**
         * @var User $identity
         */
        if ($this->getRequest()->is('post')) {
            $identity = $this->getUser();
            if ($identity) {
                $referer = $this->getRequest()->getQuery('referer');
                return $this->redirect($referer ? $referer : $this->getRequest()->referer());
            } else {
                $this->Flash->error(__('Email and/or password are incorrect'), [
                    'key' => 'auth'
                ]);
            }
        } else {
            if ($this->Authentication->getResult()->isValid()) {
                return $this->redirect(['_name' => 'home']);
            }
        }

        return null;
    }

    /**
     * Handle logout and redirect
     *
     * @return Response|null
     */
    public function logout() {
        return $this->redirect($this->Authentication->logout());
    }
}
