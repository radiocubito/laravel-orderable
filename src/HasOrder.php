<?php

namespace Radiocubito\Orderable;

trait HasOrder
{
    public static function bootHasOrder()
    {
        static::creating(function ($model) {
            if (is_null($model->order_column)) {
                $model->order_column = $model->orderLast();
            }
        });
    }

    public function orderFirst()
    {
        if ($fistItem = self::orderBy('order_column', 'asc')->first()) {
            return $fistItem->order_column - 1;
        }

        return 1;
    }

    public function orderLast()
    {
        if ($lastItem = self::orderBy('order_column', 'desc')->first()) {
            return $lastItem->order_column + 1;
        }

        return 1;
    }

    public function orderAfter()
    {
        $adjacent = self::where('order_column', '>', $this->order_column)
            ->orderBy('order_column', 'asc')
            ->first();

        if (! $adjacent) {
            return $this->orderLast();
        }

        return ($this->order_column + $adjacent->order_column) / 2;
    }

    public function orderBefore()
    {
        $adjacent = self::where('order_column', '<', $this->order_column)
            ->orderBy('order_column', 'desc')
            ->first();

        if (! $adjacent) {
            return $this->orderFirst();
        }

        return ($this->order_column + $adjacent->order_column) / 2;
    }
}
