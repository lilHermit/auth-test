<?php

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int             $id
 * @property string          $first_name
 * @property string|null     $last_name
 * @property string          $email
 * @property string          $password
 * @property int             $group_id
 * @property bool            $enabled
 * @property bool|null       $force_password_change
 * @property FrozenTime|null $modified
 * @property FrozenTime|null $created
 *
 * @property Group           $group
 */
class User extends Entity {
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'password' => true,
        'group_id' => true,
        'enabled' => true,
        'force_password_change' => true,
        'modified' => true,
        'created' => true,
        'group' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * Only hash the password if it is not zero length
     *
     * @param string $password Password to use
     *
     * @return string|null
     */
    protected function _setPassword($password) {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }

        return null;
    }

    /**
     * Returns full name
     *
     * @return string
     */
    protected function _getFullName() {
        return implode(' ', array_filter([$this->_properties['first_name'], $this->_properties['last_name']]));
    }
}
