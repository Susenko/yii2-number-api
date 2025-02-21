# Yii2 Number API

## Опис проекту

Розробка REST API сервісу для обробки числових даних.

### Функціональні вимоги проекту

- Приймає масив чисел у форматі JSON.
- Обчислює суму всіх парних чисел з масиву.
- Повертає результат обчислення.

### Технічні вимоги проекту

- **Мова**: PHP 8.3+ (Yii2 Framework)
- **SOLID** та **DTO**
- **Валідація** вхідних даних
- **Обробка помилок**
- **Тестування**: PHPUnit (мінімум 80% покриття)
- **Контейнеризація**: Docker, Makefile
- **Порт**: 8000

# 📌 Yii2 Number API

## 🚀 Інструкція з встановлення

### 📂 1. Клонуємо репозиторій

```sh
git clone https://github.com/your-username/yii2-number-api.git
cd yii2-number-api
```

### 🔍 2. Перевіряємо наявність необхідних залежностей

```sh
./check-dependencies.sh
```

### 🛠 3. Білд та запуск Docker-контейнера

```sh
make build
make start
```

### 🔄 4. Відправляємо тестові запити на API (приклади використання)

```sh
curl -X POST http://localhost:8000/api/sum-even \
    -H "Content-Type: application/json" \
    -d '{"numbers": [1, 2, 3, 4, 5, 6]}'
```

Очікувана відповідь:

```json
{
  "status": "success",
  "sum": 12,
  "mode": "even"
}
```

```sh
curl -X POST http://localhost:8000/api/sum-even \
    -H "Content-Type: application/json" \
    -d '{"numbers": [1, 2, 3, 4, 5, ff]}'
```

Очікувана відповідь 400 error Bad request:

```json
{
  "status": "error",
  "message": "Invalid JSON data in request body: Syntax error"
}
```

```sh
curl -X POST http://localhost:8000/api/sum-even \
    -H "Content-Type: application/json" \
    -d '{"numbers": [1, 2, 3, 4, 5, ff]}'
```

Очікувана відповідь 400 error Bad request:

```json
{
  "status": "error",
  "message": "Invalid JSON data in request body: Syntax error"
}
```

```sh
curl -X POST http://localhost:8000/api/sum-even \
    -H "Content-Type: application/json" \
    -d '{"numbers": [1, 2, 3, 4, 5, "шість"]}'
```

Очікувана відповідь 400 error Bad request:

```json
{
  "status": "error",
  "message": "Неправильний формат даних. Очікуються лише числа."
}
```

```sh
curl -X POST http://localhost:8000/api/sum-even \
    -H "Content-Type: application/json" \
    -d '{"n": [1, 2, 3, 4, 6]}'
```

Очікувана відповідь 400 error Bad request:

```json
{
  "status": "error",
  "message": "Missing \"numbers\" key in request."
}
```

## 📂 Структура проекту

- **`controllers/`** – Контролери, обробка запитів (`ApiController.php`).
- **`dto/`** – Data Transfer Objects (DTO) для передачі структурованих даних.
- **`services/`** – Логіка обчислень, бізнес-логіка (`SumEvenCalculator.php`).
- **`validators/`** – Валідація вхідних даних (`NumbersValidator.php`).
- **`tests/`** – Юніт-тести (`SumEvenNumbersTest.php`).
- **`config/`** – Конфігурації додатку (`web.php`, `params.php`).
- **`web/`** – Вхідна точка (`index.php`), фронтенд файли (CSS, JS).
- **`Makefile`** – Команди для запуску, білду та логування контейнера.
- **`Dockerfile`** – Опис середовища для контейнера (PHP, Xdebug, Composer).
- **`docker-compose.yml`** – Конфігурація сервісів та залежностей.

## 🏗 Приклади застосування SOLID у проекті

| Принцип                                                          | Опис                                                                         | Приклад у проекті                                                                                                                     |
| ---------------------------------------------------------------- | ---------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- |
| **S** – Single Responsibility                                    | Клас повинен мати лише одну зону відповідальності.                           | `SumEvenCalculator.php` містить тільки логіку підрахунку суми парних чисел. Валідація винесена у `NumbersValidator.php`.              |
| **O** – Open/Closed                                              | Клас має бути відкритий для розширення, але закритий для змін.               | `SumCalculatorInterface.php` дозволяє додавати нові алгоритми обчислень без зміни існуючого коду.                                     |
| **L** – Liskov Substitution (Принцип підстановки Барбари Лісков) | Дочірні класи повинні повністю замінювати базовий клас без змін у поведінці. | `SumEvenCalculator` реалізує `SumCalculatorInterface`, тому його можна замінити іншим калькулятором без зміни логіки `ApiController`. |
| **I** – Interface Segregation                                    | Інтерфейси повинні бути вузькоспеціалізованими, а не містити зайві методи.   | `SumCalculatorInterface.php` містить лише один метод `calculate()`, що робить інтерфейс простим.                                      |
| **D** – Dependency Inversion                                     | Класи повинні залежати від абстракцій, а не від конкретних реалізацій.       | `ApiController` отримує `SumCalculatorInterface` через ін'єкцію залежностей, що дозволяє змінювати логіку без зміни коду контролера.  |

### ✅ Готово! 🚀

```

```
