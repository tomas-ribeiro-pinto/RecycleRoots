<?php

namespace App\Livewire;

use Livewire\Component;

class BlogList extends Component
{
    public $currentArticles;
    public $articles;
    public $pageArticles;
    public $ARTICLES_PER_PAGE;

    public $filter;
    public $filterEmpty;

    public $listeners = ['updatePages'];

    public function mount($articles)
    {
        // Original Articles
        $this->articles = $articles;
        // Current Articles (filtered or not)
        $this->currentArticles = $articles;
        $this->ARTICLES_PER_PAGE = 2;
        $this->clearFilter();
    }

    public function render()
    {
        return view('livewire.blog-list');
    }

    public function updatedFilter()
    {
        if($this->filter == '')
        {
            $this->clearFilter();
            return;
        }
        $this->filterEmpty = false;
        $this->currentArticles = $this->currentArticles->filter(function ($article) {
            return str_contains(strtoupper($article->title), strtoupper($this->filter));
        });
        $this->updatePages(1);
        // Dispatch current articles and current page articles count
        $this->dispatch('updateArticles', $this->currentArticles, count($this->pageArticles));
    }

    public function clearFilter()
    {
        $this->filterEmpty = true;
        $this->filter = '';
        // Set the current articles to the original articles
        $this->currentArticles = $this->articles;
        $this->updatePages(1);
        // Dispatch current articles and current page articles count
        $this->dispatch('updateArticles', $this->currentArticles, count($this->pageArticles));
    }

    public function updatePages($page)
    {
        // Dispatch current articles count
        $this->dispatch('updateArticlesCount', count($this->currentArticles));
        // Set the current page articles to the selected page
        $this->pageArticles = $this->currentArticles->slice(
            ($page - 1) * $this->ARTICLES_PER_PAGE,
            $this->ARTICLES_PER_PAGE);
        // Dispatch current page articles count
        $this->dispatch('updatePageArticlesCount', count($this->pageArticles));
    }
}
