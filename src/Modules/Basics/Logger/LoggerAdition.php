<?php

namespace NT5\Bulker\Modules\Basics\Logger;

trait LoggerAdition {

    /**
     * Alamacena todos los registros
     * @var \NT5\Bulker\Modules\Basics\Logger\Log[] 
     */
    protected $Logs = [];

    /**
     * 
     * @return int
     */
    abstract function getLoggerTraceStepts();

    /**
     * 
     * @param string $key
     * @param array $array
     * @param string $default
     * @return mixed
     */
    protected function check_array($key, $array, $default) {
        return array_key_exists($key, $array) ? $array[$key] : $default;
    }

    /** Metodo que guarda un nuevo registro en la instacia
     * @param string $string Texto que se guarda (puede incluir formato) <b>Ejm: Hola %s!</b>
     * @param string $format Lista de valores que se usaran si el texto posee un formato
     * @return Logger
     */
    public function setLog($string, ...$format) {
        $trace_arr = debug_backtrace(FALSE, $this->getLoggerTraceStepts());
        $trace = end($trace_arr);

        $class_name = $this->check_array('class', $trace, "Unknown");
        $class_function = $this->check_array('function', $trace, "foo");
        $class_file = $this->check_array('file', $trace, "default.php");
        $class_line = $this->check_array('line', $trace, 0);

        $this->Logs[$class_name][] = new Log(
                $class_name, $class_function, $class_file, $class_line, microtime(true), date('m/d/Y h:i:sa', time()), sprintf($string, ...$format)
        );
        return $this;
    }

}
