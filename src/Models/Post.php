<?php

declare(strict_types=1);

namespace EuanTorano\PdoTypedClassProperties\Models;

final class Post
{
    public int $id;

    public string $title;

    public string $content;

    public int $authorId;

    public bool $isDraft;

    public \DateTimeInterface $createdAt;

    public \DateTimeInterface $updatedAt;

    public function __set(string $name, $value): void
    {
        switch ($name)
        {
            case 'created_at':
                $this->createdAt = new \DateTimeImmutable($value);
                break;
            case 'updated_at':
                $this->updatedAt = new \DateTimeImmutable($value);
                break;
        }
    }
}