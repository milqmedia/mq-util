<?php

namespace MQUtil\Log;

class ReportId
{
    public static function getId($userId)
    {
        return $userId . ':' . substr(sha1(time()), 0, 8);
    }
}