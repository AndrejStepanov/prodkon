<?php

namespace App\Providers;

use RuntimeException;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class KonsomHasher implements HasherContract{
    /**
     * Default crypt cost factor.
     * @var int
     */
    protected $rounds = 10;
    private $suffics = "_GnD94lWpl";

    /**
     * Hash the given value.
     * @param  string  $value
     * @param  array   $options
     * @return string
     *
     * @throws \RuntimeException
     */
    public function make($value, array $options = [])    {
        $hash = password_hash($value.$this->suffics, PASSWORD_BCRYPT, [   'cost' => $this->cost($options),   ]);
        if ($hash === false) 
            throw new RuntimeException('Bcrypt хеширование не поддержавется');
        return $hash;
    }

    /**
     * Check the given plain value against a hash.
     * @param  string  $value
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])    {
        if (strlen($hashedValue) === 0) 
            return false;
        return password_verify($value.$this->suffics, $hashedValue);
    }

    /**
     * Check if the given hash has been hashed using the given options.
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])    {
        return password_needs_rehash($hashedValue, PASSWORD_BCRYPT, [ 'cost' => $this->cost($options), ]);
    }

    /**
     * Set the default password work factor.
     * @param  int  $rounds
     * @return $this
     */
    public function setRounds($rounds)    {
        $this->rounds = (int) $rounds;
        return $this;
    }

    /**
     * Extract the cost value from the options array.
     * @param  array  $options
     * @return int
     */
    protected function cost(array $options = [])    {
        return $options['rounds'] ?? $this->rounds;
    }
    /**
     * Get information about the given hashed value.
     *
     * @param  string $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {
        return password_get_info($hashedValue);
    }
}
