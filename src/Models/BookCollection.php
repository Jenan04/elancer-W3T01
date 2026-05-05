<?php

namespace App\Models;
class BookCollection {
    private array $books = [];

    public function add(Book $book): void {
        $this->books[] = $book;
    }

    public function findById(int $id): ?Book {
        foreach ($this->books as $book) {
            if ($book->id === $id) {
                return $book;
            }
        }
        return null;
    }

 
    public function count(): int {
        return count($this->books);
    }


    public function __toString(): string {
        $summaries = array_map(fn(Book $book) => $book->summary(), $this->books);
        
        return implode("\n", $summaries);
    }
}