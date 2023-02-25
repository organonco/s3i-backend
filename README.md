
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

## Documentation

To generate documentation run
```bash
sail artisan scribe:generate
```

## Links
- Documentation: <http://localhost/docs>
- Dashboard: <http://localhost>

## Credentials
### Dashboard (Admin)
email: super@admin.com \
password: password

### API (Student)
phone: 99999999 \
password: 12345678

