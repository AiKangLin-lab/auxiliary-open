
# Auxiliary-Open by CollinAI

`auxiliary-open` is a versatile toolkit designed to ease the PHP development process, offering a range of essential helper functions that boost productivity and streamline workflows.

## Features

- **Data Manipulation**: Simplify complex data handling tasks with intuitive functions.
- **Array Handling**: Enhance array operations with extended functionalities.
- **String Operations**: Utilize advanced string manipulation techniques for efficient processing.
- **Development Efficiency**: Save time and reduce boilerplate code with ready-to-use solutions.

## Installation

Install the package via Composer:

```bash
composer require collinai/auxiliary-open
```

## Usage

Here's a quick example to get you started:

# Tree 类使用指南

`Tree`类是一个用于处理树形数据的工具类，提供了多种方法来处理和转换树形结构。本指南将介绍如何使用`init`和`buildTree`两个方法。

## 初始化数据

在使用`Tree`类进行任何操作之前，你需要先初始化数据。这可以通过`init`方法完成。

### init 方法

`init`方法用于初始化树形数据和配置，接受三个参数：数据数组、父节点字段名和主键字段名。

```php
use Collinai\AuxiliaryOpen\Tree;

// 示例数据数组
$data = [
    ['id' => 1, 'parent_id' => 0, 'name' => 'Node 1'],
    ['id' => 2, 'parent_id' => 1, 'name' => 'Node 1.1'],
    ['id' => 3, 'parent_id' => 1, 'name' => 'Node 1.2'],
    ['id' => 4, 'parent_id' => 0, 'name' => 'Node 2'],
    ['id' => 5, 'parent_id' => 4, 'name' => 'Node 2.1']
];

// 实例化Tree类
$tree = new Tree();

// 初始化数据
$tree->init($data, 'parent_id', 'id');
```

这里，数据数组`$data`包含了树形结构的信息，每个元素都有一个`id`、`parent_id`和其他信息（如`name`）。

## 构建树形结构

一旦数据初始化完成，你可以使用`buildTree`方法来构建树形结构。

### buildTree 方法

`buildTree`方法接受一个参数：根节点ID（默认为0），返回一个包含树形结构的数组。

```php
// 构建树形结构
$treeStructure = $tree->buildTree();

// 输出结果查看
print_r($treeStructure);
```

这个方法会遍历初始化时传入的数据数组，根据`parent_id`和`id`的关系构建出树形结构。

## 结果示例

构建树形结构后，你将得到如下所示的数组：

```php
Array
(
    [0] => Array
        (
            [id] => 1
            [parent_id] => 0
            [name] => 'Node 1'
            [children] => Array
                (
                    [0] => Array
                        (
                            [id] => 2
                            [parent_id] => 1
                            [name] => 'Node 1.1'
                        )
                    [1] => Array
                        (
                            [id] => 3
                            [parent_id] => 1
                            [name] => 'Node 1.2'
                        )
                )
        )
    [1] => Array
        (
            [id] => 4
            [parent_id] => 0
            [name] => 'Node 2'
            [children] => Array
                (
                    [0] => Array
                        (
                            [id] => 5
                            [parent_id] => 4
                            [name] => 'Node 2.1'
                        )
                )
        )
)
```
## Contributing

Contributions are welcome! Please feel free to submit pull requests or open issues to improve the library.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
