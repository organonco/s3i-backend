
# E-learning Platform



## Requirements

- Php 8.1
- Docker
- Composer

## Installation

To install this project run


```bash
  composer install
  sail up -d
  sail artisan key:generate
  sail artisan migrate --seed
```

After installing run the tests with
```bash
  sail artisan test
```
Check if all the tests pass

## Running

To run this project

```bash
  sail up -d
```
