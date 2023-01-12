<?php

namespace modules\pageblocks\blocks;
use modules\pageblocks\blocks\BaseBlock;

class SingleImageBlock extends BaseBlock {
  public static function Init(array &$context) {
    static::PushBlocks($context, [
      self::getBlocks($context),
    ]);
  }

  private static function getBlocks($context) {
    $result = [];
    $mBlocks = BaseBlock::GetMatrixBlocksByType($context, 'contentBlocks', ['singleImage']);
    if (empty($mBlocks)) return [];
    foreach ($mBlocks as $block) {
      if (!$block->image || !$block->image->one() ) return null;
      $image = $block->image->one();
      $image = [
        'src' => $image->getUrl('large'),
        'srcset' => $image->getSrcset(['500w', '700w', '900w', '1200w', '1600w']),
        'alt' => $image->altText,
        'lazy' => true,
        'class' => 'width--full',
        'width' => $image->width,
        'height' => $image->height,
        'filter' => false,
        'animate' => true,
        'caption' => $image->caption,
      ];
      $context = [
        'image' => $image,
        'layout' => $block->layout
      ];
      $handle = 'single-image';
      $result[] = BaseBlock::CreateBlockWithContext($handle, $block, $context);
    }
    return $result;
  }
}
