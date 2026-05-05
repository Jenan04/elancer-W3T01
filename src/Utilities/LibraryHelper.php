<?php

namespace App\Utilities;
class LibraryHelper {

  public static function formatTitle(string $title): string {
    $title = trim($title);
    $title = preg_replace('/\s+/', ' ', $title);
    return ucwords(strtolower($title));
  }

  public static function filterByAuthor(array $books, string $author): array {
    $filtered_book = array_filter($books, fn($book) => strtolower($book->author) === strtolower($author));
    return array_values($filtered_book);
  }

  public static function sortByPrice(array $books, string $dir='asc'): array {
    usort($books, fn($x, $y) => ($dir ==='asc')
      ? $x->price <=> $y->price
      : $y->price <=> $x->price
    );

    return $books;
  }

  public static function totalValue(array $books): float {
    return array_reduce($books, fn($carry, $book) => $carry + ($book->price * $book->stock), 0.0);
  }

  public static function searchByKeyword(array $books, string $kw): array {
    $kwLower = strtolower($kw);

    $filtered = array_filter($books, fn($book) => 
        str_contains(strtolower($book->title), $kwLower) || 
        str_contains(strtolower($book->author), $kwLower)
    );

    return array_values($filtered);
  }
}