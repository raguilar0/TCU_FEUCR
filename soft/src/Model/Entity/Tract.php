<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tract Entity.
 *
 * @property int $id
 * @property int $number
 * @property \Cake\I18n\Time $date
 * @property \Cake\I18n\Time $deadline
 * @property \App\Model\Entity\Amount[] $amounts
 * @property \App\Model\Entity\Box[] $boxes
 * @property \App\Model\Entity\InitialAmount[] $initial_amounts
 * @property \App\Model\Entity\Invoice[] $invoices
 * @property \App\Model\Entity\Warehouse[] $warehouses
 */
class Tract extends Entity
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
