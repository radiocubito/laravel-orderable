<?php

namespace Radiocubito\Orderable\Tests;

use Radiocubito\Orderable\Tests\Fixtures\Dummy;

class HasOrderTest extends TestCase
{
    /** @test */
    public function it_sets_the_order_column_on_creation()
    {
        foreach (Dummy::all() as $dummy) {
            $this->assertEquals($dummy->name, $dummy->order_column);
        }
    }

    /** @test */
    public function it_sets_the_order_column_to_first()
    {
        $model = Dummy::find(4);

        $this->assertEquals($model->order_column, 4);

        $model->order_column = $model->orderFirst();
        $model->save();

        $this->assertEquals($model->fresh()->order_column, 0);
    }

    /** @test */
    public function it_sets_the_order_column_to_last()
    {
        $model = Dummy::find(4);

        $this->assertEquals($model->order_column, 4);

        $model->order_column = $model->orderLast();
        $model->save();

        $this->assertEquals($model->fresh()->order_column, 21);
    }

    /** @test */
    public function it_sets_the_order_column_after_another_model()
    {
        $firstModel = Dummy::find(6);
        $secondModel = Dummy::find(3);

        $this->assertEquals($firstModel->order_column, 6);
        $this->assertEquals($secondModel->order_column, 3);

        $secondModel->order_column = $firstModel->orderAfter();
        $secondModel->save();

        $this->assertEquals($secondModel->fresh()->order_column, 6.5);
    }

    /** @test */
    public function it_sets_the_order_column_to_last_after_last_model()
    {
        $firstModel = Dummy::find(20);
        $secondModel = Dummy::find(6);

        $this->assertEquals($firstModel->order_column, 20);
        $this->assertEquals($secondModel->order_column, 6);

        $secondModel->order_column = $firstModel->orderAfter();
        $secondModel->save();

        $this->assertEquals($secondModel->fresh()->order_column, 21);
    }

    /** @test */
    public function it_sets_the_order_column_before_another_model()
    {
        $firstModel = Dummy::find(6);
        $secondModel = Dummy::find(9);

        $this->assertEquals($firstModel->order_column, 6);
        $this->assertEquals($secondModel->order_column, 9);

        $secondModel->order_column = $firstModel->orderBefore();
        $secondModel->save();

        $this->assertEquals($secondModel->fresh()->order_column, 5.5);
    }

    /** @test */
    public function it_sets_the_order_column_to_first_after_first_model()
    {
        $firstModel = Dummy::find(1);
        $secondModel = Dummy::find(6);

        $this->assertEquals($firstModel->order_column, 1);
        $this->assertEquals($secondModel->order_column, 6);

        $secondModel->order_column = $firstModel->orderBefore();
        $secondModel->save();

        $this->assertEquals($secondModel->fresh()->order_column, 0);
    }
}
