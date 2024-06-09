<?php

declare(strict_types=1);

namespace Hydrogen\Value\Contract\Typecast;

enum NativeTypesEnum: string
{
    case BOOLEAN = 'boolean';
    case INTEGER = 'integer';
    case FLOAT = 'float';
    case STRING = 'string';
    case ARRAY = 'array';
    case OBJECT = 'object';
    case RESOURCE = 'resource';
    case CLOSED_RESOURCE = 'resource (closed)';
    case NULL = 'NULL';
    case UNKNOWN = 'unknown type';

    public static function fromVar(mixed $value): self
    {
        return match (gettype($value)) {
            'boolean' => self::BOOLEAN,
            'integer' => self::INTEGER,
            'double' | 'float' => self::FLOAT,
            'string' => self::STRING,
            'array' => self::ARRAY,
            'object' => self::OBJECT,
            'resource' => self::RESOURCE,
            'resource (closed)' => self::CLOSED_RESOURCE,
            'NULL' => self::NULL,
            default => self::UNKNOWN
        };
    }
}
