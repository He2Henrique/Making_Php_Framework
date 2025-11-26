<?php

use Core\calexem;
use PHPUnit\Framework\TestCase;

/*@tests*/
class CalexemTest extends TestCase {

    /*@tests*/
    public function testSomar(): void
    {
        $cal = new calexem();

        $resultado = $cal->somar(-1,5);

        $this->assertEquals(4, $resultado);
    }

}
