# CQRS Bank - Laravel

Este proyecto es un ejemplo práctico de la arquitectura **CQRS (Command Query Responsibility Segregation)** implementada
en **Laravel** usando `CommandBus`, `QueryBus`, sus respectivos handlers y un repositorio en memoria.

El objetivo es mostrar cómo separar la lógica de escritura (Commands) de la de lectura (Queries), logrando un código más
limpio, mantenible y fácil de escalar.

---

## 🚀 Tecnologías utilizadas

- **PHP 8.4+**
- **Laravel 12+**
- **CQRS Pattern**
- **CommandBus / QueryBus**
- **InMemory Repository**

---

## 📂 Estructura del proyecto

app/
└─ Bank/
├─ Application/
│ ├─ Commands/
│ │ ├─ DepositMoneyCommand.php
│ │ ├─ DepositMoneyHandler.php
│ │ ├─ OpenAccountCommand.php
│ │ └─ OpenAccountHandler.php
│ ├─ Queries/
│ │ ├─ GetBalanceQuery.php
│ │ └─ GetBalanceHandler.php
│ └─ Bus/
│ ├─ InMemoryCommandBus.php
│ └─ InMemoryQueryBus.php
├─ Domain/
│ ├─ Account.php
│ └─ AccountRepository.php
├─ Infrastructure/
│ └─ Persistence/
│ └─ InMemoryAccountRepository.php
└─ Shared/
├─ CommandBus.php
├─ QueryBus.php
├─ Command.php
├─ Query.php
├─ CommandHandler.php
└─ QueryHandler.php








---

## 📜 Ejemplo de uso

El flujo es el siguiente:

1. **Crear cuenta**
    ```php
    $commandBus->dispatch(new OpenAccountCommand('12345'));
    ```

2. **Depositar dinero**
    ```php
    $commandBus->dispatch(new DepositMoneyCommand('12345', 5000));
    ```

3. **Consultar saldo**
    ```php
    $balance = $queryBus->ask(new GetBalanceQuery('12345'));
    ```

---

## 🛠 Instalación

1. Clonar el repositorio:
    ```bash
    git clone https://github.com/alopez1981/cqrs-bank-laravel.git
    cd cqrs-bank-laravel
    ```

2. Instalar dependencias:
    ```bash
    composer install
    ```

3. Configurar Laravel:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configurar la base de datos en `.env`.

5. Ejecutar las migraciones:
    ```bash
    php artisan migrate
    ```

6. Iniciar servidor:
    ```bash
    php artisan serve
    ```

---

## 🎯 Objetivo de este ejemplo

- Practicar **CQRS** en Laravel.
- Entender el uso de **CommandBus** y **QueryBus**.
- Separar responsabilidades de lectura y escritura.
- Usar un **repositorio en memoria** para simplificar el ejemplo.

---

## 📄 Licencia

Este proyecto se distribuye bajo la licencia **MIT**.

