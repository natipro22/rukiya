<?php

namespace App\Validation;

use Config\Database;
use InvalidArgumentException;

/**
 * Validation Rules.
 */
class MyRules
{
     
     /**
     * Checks the database to see if the given value is unique. Can
     * ignore a single record by field/value to make it useful during
     * record updates.
     *
     * Example:
     *    are_unique[table.field,ignore_field,ignore_value]
     *    are_unique[users.email,id,5]
     */
    public function are_unique(?string $str, string $field, array $data): bool
    {
        [$field1, $field2, $field3] = array_pad(explode(',', $field), 3, null);
        
        if(array_key_exists($field2, $data) && array_key_exists($field3, $data)){
            return false;
        }
//        return array_key_exists($field2, $data) && array_key_exists($field3, $data);
        sscanf($field2, '%[^.].%[^.]', $field2, $column2);
        sscanf($field3, '%[^.].%[^.]', $field3, $column3);
        sscanf($field1, '%[^.].%[^.]', $table, $field1);

        $row = Database::connect($data['DBGroup'] ?? null)
            ->table($table)
            ->select('1')
            ->where($field1, $str)
            ->where($column2, $data[$field2])
            ->where($column3, $data[$field3])
            ->limit(1);

//        if (! empty($ignoreField) && ! empty($ignoreValue) && ! preg_match('/^\{(\w+)\}$/', $ignoreValue)) {
//            $row = $row->where("{$ignoreField} !=", $ignoreValue);
//        }

        return $row->get()->getRow() === null;
    }
     /**
     * Equal to or Less than a field
     */
    public function less_than_equal_to_field(?string $str, string $field, array $data): bool
    {
        return array_key_exists($field, $data) && $str <= $data[$field];
    }
    
    /**
     * Equal to or Less than a field
     */
    public function greater_than_equal_to_field(?string $str, string $field, array $data): bool
    {
        return array_key_exists($field, $data) && $str >= $data[$field];
    }
}
