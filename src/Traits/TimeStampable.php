<?php

namespace App\Traits;
trait TimeStampable {
  private string $createdAt;

  public  function initTimestamps(): void {
        $this->createdAt = date('Y-m-d H:i:s'); // this's the standard format used in BDs
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }
}

