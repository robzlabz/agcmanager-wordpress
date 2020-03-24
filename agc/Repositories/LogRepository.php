<?php


namespace Agc\Repositories;


class LogRepository
{
    public function info($message, array $data = [])
    {
        $this->write('INFO', $message, $data);
    }

    public function write($level, $message, $array = [])
    {
        $dir = plugin_dir_path(__FILE__);
        $log = sprintf("[%s] %s: %s %s", date('Y-m-d H:i:s'), $level, $message, json_encode($array)) . PHP_EOL;
        file_put_contents("$dir/../../storage/log/agcmanager.log", $log, FILE_APPEND);
    }

    public function error($message, array $data = [])
    {
        $this->write('ERROR', $message, $data);
    }
}