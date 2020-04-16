# TPG

Tienda virtual (Terminal punto de gestión) generada apartir de la api y el administrador de Sylius y el tpv creado por Ryu. 

https://sylius.com/
https://github.com/vgrdominik/tpv

Importante: el bundle de sylius shop está deshabilitado.

## Project setup
```
php bin/console sylius:install
php bin/console doctrine:migrations:migrate
php bin/console assets:install --symlink
php bin/console sylius:theme:assets:install --symlink
yarn install
yarn build
```

Follow https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#installation

Generate the SSH keys:
```
$ mkdir -p config/jwt
$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```


Steps to install storefront in /storefront/README.md.

OPTIONAL: Can load /dbs/basic-data***.sql to your db. Must drop current data on affected tables, /dbs/basic-data***-tables-affected.txt

## Launch application
```
symfony serve
open http://127.0.0.1:8000/admin
```

### License

Dominio público.
En la medida de lo posible según la ley, Ryu ha renunciado a todos los derechos de
autor y derechos relacionados o relacionados con el software TPG. Este
trabajo se publica desde: España.

Los diferentes paquetes y software externo como Sylius que se usa en este repositorio tiene su propia licencia
