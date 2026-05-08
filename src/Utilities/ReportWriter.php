<?php

namespace App\Utilities;

class ReportWriter {
    public static function write(array $books, string $path): void {
        if(($helper = fopen($path, 'w')) !== false) {
            
            fwrite($helper, "--- Library Stock Report ---" . PHP_EOL);
            fwrite($helper, "Generated on: " . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL);

            // so the diff between "\n" and PHP_EOL, PHP_EOL is a constant that changes based on the server. if it's Linux, it's "\n"; if it's Windows, it's "\r\n".
            foreach($books as $book) {
              fwrite($helper, $book->summary() . PHP_EOL); 
            }

            fclose($helper);
        }
    }
}