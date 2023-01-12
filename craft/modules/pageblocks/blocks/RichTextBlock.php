<?php

namespace modules\pageblocks\blocks;
use modules\pageblocks\blocks\BaseBlock;

class RichTextBlock extends BaseBlock {
  public static function Init(array &$context) {
    static::PushBlocks($context, [
      self::getRichText($context),
    ]);
  }

  private static function getRichText($context) {
    $result = [];
    $mBlocks = BaseBlock::GetMatrixBlocksByType($context, 'contentBlocks', ['richText']);
    if (empty($mBlocks)) return [];
    foreach ($mBlocks as $block) {
      $context = [
        'sectionHeading' => $block->sectionHeading,
        'intro' => $block->intro,
        'body' => ($block->body ? (string) $block->body : false),
      ];
      $handle = 'rich-text';
      $result[] = BaseBlock::CreateBlockWithContext($handle, $block, $context);
    }
    return $result;
  }
}
