## Blite
Caso de teste da Blite

### Instruções

Clone o projeto: 

```
git@github.com:romulo2735/blite_case_test.git
```

Crie um novo arquivo .env

```
cp .env.example .env
```

Instale as dependencias do projeto

```
composer install
```

Usando o sail, suba o container da aplicação

```
./vendor/bin/sail up -d
```

Gere uma nova chave do projeto
```
./vendor/bin/sail artisan key:generate   
```

Crie as tabelas e seeds
````
./vendor/bin/sail artisan migrate --seed
````

Execute os teste
```
./vendor/bin/sail artisan test
```


Para a tela de produtos acesse a rota:
http://localhost/products
