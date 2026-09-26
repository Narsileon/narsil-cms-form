# Pint

Run from the `narsil-app` root using Narsil Skills' shared Pint configuration.

## Check

```sh
ddev exec -d /var/www/html ./vendor/bin/pint --test \
    --config=/var/www/narsil-skills/pint.json \
    /var/www/narsil-cms-form
```

## Format

```sh
ddev exec -d /var/www/html ./vendor/bin/pint \
    --config=/var/www/narsil-skills/pint.json \
    /var/www/narsil-cms-form
```
