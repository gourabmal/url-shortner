<?php

namespace App\Services;

use App\Models\ShortUrl;

class ShortUrlService
{
    /**
     * Base62 characters
     */
    private const ALPHABET = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Generate a unique code for a Short URL.
     */
    public function generateCode(int $id): string
    {
        // Obfuscate the ID so it isn't sequential
        $number = $id + 500000;

        return $this->encodeBase62($number);
    }

    /**
     * Encode a decimal number into Base62.
     */
    private function encodeBase62(int $number): string
    {
        $alphabet = self::ALPHABET;
        $base = strlen($alphabet);

        if ($number === 0) {
            return $alphabet[0];
        }

        $result = '';

        while ($number > 0) {
            $result = $alphabet[$number % $base] . $result;
            $number = intdiv($number, $base);
        }

        return $result;
    }
}