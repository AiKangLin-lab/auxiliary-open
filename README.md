# 辅助开放工具包 by CollinAI

`auxiliary-open`是一个多功能工具包，旨在简化PHP开发过程，提供一系列基本的助手函数，以提高生产力和简化工作流程。

## 特性

- **数据操作**：通过直观的函数简化复杂的数据处理任务。
- **数组处理**：通过扩展的功能增强数组操作。
- **字符串操作**：使用高级字符串处理技术进行高效处理。
- **开发效率**：通过现成的解决方案节省时间并减少样板代码。

## 安装

通过Composer安装包：

```bash
composer require collinai/auxiliary-open
```

## 使用

这里有一个快速入门示例：

# Tree 类使用指南

`Tree`类是一个用于处理树形数据的工具类，它提供了多种方法来处理和转换树形结构。本指南将介绍如何使用`init`和`buildTree`这两个方法。

## 初始化数据

在使用`Tree`类进行任何操作之前，您需要先初始化数据。这可以通过`init`方法完成。

### init 方法

`init`方法用于初始化树形数据和配置，它接受三个参数：数据数组、父节点字段名和主键字段名。

```php
use Collinai\AuxiliaryOpen\Tree;

// 示例数据数组
$data = [
    ['id' => 1, 'parent_id' => 0, 'name' => '节点 1'],
    ['id' => 2, 'parent_id' => 1, 'name' => '节点 1.1'],
    ['id' => 3, 'parent_id' => 1, 'name' => '节点 1.2'],
    ['id' => 4, 'parent_id' => 0, 'name' => '节点 2'],
    ['id' => 5, 'parent_id' => 4, 'name' => '节点 2.1']
];

// 实例化Tree类
$tree = new Tree();

// 初始化数据
$tree->init($data, 'parent_id', 'id');
```

这里的数据数组`$data`包含了树形结构的信息，每个元素都有一个`id`、`parent_id`和其他信息（例如`name`）。

## 构建树形结构

一旦数据初始化完成，您可以使用`buildTree`方法来构建树形结构。

### buildTree 方法

`buildTree`方法接受一个参数：根节点ID（默认为0），它返回一个包含树形结构的数组。

```php
// 构建树形结构
$treeStructure = $tree->buildTree();

// 输出结果查看
print_r($treeStructure);
```

这个方法会遍历初始化时传入的数据数组，根据`parent_id`和`id`之间的关系来构建出树形结构。

## 贡献

欢迎贡献！请随时提交拉取请求或开放问题以改进库。

## License

This project is licensed under the MIT License - see the LICENSE file for details.
