<?php 

namespace App\Utilities;

use App\Models\Book;

class CsvReader {
    public static function load(string $path): array {
       $books = [];
       if (($helper = fopen($path, 'r')) !== false) {
      //  i used fopen() instead of file_get_contents() because it is better for large files
      //  it reads the file line by line (streaming) and doesnt use too much memory => ram

        fgetcsv($helper);
        while (($row = fgetcsv($helper)) !== false) {
          $books[] = new Book(
            (int)$row[0], 
            $row[1], 
            $row[2], 
            (float)$row[3], 
            (int)$row[4],
            );            
        }

        fclose($helper);
       }
       
       return $books;
    }
}