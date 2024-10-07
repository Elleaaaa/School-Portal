<?php

namespace App\Services;

class MessageLogService
{
    public static function detectChanges($original, $updated, $fields)
    {
        $changes = [];

        foreach ($fields as $field) {
            if ($original->{$field} != $updated->{$field}) {
                $changes[] = "{$field} from '{$original->{$field}}' to '{$updated->{$field}}'";
            }
        }

        return $changes;
    }
}
