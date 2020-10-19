# OurMeeting

## O Projeto

O projeto foi criado a partir de um teste, que consistia em criar um sistema de agendamento de salas de reuniões, permitindo também o cadastro de usuários, setores e salas.
O desenvolvimento deste projeto, desde planejamento e levantamento de requisitos, até os testes de docuemntação final, levou um pouco menos de **20h**.

## Como Instalar/Configurar

1. Clone o respositório e acesse a pasta
```
git clone https://github.com/PauloAK/OurMeeting.git
```

2. Instale as dependências do composer
```
composer install
```

3. Instale as dependências do NPM
```
npm install
```

4. Criar o arquivo de ambiente (.env)
```
cp .env.example .env
```

5. Defina as permissões das pastas
```
sudo chown -R www-data .
sudo chmod -R ug+rwx storage bootstrap/cache
```

6. Gerar a Chave de Criptografia
```
php artisan key:generate
```

7. Crie um novo banco de dados MySQL/PostgreSQL para a aplicação.

8. Edite o arquivo **.env** e defina os dados de acesso ao banco de dados que acabou de criar
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=DB_NAME
DB_USERNAME=USERNAME
DB_PASSWORD=PASSWORD
```

9. Crie a estrutura de tabelas e carga de dados inicial
```
php artisan migrate --seed
```

10. Inicia o servidor integrado o Laravel
```
php artisan serve
```

11. Acesse o endereço que é exibido em seu navegador, geralmente é: 127.0.0.1:8000
* **Usuário:** admin@ourmeeting.com
* **Senha:** admin123


### Especificações

* Para agendar, deve estar autenticado no sistema
* Um agendamento não pode ser superior a 1h;
* O local pode haver mais de uma sala de reunião disponível;
* O usuário, poderá reservar apenas 1 sala de reunião por dia;
* O usuário poderá reservar apenas 1 horário por sala de reunião;
* Deve ser possível cadastrar setores;
* Deve ser possível cadastrar usuários;

## Tecnologias
### Front-End
* [Bootstrap 4.5](https://getbootstrap.com/)
* [jQuery](https://jquery.com/)
* [Toastr.js](https://github.com/yoeunes/toastr)
* [jQuery Mask](https://github.com/igorescobar/jQuery-Mask-Plugin)
* [Font Awesome 5](https://fontawesome.com/)


### Back-End
* Laravel 5.8
* PHP 7.2
* MySQL

## Recursos e Conceitos

* [ADMIN] CRUD - Usuários
** Somente ADMINs  tem acesso à está área
** Possibilidade de alteração de senha mediante validação.
* [ADMIN] CRUD - Setores
** Somente ADMINs  tem acesso à está área
* [ADMIN] CRUD - Salas
** Somente ADMINs  tem acesso à está área
* Reuniões
** Podem ter no máximo 60 minutos
** Um usuário só pode marcar uma reunião por dia
** Uma sala só pode ter uma reunião ao mesmo tempo
** Usuário somente pode editar as suas reuniões, com exceção do ADMIN, que tem acesso à todas.

## Diagrama Entidade Relacionamento

![](/docs/Diagram.png)

## Requisitos
### Funcionais
* Manter Usuário.
* Manter Setor.
* Manter Reunião.

### Não Funcionais
* O sistema deverá utilizar banco de dados dados MySQL.
* O sistema deverá ser responsivo para a utilização em mobile.
* As senhas dos usuários devem ser armazenadas utilizando o hash bcrypt do Laravel