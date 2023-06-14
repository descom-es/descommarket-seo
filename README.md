# DescomMarket Seo

[![tests](https://github.com/descom-es/descommarket-seo/actions/workflows/tests.yml/badge.svg)](https://github.com/descom-es/descommarket-seo/actions/workflows/tests.yml)
[![analyze](https://github.com/descom-es/descommarket-seo/actions/workflows/analyze.yml/badge.svg)](https://github.com/descom-es/descommarket-seo/actions/workflows/analyze.yml)

## Installation

```bash
composer require descom-es/descommarket-seo
php artisan migrate
```

## Usage

### Configure yor model to use Seo

Add Trait `DescomMarket\Seo\Traits` in your Model that required Seo.

### Add Seo to your model

```php
    $product->addMeta('title', 'new title to product');
    $product->addMeta('description', 'Meta description to product');
```

### Get MetaResource to your API

```php
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'meta' => $this->whenLoaded('meta', new MetaResource($this->meta)),
        ];
    }
```
