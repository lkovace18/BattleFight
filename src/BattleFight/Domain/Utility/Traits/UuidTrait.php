<?php declare(strict_types=1);

namespace BattleFight\Domain\Utility\Traits;

/**
 * Trait UuidTrait
 * @package BattleFight\Domain\Utility\Traits
 */
trait UuidTrait {

    /** @var string */
    private $uuid;

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * UUID4 returns an RFC 4122 version 4 random UUID with 122 randombits of data.
     * This is a great UUID format for uniqueness but a time based UUID version
     * should be used for DB index keys (with some massaging).
     * @see https://gist.github.com/gnanderson/22930abaf4400593f651cd25ca161ab6
     * @return string
     * @todo refactor
     */
    public function generateUuid(): string
    {
        $data = (string)openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord((string)$data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord((string)$data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex((string)$data), 4));
    }
}
