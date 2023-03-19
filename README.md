# composer-installer

Composer Plugin to Install SPIP Applications.

## Identified Composer Types

- `spip-classic`
- `spip-ecrire`
- `spip-prive`
- `spip-plugin`

## Reserved Composer Types for future uses

- `spip-lang`
- `spip-theme`

## Extra parameters in root package

- `extra.spip.template` goes to `./squelettes-dist`
- `extra.spip.extensions` go to `./plugins-dist`

```json
{
    "extra": {
        "spip": {
            "template": "vendor/default-template",
            "extensions": [
                "vendor1/plugin-dist-1",
                "vendor2/plugin-dist-2"
            ]
        }
    }
}
```
