<?php

declare(strict_types=1);

namespace EuanTorano\PdoTypedClassProperties\Repositories;

use EuanTorano\PdoTypedClassProperties\Models\Post;

final class PostRepository
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function allPosts(): \Generator
    {
        $query = <<<SQL
SELECT id, 
       title, 
       content, 
       author_id AS "authorId", 
       is_draft AS "isDraft", 
       created_at, 
       updated_at
FROM posts
ORDER BY created_at DESC;
SQL;

        $stmt = $this->pdo->query($query);

        while (($row = $stmt->fetchObject(Post::class)) !== false) {
            yield $row;
        }
    }

    public function find(int $id): ?Post
    {
        $query = <<<SQL
SELECT id, 
       title, 
       content, 
       author_id AS "authorId", 
       is_draft AS "isDraft", 
       created_at, 
       updated_at
FROM posts
WHERE id = :id;
SQL;

        $stmt = $this->pdo->prepare($query);

        $stmt->execute(
            [
                'id' => $id,
            ]
        );

        $result = $stmt->fetchObject(Post::class);

        if (false === $result) {
            return null;
        }

        return $result;
    }
}