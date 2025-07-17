Este proyecto es una prueba técnica para la empresa Clicko desarrollada con **Laravel 12** y una interfaz frontend construida con **Vue 3 + Vite**.

Permite:
- Registrar e iniciar sesión con usuarios
- Visualizar todos los usuarios registrados
- (Crear los usuarios se crean al registrarse), Editar y eliminar usuarios
- Visualizar los dominios de email más comunes (top 3)
- Crear 20 usuarios con el SEEDER

---

## ⚙️ Requisitos del sistema

- PHP >= 8.2
- Composer
- MySQL
- Node.js >= 18.x
- NPM >= 8.x
- Laravel 12
- Laravel Sanctum (para autenticación por token)

---

## 🚀 Instalación del proyecto

1. Clonar el repositorio:

git clone https://github.com/Hugofq23/PruebaTecnica.git/

2. Ejecutar los sigueintes comandos desde la raiz /PruebaTecnica:

- Instalar dependencias: composer install, npm install
- Configurar el archivo .env: DB_DATABASE=prueba_clicko, DB_USERNAME=root, DB_PASSWORD= (En caso de no tener el archivo .env simplemente hay que ejecutar este comando `cp .env.example .env`)
- Generar la clave de la aplicación: php artisan key:generate
- Ejecutar las migraciones y el seeder: php artisan migrate:fresh --seed (Asi el seeder creara 20 usuarios en la BBDD)
- Levantar el servidor: En un terminal php artisan serve y en otro terminal npm run dev

## 📌 Rutas de la API para usar en POSTMAN

| Método | Ruta            | Descripción                 | Datos requeridos            |
| ------ | --------------- | --------------------------- | --------------------------- |
| POST   | `/api/register` | Registrar usuario           | `name`, `email`, `password` |
| POST   | `/api/login`    | Iniciar sesión              | `email`, `password`         |

Al hacer login nos devolvera un token el cual tendremos que usar en la pestaña ***AUTHORIZATION*** y en ***AUTH TYPE*** seleccionamos la opcion ***BEARER TOKEN*** y en ***TOKEN*** añadimos el que nos a devuelto /api/login

| Método | Ruta              | Descripción      | Autenticación | Datos requeridos            |
| ------ | ----------------- | ---------------- | ------------- | --------------------------- |
| GET    | `/api/users`      | Listar usuarios  | ✅            |                             |
| PUT    | `/api/users/{id}` | Editar usuario   | ✅            | `name`, `email`             |
| DELETE | `/api/users/{id}` | Eliminar usuario | ✅            |                             |

La siguiente ruta es para obtener los 3 dominios mas usados en orden descendente en la cual no es necesaria el token

| Método | Ruta                 | Descripción                        | Autenticación |
| ------ | -------------------- | ---------------------------------- | ------------- |
| GET    | `/api/email-domains` | Devuelve los 3 dominios más usados | ❌​            |

## 🖥️ Interfaz Gráfica

1. Vista de /login y /register pudiendo intercambiar la vista con el botón de "No tienes cuenta" y "Ya tienes cuenta"

2. Panel /users:

- Tabla de usuarios registrados

- Botones para editar/eliminar (visibles en todos los casos)

- Botón para mostrar los 3 dominios de email más usados

