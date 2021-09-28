# Projeto Feito Utilizando o Laravel Sails.

Para instalar numa máquina sem composer:

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

Caso sua máquina tenha o composer apenas dar um ``` composer install ```

## Para rodar o projeto.
Tenha o docker instalado na sua máquina,

vá para a pasta do projeto,
copie o .env.example eo renomeie como .env
abra o terminal (ambientes windows tem que utilizar o WSL)
inicie o docker digitando ``` vendor/bin/sail up ```
em outro terminal rode o ```vendor/bin/sail php artisan migrate ```,  ```vendor/bin/sail npm install``` e ```vendor/bin/sail npm run dev``` na pasta do projeto.

Acesse http://localhost e seu projeto estará a rodar
