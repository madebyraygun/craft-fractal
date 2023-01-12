<?php

namespace modules\pageblocks\blocks;
use modules\pageblocks\blocks\BaseBlock;

class PullquoteBlock extends BaseBlock {
  public static function Init(array &$context) {
    static::PushBlocks($context, [
      self::getPullquote($context),
    ]);
  }

  private static function getPullquote($context) {
    $result = [];
    $mBlocks = BaseBlock::GetMatrixBlocksByType($context, 'contentBlocks', ['pullquote']);
    if (empty($mBlocks)) return [];
    foreach ($mBlocks as $block) {
      $context = [
        'content' => [
          'citeUrl' => $block->attributionUrl,
          'cite' => $block->attributionSource,
          'attribution' => $block->attributionName,
          'body' => $block->body,
        ]
      ];
      $handle = 'pullquote';
      $result[] = BaseBlock::CreateBlockWithContext($handle, $block, $context);
    }
    return $result;
  }
}
