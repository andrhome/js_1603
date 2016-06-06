<?php
return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'bloger' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Bloger',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'manager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Manager',
        'children' => array(
            'user',          // позволим админу всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Admin',
        'children' => array(
            'manager',          // позволим админу всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
);