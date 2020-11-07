<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ConsoleLog Entity
 *
 * @property int $id
 * @property string $page_id
 * @property string $level
 * @property string $message
 * @property int|null $line_number
 * @property int|null $column_number
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Page $page
 */
class ConsoleLog extends Entity
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
        'page_id' => true,
        'level' => true,
        'message' => true,
        'line_number' => true,
        'column_number' => true,
        'created' => true,
        'page' => true,
    ];
}
