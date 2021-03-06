<?php

namespace NT5\Bulker\Test;

use NT5\Bulker\Modules;
use NT5\Bulker\Modules\Basics\Error;
use NT5\Bulker\Modules\Basics\Warning;
use NT5\Bulker\Modules\Basics\Logger;
use PHPUnit\Framework\TestCase;

class BasicsTest extends TestCase {

    public function testBasicsCreation() {
        $Basics = new Modules\Basics();

        $this->assertInstanceOf(Error\ThrowableError::class, $Basics);
        $this->assertInstanceOf(Warning\ThrowableWarning::class, $Basics);
        $this->assertInstanceOf(Logger\Loggeable::class, $Basics);
    }

}
