<?php

return [
    'guard' => 'web',

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    'features' => [
        'registration' => true, // 登録機能を有効化
        'login' => true,         // ログイン機能を有効化
        'resetPasswords' => true,// パスワードリセット機能を有効化
    ],
];
