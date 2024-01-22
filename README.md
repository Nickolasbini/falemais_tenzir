# Tenzir telefonia

Este projeto é um showcase da forma como desenvolver meus códigos e as tecnicas empregadas afim de, exemplificar meus pontos fortes e fracos.

This project is a showcase of the way I develop my codes and the techniques used in order to exemplify my strengths and weaknesses.


# Requisitos

```
    PHP        ^8.0.2
```

```
    Laravel    ^9.2
```


# Instalação

Para buscar dependências do projeto
```
    composer update
```

É necessário um servidor local para executar o projeto ou um servidor MySql com as seguintes informações
```
    database = falemais
```
```
    username = root
```
```
    password = null
```

Para criar as tabelas no banco de dados
```
    php artisan migrate
```

Para atualizar os dados do cache de toda a aplicação
```
    php artisan optimize
```

Para atualizar os dados do .env
```
    php artisan config:clear
```

Para gerar um servidor local
```
    php artisan serve
```


# Utilização
Rota responsável pela simulação dos valores da ligação
```
    POST simulatecallprice
```

Parametros:
```json
    {
        "callPlanId": "1",
        "origin": "011",
        "destination": "017",
        "callTime": "40"
    }
```

Resposta:
```json
    {
        "success": true,
        "message": "simulação concluida",
        "value": 18.7
    }
```

<br>

Rota responsável pela listagem dos valores por minutos entre DDDs
```
    POST listdddcodesvalue
```

Resposta:
```json
    {
        "success": true,
        "content": "<table class=\"table table-sm\"><thead><tr><th scope=\"col\">DDD de Origem</th><th scope=\"col\">DDD de Destino</th><th scope=\"col\">Preço por minuto</th></tr></thead><tbody><tr><td>011</td><td>016</td><td>R$1,90</td></tr><tr><td>016</td><td>011</td><td>R$2,90</td></tr><tr><td>011</td><td>017</td><td>R$1,70</td></tr><tr><td>017</td><td>011</td><td>R$2,70</td></tr><tr><td>011</td><td>018</td><td>R$0,90</td></tr><tr><td>018</td><td>011</td><td>R$1,90</td></tr></tbody></table>"
    }
```

<br>

# Testes

A aplicação conta com alguns testes para verificar o funcionamento da simulação dos valores de uma ligação. Os testes são:
- `Tentativa de acessar a rota da simulação via método GET`
- `Tentando enviar o formulário POST sem nenhum parametro`
- `Tentando enviar o formulário POST com apenas o parametro callPlanId`
- `Tentando enviar o formulário POST com o parametro callPlanId como uma STRING ao invez do INTEGER esperado`
- `Tentando enviar o formulário POST com o parametro callTime como uma STRING ao invez do INTEGER esperado`
- `Tentando enviar o formulário POST com todos os parametros e do formato esperado`

Para executar todos os testes
```
    php artisan test
```
