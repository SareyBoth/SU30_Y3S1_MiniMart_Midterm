<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 12;

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function render()
    {
        $categories = Category::with('statusRelation')->paginate($this->perPage);

        return view('livewire.category-list', compact('categories'));
    }
}
