<?php
namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * Group Entity
 *
 * @property int             $id
 * @property string          $name
 * @property FrozenTime|null $modified
 * @property FrozenTime|null $created
 *
 * @property User[]          $users
 */
class Group extends Entity
{
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
        'name' => true,
        'modified' => true,
        'created' => true,
        'users' => true
    ];
}
