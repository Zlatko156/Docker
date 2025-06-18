Проектът използва Docker и Docker Compose за стартиране на уеб приложение с PHP и база данни MariaDB.

###  Стъпки за стартиране:

1. Уверете се, че имате инсталирани Docker и Docker Compose.
2. В кореновата директория на проекта създайте/поставете следния `docker-compose.yml` файл:

```yaml
version: '3.8'

services:
  web:
    image: php:8.1-apache
    container_name: php_app
    volumes:
      - ./src:/var/www/html
    ports:
      - "8080:80"
    depends_on:
      - db

  db:
    image: mariadb:10.4
    container_name: mariadb
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: simple_site
      MYSQL_USER: user
      MYSQL_PASSWORD: pass
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql
      - ./db/simple_site.sql:/docker-entrypoint-initdb.d/simple_site.sql

volumes:
  db_data:
```
В терминала изпълнете командата:
```
docker-compose up --build
```
След стартиране:

Приложението ще бъде достъпно на ```http://localhost:8080```

Базата ще бъде автоматично създадена и инициализирана от simple_site.sql.

Структура на проекта:
```
.
├── src/
│   ├── add_user.php       # PHP скрипт за добавяне на потребител
│   └── config.php         # Настройки за връзка с MariaDB
│
├── db/
│   └── simple_site.sql    # SQL скрипт за създаване и инициализация на базата
│
├── docker-compose.yml     # Конфигурация за Docker услуги
└── README.md              # Този файл
```

Как работи всеки от компонентите
src/add_user.php
 - Приема POST заявка от HTML форма с полета name и email.
- Свързва се с базата чрез PDO.
- Вмъква нов потребител в таблицата users.

src/config.php
- Съдържа информация за връзка с базата данни:
- Host: db (името на MariaDB услугата в Docker)
- База: simple_site
- Потребител: user
- Парола: pass

db/simple_site.sql
Създава база simple_site и таблица users.

Вмъква един примерен запис:
```
zlatko | 21314@uktc-bg.com
```

Комуникация между услугите:
- Услугата web (PHP) комуникира с услугата db (MariaDB) през Docker мрежа.
- Чрез Docker Compose, контейнерите се свързват автоматично по име (напр. db).
- depends_on гарантира, че MariaDB стартира преди PHP.
