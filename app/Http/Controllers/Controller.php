<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  /**
   * Gera a paginação dos itens de um array ou collection.
   *
   * @param array|Collection      $items
   * @param int   $perPage
   * @param int  $page
   * @param array $options
   *
   * @return LengthAwarePaginator
   */
  public function paginate($items, $perPage = 15, $page = null, $options = [])
  {
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
  }

  /**
   * I solved the problem with the "page>2" which add numeric key to the object.
   * Gera a paginação dos itens de um array ou collection.
   * @param array|Collection $items
   * @param int $perPage
   * @param int $page
   * @param array $options
   *
   * @return LengthAwarePaginator
   */
  public function paginateWithoutKey($items, $perPage = 15, $page = null, $options = [])
  {

    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

    $items = $items instanceof Collection ? $items : Collection::make($items);

    $lap = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    return [
      'current_page' => $lap->currentPage(),
      'data' => $lap ->values(),
      'first_page_url' => $lap ->url(1),
      'from' => $lap->firstItem(),
      'last_page' => $lap->lastPage(),
      'last_page_url' => $lap->url($lap->lastPage()),
      'next_page_url' => $lap->nextPageUrl(),
      'per_page' => $lap->perPage(),
      'prev_page_url' => $lap->previousPageUrl(),
      'to' => $lap->lastItem(),
      'total' => $lap->total(),
    ];
  }
}
