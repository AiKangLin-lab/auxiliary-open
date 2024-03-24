<?php

require "./vendor/autoload.php";

// 生成一个包含parent_id、id和value的数组
$myArray = [];

// 定义id的范围
$idRange = range(1, 10);

// 遍历id范围，为每个id生成一个随机的parent_id和value
foreach ($idRange as $id) {
    // 随机选择一个parent_id
    $randomParentId = $idRange[array_rand($idRange)];

    // 生成一个随机的value
    $randomValue = rand(1, 100);

    // 构造数组项
    $item = [
        'parent_id' => $randomParentId,
        'id' => $id,
        'value' => $randomValue
    ];

    // 将项添加到数组中
    $myArray[] = $item;

}

$myArray[] = [
    'parent_id' => 0,
    'id' => 11,
    'value' => 11
];
// 打印数组


$data = [
    ['parent_id' => 0, 'id' => 1, 'value' => 'A'],
    ['parent_id' => 1, 'id' => 2, 'value' => 'B'],
    ['parent_id' => 2, 'id' => 3, 'value' => 'C'],
    ['parent_id' => 3, 'id' => 4, 'value' => 'D'],
    ['parent_id' => 4, 'id' => 5, 'value' => 'E'],
    ['parent_id' => 0, 'id' => 6, 'value' => 'F']
];
$tree = new \Collin\AuxiliaryOpen\Tree();

$tree->init($data);

$bbbb = $tree->getParentDataById(5,false);
//$bb = $tree->getDescendantsById(4,true);
//$cc = $tree->buildTree();
//
//
//$tree->init($bb);
//
//$bbbb = $tree->buildTree(4);
print_r($bbbb);
exit;
