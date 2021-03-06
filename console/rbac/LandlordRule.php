<?php

namespace console\rbac;

use yii\rbac\Item;
use yii\rbac\Rule;

/**
 * Проверяем authorID на соответствие с пользователем, переданным через параметры
 */
class LandlordRule extends Rule
{
    public $name = 'isLandlord';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated width.
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params): bool
    {
        return isset($params['rental']) && $params['rental']->user_id == $user;
    }
}