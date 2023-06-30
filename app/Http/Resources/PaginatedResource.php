<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginatedResource extends JsonResource
{
    // public $data;
    public $pagination;
    
    public function __construct($resource) {
        // $this->data = $resource->items(); 
        
        $this->pagination = [
            'total'        => $resource->total(),
            'count'        => $resource->count(), 
            'per_page'     => $resource->perPage(), 
            'current_page' => $resource->currentPage(),
            'total_pages'  => $resource->lastPage()
       ];
    }
    
    public function toArray($request)
    {
        return [
            // 'data' => $this->data,
            'pagination' => $this->pagination
        ];    
    }
}