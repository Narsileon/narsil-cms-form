# Structure

CMS Form extends CMS with form-builder and frontend forms.

```text
.  # Narsil CMS Form root
├── database/  # Database files
│   └── migrations/  # Database migrations
├── docs/  # Documentation
│   ├── commands/  # Command documentation
│   │   ├── index.md  # Command index
│   │   ├── narsil-skills.md  # Narsil Skills check and fix commands
│   │   └── pint.md  # PHP formatting commands
│   ├── index.md  # Documentation index
│   └── structure.md  # Root structure reference
├── lang/  # Translations
│   ├── de/  # German translations
│   ├── en/  # English translations
│   └── fr/  # French translations
├── resources/  # Resources
│   └── views/  # Blade components
│       └── components/  # Component groups
│           └── blocks/  # Form builder blocks
├── routes/  # HTTP routes
└── src/  # PHP source
    ├── Contracts/  # Contract definitions
    │   ├── Actions/  # Action contract definitions
    │   │   ├── Elements/  # Element contract definitions
    │   │   ├── Fieldsets/  # Fieldset contract definitions
    │   │   ├── Forms/  # Form contract definitions
    │   │   └── Inputs/  # Input contract definitions
    │   ├── Forms/  # Form contract definitions
    │   └── Requests/  # Request contract definitions
    ├── Database/  # Database files
    │   ├── Factories/  # Eloquent model factories
    │   └── Seeders/  # Database seeders
    │       ├── Blocks/  # Block seeders
    │       ├── Fields/  # Field seeders
    │       ├── Fieldsets/  # Fieldset seeders
    │       ├── Forms/  # Form seeders
    │       └── Inputs/  # Input seeders
    ├── Definitions/  # Form definitions
    ├── Http/  # HTTP request handling
    │   ├── Controllers/  # HTTP controllers
    │   ├── Data/  # HTTP data objects
    │   │   └── Forms/  # Form data objects
    │   │       └── Inputs/  # Input data objects
    │   └── Resources/  # Extensible HTTP response resources
    │       └── Frontend/  # Frontend form resources
    ├── Implementations/  # Contract implementations
    │   ├── Actions/  # Action contract implementations
    │   │   ├── Elements/  # Element contract implementations
    │   │   ├── Fieldsets/  # Fieldset contract implementations
    │   │   ├── Forms/  # Form contract implementations
    │   │   └── Inputs/  # Input contract implementations
    │   ├── Forms/  # Form contract implementations
    │   ├── Hooks/  # Lifecycle hooks
    │   │   └── Forms/  # Form hooks
    │   ├── Requests/  # Request contract implementations
    │   └── Tables/  # Table contract implementations
    ├── Models/  # Eloquent models
    ├── Observers/  # Eloquent model observers
    ├── Policies/  # Eloquent model policies
    └── View/  # Blade view components
        └── Components/  # Form component groups
            └── Blocks/  # Form blocks
```
