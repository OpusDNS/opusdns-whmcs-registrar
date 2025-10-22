<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class Pagination
{
    use ModelTrait;
    
    private int $total_pages = 0;
    
    private int $total_items = 0;
    
    private int $current_page = 1;
    
    private int $page_size = 10;
    
    private bool $has_next_page = false;
    
    private bool $has_previous_page = false;
    
    public function __construct(array $data = [])
    {
        $this->total_pages = $data['total_pages'] ?? 0;
        $this->total_items = $data['total_items'] ?? 0;
        $this->current_page = $data['current_page'] ?? 1;
        $this->page_size = $data['page_size'] ?? 10;
        $this->has_next_page = $data['has_next_page'] ?? false;
        $this->has_previous_page = $data['has_previous_page'] ?? false;
    }
    
    public function getTotalPages(): int
    {
        return $this->total_pages;
    }
    
    public function getTotalItems(): int
    {
        return $this->total_items;
    }
    
    public function getCurrentPage(): int
    {
        return $this->current_page;
    }
    
    public function getPageSize(): int
    {
        return $this->page_size;
    }
    
    public function hasNextPage(): bool
    {
        return $this->has_next_page;
    }
    
    public function hasPreviousPage(): bool
    {
        return $this->has_previous_page;
    }
}
