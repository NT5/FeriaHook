<?php

namespace NT5\Bulker\Test\Basics;

use NT5\Bulker\Modules\Basics;
use NT5\Bulker\Modules\Basics\Warning;
use PHPUnit\Framework\TestCase;

class WarningsTest extends TestCase {

    private $Warnings;

    protected function setUp(): void {
        $this->Warnings = new Basics\Warnings();
    }

    public function testWarningsaddWarning() {
        $this->Warnings
                ->addWarning(Warning\WarningCodes::UNKNOWN)
                ->addWarning(Warning\WarningCodes::UNKNOWN);

        $this->assertCount(2, $this->Warnings->getWarnings());
        $this->assertEquals(Warning\WarningCodes::UNKNOWN, $this->Warnings->getWarning(0));
    }

    public function testWarningsaddWarningExeption() {
        $this->expectExceptionMessage("No valid value");

        $this->Warnings
                ->addWarning("foo");

        $this->assertCount(0, $this->Warnings->getWarnings());
    }

    public function testWarningsgetWarningSet() {
        $this->assertInstanceOf(Basics\Warnings::class, $this->Warnings);
        $this->assertInstanceOf(Warning\ThrowableWarning::class, $this->Warnings);
    }

    public function testWarningshasWarning() {
        $this->Warnings
                ->addWarning(Warning\WarningCodes::UNKNOWN);

        $this->assertTrue($this->Warnings->hasWarning(Warning\WarningCodes::UNKNOWN));
        $this->assertFalse($this->Warnings->hasWarning("0"));
        $this->assertFalse($this->Warnings->hasWarning("foo"));
    }

}
