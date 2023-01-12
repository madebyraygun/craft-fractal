# Usage

## Craft CMS 

```
{% set asset = entry.heroImage.one() %}
{% do asset.setTransform({ width: 1200, height: 700 }) %}
{# This transform sets the crop and default image size 👆 #}

\{{ include '@image' with 
  {
    src: asset.url, 
    srcset: asset.getSrcset(['500w', '700w', '900w','1200w','1600w']), 
    alt: 'asset.altText',
    lazy: true,
    class: 'width--full',
    height: asset.height,
    width: asset.width    
  }  
}}
```