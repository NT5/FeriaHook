<?php

namespace NT5\Bulker\Test\Basics;

use NT5\Bulker\Modules\Basics;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase {

    private $Logger;

    protected function setUp(): void {
        $this->Logger = new Basics\Logger();
        $this->Logger->setLoggerTraceSteps(2);
    }

    public function testLoggerAdition() {
        $Logs_Count = 10;

        for ($i = 0; $i < $Logs_Count; $i++) {
            $this->Logger->setLog("Test Log: $i");
        }

        $this->assertEquals($Logs_Count, $this->Logger->getLogCount());
    }

    public function testFormattedLogger() {
        $Logger = $this->Logger;

        $Logger
                ->setLog("%s", "foo")
                ->setLog("%s %s", "foo", "bar");

        $this->assertEquals(2, $Logger->getLogCount());
        $this->assertEquals("foo", $Logger->getLog(self::class, 0)->getText());
        $this->assertEquals("foo bar", $Logger->getLog(self::class, 1)->getText());
    }

    public function testLoggerLog() {
        $this->Logger->setLog('foo');

        $Log = $this->Logger->getLog(self::class, 0);

        $this->assertEquals(self::class, $Log->getClass());
        $this->assertEquals(__FUNCTION__, $Log->getFunction());
        $this->assertEquals('foo', $Log->getText());
    }

}
