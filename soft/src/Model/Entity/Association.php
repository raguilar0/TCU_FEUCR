<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Association Entity.
 *
 * @property int $id
 * @property string $acronym
 * @property string $name
 * @property string $location
 * @property string $schedule
 * @property int $authorized_card
 * @property int $enable
 * @property int $headquarter_id
 * @property \App\Model\Entity\Headquarters $headquarters
 * @property \App\Model\Entity\Amount[] $amounts
 * @property \App\Model\Entity\Box[] $boxes
 * @property \App\Model\Entity\InitialAmount[] $initial_amounts
 * @property \App\Model\Entity\Invoice[] $invoices
 * @property \App\Model\Entity\SavingAccount[] $saving_accounts
 * @property \App\Model\Entity\Saving[] $savings
 * @property \App\Model\Entity\Surplus[] $surpluses
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Warehouse[] $warehouses
 */
class Association extends Entity
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
        '*' => true,
        'id' => false,
    ];
}
