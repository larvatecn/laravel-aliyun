# laravel-aliyun

This is a aliyun expansion for the laravel

[![License](https://poser.pugx.org/larva/laravel-aliyun/license.svg)](https://packagist.org/packages/larva/laravel-aliyun)
[![Latest Stable Version](https://poser.pugx.org/larva/laravel-aliyun/v/stable.png)](https://packagist.org/packages/larva/laravel-aliyun)
[![Total Downloads](https://poser.pugx.org/larva/laravel-aliyun/downloads.png)](https://packagist.org/packages/larva/laravel-aliyun)

## 环境需求

- PHP >= 8.0.2

## Installation

```bash
composer require larva/laravel-aliyun -vv
```

## for Laravel

This service provider must be registered.

```php
// config/app.php

'providers' => [
    '...',
    Larva\Aliyun\AliyunServiceProvider::class,
];
```
