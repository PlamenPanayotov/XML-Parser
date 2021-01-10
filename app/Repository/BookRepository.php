<?php

namespace App\Repository;

use App\Model\Book;

class BookRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert($books)
    {
        $booksList = [];

        foreach ($books as $book) {
           
            $select =
                'SELECT * FROM books WHERE name = :name AND author = :author';
            $stmt = $this->pdo->prepare($select);
            $stmt->bindValue(':name', $book->getName());
            $stmt->bindValue(':author', $book->getAuthor());
            $stmt->execute();
            $result = $stmt->fetchObject();
            if ($result) {
                $data = date('d-m-y');
                $sql =
                    'UPDATE books SET posting_date = :posting_date WHERE id = :id';
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':posting_date', $data);
                $stmt->bindValue(':id', $book->getId());
                $stmt->execute();
            } else {
                $sql =
                    'INSERT INTO books(id,name,author,posting_date) VALUES(:id,:name,:author,:posting_date)';

                $stmt = $this->pdo->prepare($sql);

                $stmt->bindValue(':id', $book->getId());
                $stmt->bindValue(':name', $book->getName());
                $stmt->bindValue(':author', $book->getAuthor());
                $stmt->bindValue(':posting_date', $book->getPostingDate());
                $stmt->execute();

                $booksList[] = $book;
            }
        }
        // exit;
        return $booksList;
    }

    public function search($query)
    {
        $query = str_replace("'", '', $query);
        $sql = $this->pdo->query("SELECT * FROM books WHERE author ilike '%$query%'");
        $books = [];

        while($row = $sql->fetch(\PDO::FETCH_ASSOC))
        {
            $book = new Book();
            $book
                ->setId($row['id'])
                ->setName($row['name'])
                ->setAuthor($row['author'])
                ->setPostingDate($row['posting_date']);

            $books[] = $book;
        }
        return $books;
    }

    public function getAll()
    {
        $sql = $this->pdo->query('SELECT * FROM books');
        $books = [];

        while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
            $book = new Book();
            $book
                ->setId($row['id'])
                ->setName($row['name'])
                ->setAuthor($row['author'])
                ->setPostingDate($row['posting_date']);

            $books[] = $book;
        }
        return $books;
    }

    public function createTable()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS books (
            id VARCHAR (255),
            name VARCHAR (255),
            author VARCHAR (255),
            posting_date DATE NOT NULL DEFAULT CURRENT_DATE
        );';

        $this->pdo->exec($sql);
        return true;
    }
}
