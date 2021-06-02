<?php
	$except = ['show'];
    return [
        'branchs' => [
            'name' => 'branchs',
            'except' => $except,
            'multi_del' => true,
        ],
        'brand' => [
            'name' => 'brand',
            'except' => $except,
            'multi_del' => false,
        ],
        'products' => [
            'name' => 'products',
            'except' => $except,
            'multi_del' => true,
        ],
        'comments' => [
            'name' => 'comments',
            'except' => $except,
            'multi_del' => true,
        ],
        'filter' => [
            'name' => 'filter',
            'except' => $except,
            'multi_del' => true,
        ],
        'coupons' => [
            'name' => 'coupons',
            'except' => $except,
            'multi_del' => false,
        ],
	];