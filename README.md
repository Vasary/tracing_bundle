# Tracing bundle

A bundle that provides requests tracing ability.

[![Build Status](https://travis-ci.com/Vasary/tracing_bundle.svg?branch=master)](https://travis-ci.com/Vasary/tracing_bundle)

## Install

### Composer

```bash
composer require vasary/tracing_bundle
```

### AppKernel

Include the bundle in your AppKernel

```php
public function registerBundles()
{
    return [
        ...
        new Vasary\TracingBundle\TracingBundle()
    ];
```

## Configuration

### Default

```yaml
tracing:
  header_name: x-trace-id
  log_field_name: x-trace-id
  application_name: change_me
```

You can also override these settings.