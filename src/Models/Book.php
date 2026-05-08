<?php

namespace App\Models;

use App\Traits\TimeStampable;
use App\Contracts\Discountable;
class Book implements Discountable{

    use Timestampable; 
    public function __construct(
        public readonly int $id,
        public  string $title,
        public  string $author,
        public  float $price,
        public int $stock = 0
    ) {
        $this-> initTimestamps();
    }

    public function summary(): string {
        return "[{$this->id}] {$this->title} by {$this->author} — \${$this->price} ({$this->stock} in stock)";
    }

    public function isAvailable(): bool {
         if ($this->stock > 0) return true;
         else return false;
    }

    public function checkout() : void {
       if (!$this->isAvailable()) {
            throw new \RuntimeException('Out of stock');
        }
        
        $this->stock--;
    }
  
    public function applyDiscount(float $pct): float {
        return $this->price * (1 - $pct / 100);
    }
    
}
