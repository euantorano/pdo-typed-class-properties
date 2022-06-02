CREATE TABLE posts (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    is_draft BOOLEAN NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO posts (id, title, content, author_id, is_draft, created_at, updated_at) VALUES
(1, 'Hello World', 'This is an example post', 1, False, '2022-06-02 15:30:00', '2022-06-02 15:35:00'),
(2, 'Foobar', 'Post #2 for example', 1, True, '2022-06-02 15:35:30', '2022-06-02 15:35:30'),
(3, 'Post 3', 'This is another post by another author', 2, False, '2022-06-02 16:00:00', '2022-06-02 16:00:00');
