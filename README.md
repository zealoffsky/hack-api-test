# Automated API Tests Hack/HHVM

This repository contains small example of implementation automated API tests using Hack/HHVM.

## Prerequisites
- Installed Composer 
- Installed HHVM
(Please refer to official HHVM documentation: https://docs.hhvm.com/hhvm/installation/introduction)

## Getting Started

Clone the Repository

```bash
git clone https://github.com/zealoffsky/hack-http-test.git
cd hack-http-test
```

## Install Dependenies

```bash
composer install
```

## Generate Autoload
```bash
vendor/bin/hh-autoload
```
## Run the Tests
```bash
vendor/bin/hacktest tests/
```

## Owner
Artem Halushka 
