<?php

namespace DataMat\GrinningCat\DTO\Api\User;

use Symfony\Component\Serializer\Annotation\SerializedName;

class UserOutput
{
    public string $id;

    public string $username;

    /** @var array<string, array<string>>  */
    public array $permissions;

    /** @var array<string, mixed>|null  */
    public ?array $metadata = null;

    #[SerializedName('created_at')]
    public ?float $createdAt = null;

    #[SerializedName('updated_at')]
    public ?float $updatedAt = null;
}