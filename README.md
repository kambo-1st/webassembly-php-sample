# An example for PHP WebAssembly Library

An quick POC (done in ~3 hours) for running WebAssembly modules using [Wasmer](https://wasmer.io/).


## Usage
```bash
git clone https://github.com/kambo-1st/webassembly-php-sample.git
cd webassembly-php-sample
composer install
php sample.php
```

## Current limitations

- 🔧 Needs FFI extension to be enabled.
- ⚠️ Just a POC, can segfault at any moment.
- 🧹 It's probably leaking memory.
- 📦 Wasmer runtime is bundled with the library - not a good idea for production.
- ⚡ Limited support for some WebAssembly features.
- 🍎 Does not support Mac OS (I forget password to my Mac ).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
