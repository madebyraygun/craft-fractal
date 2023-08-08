<?php
namespace modules\pagecontext;
use craft\helpers\UrlHelper;
use Craft;

class Pagination {
  // Takes a craft\db\Paginator and returns the context
  public static function GetContext($pagination) {
    $totalPages = $pagination->totalPages;
    $currentPage = $pagination->currentPage;
    $prevPage = $currentPage != 1 ? $currentPage - 1 : null;
    $nextPage = $currentPage != $totalPages ? $currentPage + 1 : null;
    $prevRange = $prevPage ? range(1, $prevPage ) : [];
    $nextRange = $nextPage ? range($nextPage, $totalPages ) : [];
    $prevPages = [];
    $nextPages = [];
    foreach ($prevRange as $page) {
      $prevPages[] = [
        'page' => $page,
        'url' => self::GetPageUrl($pagination, $page)
      ];
    }
    foreach ($nextRange as $page) {
      $nextPages[] = [
        'page' => $page,
        'url' => self::GetPageUrl($pagination, $page)
      ];
    }

    $clampedNext = array_slice($nextPages, 0, 3);
    $clampedPrev = array_slice($prevPages, -3);

    return [
      'totalPages' => $totalPages,
      'totalResults' => $pagination->total,
      'currentPage' => [
        'page' => $currentPage,
        'url' => ''
      ],
      'prevPage' => [
        'page' => $prevPage,
        'url' => self::GetPageUrl($pagination, $prevPage)
      ],
      'nextPage' => [
        'page' => $nextPage,
        'url' => self::GetPageUrl($pagination, $nextPage)
      ],
      'firstPage' => [
        'clamped' => count($clampedPrev) < count($prevPages),
        'dots' => count($prevPages) > 4,
        'page' => 1,
        'url' => self::GetPageUrl($pagination, 1)
      ],
      'lastPage' => [
        'clamped' => count($clampedNext) < count($nextPages),
        'dots' => count($nextPages) > 4,
        'page' => $totalPages,
        'url' => self::GetPageUrl($pagination, $totalPages)
      ],
      'getPrevUrls' => $clampedPrev,
      'getNextUrls' => $clampedNext,
    ];
  }

  private static function GetPageUrl($pagination, $page) {
    if ($page < 1 || $page > $pagination->totalPages) {
      return null;
    }
    $req = Craft::$app->getRequest();
    $url = UrlHelper::url($req->pathInfo, $req->getQueryStringWithoutPath());
    if ($page != 1) {
      $url = UrlHelper::urlWithParams($url, ['page' => $page]);
    } else {
      $url = UrlHelper::removeParam($url, 'page');
    }
    return $url;
  }
}
