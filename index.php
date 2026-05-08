<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Book;
use App\Utilities\CsvReader;
use App\Utilities\LibraryHelper;
use App\Utilities\ReportWriter;

$csvPath = __DIR__ . '/data/books.csv';
$reportPath = __DIR__ . '/data/report.txt';

echo "--- Library System Initialized ---\n";

$allBooks = CsvReader::load($csvPath);
echo "Successfully loaded " . count($allBooks) . " books from CSV.\n";

$sortedBooks = LibraryHelper::sortByPrice($allBooks, 'asc');

$totalValue = LibraryHelper::totalValue($allBooks);
echo "Total value of library stock: $" . number_format($totalValue, 2) . "\n";

$searchResult = LibraryHelper::searchByKeyword($allBooks, 'Dune');
if (!empty($searchResult)) {
    echo "Search Hit: Found " . count($searchResult) . " book(s) matching your keyword.\n";
}

ReportWriter::write($sortedBooks, $reportPath);

echo "----------------------------------\n";
echo "REPORT GENERATED SUCCESSFULLY!\n";
echo "Location: $reportPath\n";