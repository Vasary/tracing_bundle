# Tracing bundle

A bundle that provides requests tracing ability.

[![Build Status](https://travis-ci.com/Vasary/tracing_bundle.svg?branch=master)](https://travis-ci.com/Vasary/tracing_bundle)

## Install

### Composer

```bash
composer require vasary/tracer-bundle
```

### Kernel

Include the bundle in your Kernel

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

###
Extra parameters can be placed in  config/packages/(dev|test|prod)/tracing.yaml"

```yaml
tracing:
    extra:
        key: value
```

You can also override these settings.
