<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    /**
     * 'welcome' => 'Добро пожаловать, <b>:name</b>!',

    "failed" => "Неверный логин или пароль.",
    "password" => "Неверный пароль.",
    "throttle" =>
    "Слишком много попыток входа. Пожалуйста, попробуйте еще раз через :seconds секунд.",

    "labels" => [
    'name' => 'Имя пользователя',
    'email' => 'Электронная почта',
    'password' => 'Пароль',
    'confirm_password' => 'Подтверждение пароля',
    'remember' => 'Запомнить меня',
    'forgot' => 'Забыли пароль?',
    'already_registered' => 'Уже зарегистрированы?',
    'logout' => 'Выйти',
    ],
    "login" => [
    "title" => "Вход",
    ],
    "register" => [
    "title" => "Регистрация",
    ],
    "forgot_password" => [
    "description" => "Забыли свой пароль? Без проблем. Просто сообщите нам свой адрес электронной почты, и мы отправим вам ссылку для сброса пароля, которая позволит вам выбрать новый.",
    "submit" => "Отправить ссылку для сброса пароля",
    ],
    "reset_password" => [
    "submit" => "Сбросить пароль",
    ],
    "confirm_password" => [
    "description" => "Это защищенная область. Пожалуйста, подтвердите свой пароль, чтобы продолжить.",
    "submit" => "Подтвердить пароль",
    ],
    "verify_email" => [
    "description" => "Спасибо за регистрацию! Перед тем, как продолжить, пожалуйста, проверьте свою электронную почту на наличие ссылки для подтверждения.",
    "new_link" => "Мы отправили вам новую ссылку для подтверждения.",
    "resend" => "Если вы не получили письмо",
    ]
     */
    'welcome' => 'Tere tulemast, <b>:name</b>!',

    'failed' => 'Need kredentsiaalid ei klapi meie andmetega.',
    'password' => 'Sisestatud parool on vale.',
    'throttle' => 'Liiga palju sisselogimise katseid. Palun proovi uuesti :seconds sekundi pärast.',

    'labels' => [
        'name' => 'Nimi',
        'email' => 'E-post',
        'password' => 'Parool',
        'confirm_password' => 'Kinnita parool',
        'remember' => 'Jäta mind meelde',
        'forgot' => 'Unustasid parooli?',
        'already_registered' => 'Juba registreeritud?',
        'logout' => 'Logi välja',
    ],
    'login' => [
        'title' => 'Logi sisse',
    ],
    'register' => [
        'title' => 'Registreeri',
    ],
    'forgot_password' => [
        'description' => 'Unustasid parooli? Pole probleemi. Lihtsalt ütle meile oma e-posti aadress, ja saadame sulle parooli lähtestamise lingi, mis võimaldab sul valida uue.',
        'submit' => 'Saada parooli lähtestamise link',
    ],
    'reset_password' => [
        'submit' => 'Lähtesta parool',
    ],
    'confirm_password' => [
        'description' => 'See on kaitstud ala. Palun kinnita oma parool, et jätkata.',
        'submit' => 'Kinnita parool',
    ],
    'verify_email' => [
        'description' => 'Tere tulemast! Enne kui jätkate, palun kontrollige oma e-posti, kas meil on kinnituslink.',
        'new_link' => 'Me saatsime teile uue kinnituslinki.',
        'resend' => 'Kui te ei saanud e-kirja',
    ]
];
