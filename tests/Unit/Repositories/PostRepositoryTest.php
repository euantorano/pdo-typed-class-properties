<?php

declare(strict_types=1);

namespace EuanTorano\PdoTypedClassProperties\Tests\Unit\Repositories;

use PHPUnit\Framework\TestCase;
use EuanTorano\PdoTypedClassProperties\Repositories\PostRepository;

final class PostRepositoryTest extends TestCase
{
    private static \PDO $pdo;

    public static function setUpBeforeClass(): void
    {
        $connectionString = getenv('CONNECTION_STRING');

        if (empty($connectionString)) {
            throw new \Exception('No connection string set');
        }

        self::$pdo = new \PDO($connectionString);
        self::$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function testAllPosts(): void
    {
        $repository = new PostRepository(self::$pdo);

        $postsGenerator = $repository->allPosts();

        $this->assertCount(3, $postsGenerator);
    }

    public function testFind(): void
    {
        $repository = new PostRepository(self::$pdo);

        $post = $repository->find(2);

        $this->assertNotNull($post);

        $this->assertEquals(2, $post->id);
        $this->assertEquals('Foobar', $post->title);
        $this->assertEquals('Post #2 for example', $post->content);
        $this->assertEquals(1, $post->authorId);
        $this->assertTrue($post->isDraft);
        $this->assertEquals(new \DateTimeImmutable('2022-06-02 15:35:30'), $post->createdAt);
        $this->assertEquals(new \DateTimeImmutable('2022-06-02 15:35:30'), $post->updatedAt);
    }
}