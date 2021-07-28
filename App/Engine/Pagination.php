<?php


namespace App\Engine;


class Pagination implements \Iterator
{
    public string $class;
    public string $where;
    public array $order;
    public string $param_page;
    public string $param_limit;

    public int $page;
    public int $pages;
    public int $limit;
    public int $number;

    public int $pos = 0;
    public array $rows = [];

    public function __construct(string $class, string $where = '', array $order = [], ?int $page = null, ?int $limit = null, string $param_page = 'page', string $param_limit = 'limit')
    {
        $this->class = $class;
        $this->where = $where;
        $this->order = $order;
        $this->param_page = $param_page;
        $this->param_limit = $param_limit;

        $this->limit = intval($_GET[$param_limit] ?? $limit ?? 10);
        $this->limit = max(1, min(100, $this->limit));

        $this->number = $class::number($this->where);
        $this->pages = ceil($this->number / $this->limit);

        $this->page ??= max(1, min($this->pages, intval($_GET[$this->param_page] ?? 1)));
        $this->rows = $class::findAll(
            where: $where,
            order: $order,
            limit: $this->limit,
            offset: ($this->page - 1) * $this->limit
        );
    }

    public function getUrlPage(int $page): string
    {
        return $this->rewriteUrlParam($this->param_page, $page);
    }

    public function rewriteUrlParam(string $param, string $value): string
    {

        if (str_contains($url = $_SERVER['REQUEST_URI'], $param)) {

            return preg_replace("/{$param}=[^&]*/i", "{$param}={$value}", $url, 1);
        } else {

            return $url . (str_contains($url, '?') ? '&' : '?') . "{$param}={$value}";
        }
    }

    public function getUrlFirstPage(): string
    {
        return $this->rewriteUrlParam($this->param_page, 1);
    }

    public function getUrlLastPage(): string
    {
        return $this->rewriteUrlParam($this->param_page, $this->pages);
    }

    public function getUrlPrevPage(): string
    {
        return $this->rewriteUrlParam($this->param_page, max(1, $this->page - 1));
    }

    public function getUrlNextPage(): string
    {
        return $this->rewriteUrlParam($this->param_page, min($this->page + 1, $this->pages));
    }

    public function getUrlLimit(int $limit): string
    {
        return $this->rewriteUrlParam($this->param_limit, $limit);
    }

    public function current()
    {
        return $this->rows[$this->pos];
    }

    public function next()
    {
        $this->pos += 1;
    }

    public function key()
    {
        return $this->pos;
    }

    public function valid()
    {
        return isset($this->rows[$this->pos]);
    }

    public function rewind()
    {
        $this->pos = 0;
    }
}