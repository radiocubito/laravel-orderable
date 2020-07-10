<?php

namespace Radiocubito\Orderable;

class HasOrder
{
    public function orderFirst()
    {
        return self::orderBy('order', 'asc')
                ->first()
                ->order - 1;
    }

    public function orderLast()
    {
        return self::orderBy('order', 'desc')
                ->first()
                ->order + 1;
    }

    public function orderAfter()
    {
        $adjacent = self::where('order', '>', $this->order)
            ->orderBy('order', 'asc')
            ->first();

        if (!$adjacent) {
            return $this->last();
        }

        return ($this->order + $adjacent->order) / 2;
    }

    public function orderBefore()
    {
        $adjacent = self::where('order', '<', $this->order)
            ->orderBy('order', 'desc')
            ->first();

        if (!$adjacent) {
            return $this->first();
        }

        return ($this->order + $adjacent->order) / 2;
    }
}
