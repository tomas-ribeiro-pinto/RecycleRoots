<?php

namespace App\Livewire;

use Livewire\Component;

class BlogPagination extends Component
{
    public $currentPage;
    public $pages;
    public $ARTICLES_PER_PAGE;
    public $articlesCount;
    public $pageArticlesCount;
    public $firstIndex;
    public $listeners = ['updateArticles', 'updateArticlesCount', 'updatePageArticlesCount'];

    public function mount($currentArticles, $ARTICLES_PER_PAGE, $pageArticles)
    {
        $this->articlesCount = count($currentArticles);
        $this->pageArticlesCount = count($pageArticles);
        $this->ARTICLES_PER_PAGE = $ARTICLES_PER_PAGE;

        $this->setPages();
    }

    public function render()
    {
        return view('livewire.blog-pagination');
    }

    public function updatePages($page)
    {
        if($page > 0 && $page <= count($this->pages))
        {
            $this->currentPage = $page;
            $this->dispatch('updatePages', $page);
        }

        $this->firstIndex = ($this->currentPage - 1) * $this->ARTICLES_PER_PAGE + 1;
    }

    public function setPages()
    {
        $this->currentPage = 1;
        $this->pages = [];

        // Calculate number of pages according to number of articles per page set
        $div = $this->articlesCount / $this->ARTICLES_PER_PAGE;
        $rem = $this->articlesCount % $this->ARTICLES_PER_PAGE;

        // Set the remainder to 1 if not 0 to add another page
        $rem != 0
            ? $rem = 1 : $rem = 0;

        // Get the whole division plus extra page if necessary
        $total = (int)$div + $rem;

        for($i = 0; $i < $total; $i++)
        {
            $this->pages[] = $i + 1;
        }

        $this->firstIndex = ($this->currentPage - 1) * $this->ARTICLES_PER_PAGE + 1;
    }

    public function updateArticles($articles, $count)
    {
        $this->articlesCount = count($articles);
        $this->pageArticlesCount = $count;

        $this->setPages();
    }

    public function updateArticlesCount($count)
    {
        $this->articlesCount = $count;
    }

    public function updatePageArticlesCount($count)
    {
        $this->pageArticlesCount = $count;
    }
}
