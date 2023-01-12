<?php

namespace modules\layoutcontext\components;
use Craft;

class BodyClassesContext {
  public static function Hook() {
    Craft::$app->view->hook('global-context', function(array &$context) {
      $classes[] = self::Section($context);
      $context['body_classes'] = implode(' ', $classes);
    });
  }

  private static function Section($context) {
    $entry = $context['entry'] ?? null;
    $category = $context['category'] ?? null;
    $request = $context['craft']->app->request;
    $values = [];
    if ($entry) //section handle + entry type handle
    {
      $values[] = 'section-' . $entry->section->handle;
      $values[]= 'type-' . $entry->type->handle;
    }
    //404
    if ( $context['craft']->app->response->statusCode == '404' )
    {
      $values[] = 'is-404';
    }
    return implode(' ', $values);
  }
}
