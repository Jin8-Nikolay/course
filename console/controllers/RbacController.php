<?php

namespace console\controllers;


use console\rbac\LandlordRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "creatRent"
        $creatRent = $auth->createPermission('creatRent');
        $creatRent->description = 'Создавать аренду';
        $auth->add($creatRent);

        // добавляем разрешение "goAdminPanel"
        $goAdminPanel = $auth->createPermission('goAdminPanel');
        $goAdminPanel->description = 'Войти в админку';
        $auth->add($goAdminPanel);

        // добавляем разрешение "updatePost"
        $updateRent = $auth->createPermission('updateRent');
        $updateRent->description = 'Обновлять аренду';
        $auth->add($updateRent);

        // добавляем разрешение "viewRent"
        $viewRent = $auth->createPermission('viewRent');
        $viewRent->description = 'Просмотреть аренду';
        $auth->add($viewRent);

        // добавляем разрешение "deleteRent"
        $deleteRent = $auth->createPermission('deleteRent');
        $deleteRent->description = 'Удалить аренду';
        $auth->add($deleteRent);

        // добавляем роль "landlord" и даём роли разрешение "creatRent", "goAdminPanel"
        $landlord = $auth->createRole('landlord');
        $auth->add($landlord);
        $auth->addChild($landlord, $creatRent);
        $auth->addChild($landlord, $goAdminPanel);

        // добавляем роль "guest"
        $guest = $auth->createRole('guest');
        $auth->add($guest);

        // добавляем роль "admin" и даём роли разрешение "updateRent"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $viewRent);
        $auth->addChild($admin, $deleteRent);
        $auth->addChild($admin, $updateRent);
        $auth->addChild($admin, $landlord);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        // $auth->assign($admin, 1);
        // add the rule
        $rule = new LandlordRule;
        $auth->add($rule);

        // добавляем разрешение "updateOwnPost" и привязываем к нему правило.
        $updateOwnRental = $auth->createPermission('updateOwnRental');
        $updateOwnRental->description = 'Обновить свою аренду';
        $updateOwnRental->ruleName = $rule->name;
        $auth->add($updateOwnRental);

        // добавляем разрешение "updateOwnPost" и привязываем к нему правило.
        $deleteOwnRental = $auth->createPermission('deleteOwnRental');
        $deleteOwnRental->description = 'Удалить свою аренду';
        $deleteOwnRental->ruleName = $rule->name;
        $auth->add($deleteOwnRental);

        // добавляем разрешение "updateOwnPost" и привязываем к нему правило.
        $viewOwnRental = $auth->createPermission('viewOwnRental');
        $viewOwnRental->description = 'Просмотреть свою аренду';
        $viewOwnRental->ruleName = $rule->name;
        $auth->add($viewOwnRental);

        // "updateOwnPost" будет использоваться из "updatePost"
        $auth->addChild($updateOwnRental, $updateRent);
        $auth->addChild($deleteOwnRental, $deleteRent);
        $auth->addChild($viewOwnRental, $viewRent);

        // разрешаем "автору" обновлять его аренды
        $auth->addChild($landlord, $updateOwnRental);
        $auth->addChild($landlord, $deleteOwnRental);
        $auth->addChild($landlord, $viewOwnRental);
    }
}