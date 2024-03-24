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

class Tree
{

    public array $data = [];
    public string $pidName = 'parent_id';
    public string $pkName = 'id';
    public string $children = 'children';

    public function init (array $data = [], string $pidName = '', string $pkName = '')
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


    public function getChildrenByParentId (int $parentId)
    {
        $newArr = [];
        foreach ($this->data as $value) {
            if ($value[$this->pidName] == $parentId) {
                $newArr[] = $value;
            }
        }
        return $newArr;
    }


    public function getChildrenIdsByParentId (int $parentId, $includeSelf = false)
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


    public function getDescendantsById (int $id, bool $includeParent = false)
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



    ///     得到当前位置父辈数组
    /// 得到当前位置所有父辈数组
    /// 读取指定节点所有父类节点ID


    public function buildTree (int $parentId = 0)
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
