<?php

namespace App\DataTransferObjects;

readonly class Color
{
    public function __construct(
        public string $name,
        public int $amount,
    ) {
    }
}
