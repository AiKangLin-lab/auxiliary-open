<?php
// +----------------------------------------------------------------------
// | Success, real success,
// | is being willing to do the things that other people are not.
// +----------------------------------------------------------------------
// | Author:    Collin Ai <ailin1219@foxmail.com>
// +----------------------------------------------------------------------
// | FileName:  Tree.php
// +----------------------------------------------------------------------
// | Year:      2024
// +----------------------------------------------------------------------
namespace Collinai\AuxiliaryOpen;

/**
 * 树形数据处理类
 *
 * Class Tree
 * @package Collinai\AuxiliaryOpen
 */
class Tree
{
    /**
     * @var array 储存树形数据
     */
    public array $data = [];

    /**
     * @var string 父节点的字段名
     */
    public string $pidName = 'parent_id';

    /**
     * @var string 节点的主键字段名
     */
    public string $pkName = 'id';

    /**
     * @var string 子节点的键名
     */
    public string $children = 'children';

    /**
     * 初始化树形数据和配置。
     *
     * @param array $data 初始数据数组
     * @param string $pidName 父节点字段名
     * @param string $pkName 主键字段名
     * @return self 返回自身实例以支持链式调用
     */
    public function init (array $data = [], string $pidName = '', string $pkName = ''): self
    {
        $this->data = $data;
        if (!empty($pidName)) {
            $this->pidName = $pidName;
        }
        if (!empty($pkName)) {
            $this->pkName = $pkName;
        }
        return $this;
    }

    /**
     * 根据父节点ID获取其直接子节点数组。
     *
     * @param int $parentId 父节点ID
     * @return array 直接子节点的数组
     */
    public function getChildrenByParentId (int $parentId): array
    {
        $newArr = [];
        foreach ($this->data as $value) {
            if ($value[$this->pidName] == $parentId) {
                $newArr[] = $value;
            }
        }
        return $newArr;
    }

    /**
     * 根据父节点ID递归获取所有子节点ID。
     *
     * @param int $parentId 父节点ID
     * @param bool $includeSelf 是否包含自身ID
     * @return array 子节点ID数组
     */
    public function getChildrenIdsByParentId (int $parentId, bool $includeSelf = false): array
    {
        $childrenIds = [];

        if ($includeSelf) {
            $childrenIds[] = $parentId;
        }

        foreach ($this->data as $item) {
            if ($item[$this->pidName] == $parentId) {
                $childrenIds[] = $item[$this->pkName];
                $childrenIds = array_merge($childrenIds, $this->getChildrenIdsByParentId($item[$this->pkName]));
            }
        }

        return array_unique($childrenIds);
    }

    /**
     * 根据节点ID递归获取所有后代节点。
     *
     * @param int $id 节点ID
     * @param bool $includeParent 是否包含传入的节点ID本身在结果数组中
     * @return array 后代节点数组
     */
    public function getDescendantsById (int $id, bool $includeParent = false): array
    {
        $descendants = [];

        if ($includeParent) {
            foreach ($this->data as $item) {
                if ($item[$this->pkName] == $id) {
                    $descendants[] = $item;
                    break;
                }
            }
        }

        foreach ($this->data as $item) {
            if ($item[$this->pidName] == $id) {
                $descendants[] = $item;
                $descendants = array_merge($descendants, $this->getDescendantsById($item[$this->pkName]));
            }
        }
        return $descendants;
    }

    /**
     * 根据节点ID获取其父节点信息。
     *
     * @param int $id 节点ID
     * @return array 父节点信息数组，如果不存在则为空数组
     */
    public function getParentById (int $id): array
    {
        $map = [];
        foreach ($this->data as $item) {
            $map[$item[$this->pkName]] = $item;
        }

        $currentItem = $map[$id] ?? [];
        if ($currentItem) {
            return $map[$currentItem[$this->pidName]] ?? [];
        }

        return [];
    }

    /**
     * 递归获取指定节点的所有父级节点的ID数组。
     *
     * @param int $id 当前节点的ID
     * @return array 父级节点的ID数组
     */
    public function getParentIdsById (int $id): array
    {
        $map = array_column($this->data, null, $this->pkName);

        $getParentIds = function($id) use (&$getParentIds, &$map) {
            $parentIds = [];
            if (isset($map[$id])) {
                $parentId = $map[$id][$this->pidName];
                if (isset($map[$parentId])) {
                    $parentIds = $getParentIds($parentId);
                    $parentIds[] = $parentId;
                }
            }
            return $parentIds;
        };

        return $getParentIds($id);
    }

    /**
     * 构建树形结构数据。
     *
     * @param int $parentId 根节点ID，默认为0表示从最顶层开始构建
     * @return array 树形结构数据
     */
    public function buildTree (int $parentId = 0): array
    {
        $tree = [];

        foreach ($this->data as $item) {
            if ($item[$this->pidName] == $parentId) {
                $children = $this->buildTree($item[$this->pkName]);
                if (!empty($children)) {
                    $item[$this->children] = $children;
                }
                $tree[] = $item;
            }
        }
        return $tree;
    }


}
