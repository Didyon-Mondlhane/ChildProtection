# 🧒 ChildProtection Comparator Laravel

Aplicação web desenvolvida com **Laravel 12** para classificar e comparar a situação de protecção infantil em diferentes países, com foco em actividades laborais perigosas para crianças. Interface moderna com Bootstrap 5, exportação de dados, paginação customizada e validação de dados integrada.

---

## 🛠️ Tecnologias Utilizadas

- **PHP 8.2**
- **Laravel 12.19.3**
- Composer 2.8.6
- Blade (motor de templates Laravel)
- Bootstrap 5 (via Vite)
- Sass (pré-processador CSS)
- MySQL
- Eloquent ORM
- Laravel Pagination
- Laravel Excel (Maatwebsite)

---

## 🚀 Funcionalidades Principais

### 🌍 Comparação Internacional
- Comparar protecção infantil entre países
- Exportar relatórios em PDF
- Visualizar dados por actividade e sector

### 🗂️ Gestão de Entidades
- **Países**: adicionar, editar, visualizar e eliminar
- **Actividades Proibidas**: gerir lista de trabalhos perigosos
- **Sectores**: definir áreas de actividade económica
- **Actividades por País**: associar dados por país e sector

### 🎨 Interface Moderna
- Layout escuro com Bootstrap 5
- Paginação customizada
- Formulários com validações e mensagens de erro claras

---

## 📂 Estrutura de Rotas

| Método   | Rota                                | Descrição                                      |
|----------|-------------------------------------|-----------------------------------------------|
| GET      | `/`                                 | Página inicial                                 |
| GET      | `/comparisons`                      | Listar comparações                             |
| GET      | `/comparisons/{id}`                 | Ver detalhes de comparação                     |
| GET      | `/exports/pdf`                      | Exportar relatório em PDF                      |
| GET      | `/countries`                        | Listar países                                  |
| GET      | `/countries/create`                 | Formulário de novo país                        |
| POST     | `/countries`                        | Guardar novo país                              |
| GET      | `/countries/{id}`                   | Ver detalhes do país                           |
| GET      | `/countries/{id}/edit`              | Editar país                                    |
| PUT      | `/countries/{id}`                   | Actualizar país                                |
| DELETE   | `/countries/{id}`                   | Eliminar país                                  |
| GET      | `/prohibited-activities`            | Listar actividades proibidas                   |
| GET      | `/prohibited-activities/create`     | Formulário de nova actividade proibida         |
| POST     | `/prohibited-activities`            | Guardar actividade proibida                    |
| GET      | `/prohibited-activities/{id}`       | Ver actividade proibida                        |
| GET      | `/prohibited-activities/{id}/edit`  | Editar actividade proibida                     |
| PUT      | `/prohibited-activities/{id}`       | Actualizar actividade proibida                 |
| DELETE   | `/prohibited-activities/{id}`       | Eliminar actividade proibida                   |
| GET      | `/sectors`                          | Listar sectores                                |
| GET      | `/sectors/create`                   | Formulário de novo sector                      |
| POST     | `/sectors`                          | Guardar novo sector                            |
| GET      | `/sectors/{id}`                     | Ver sector                                     |
| GET      | `/sectors/{id}/edit`                | Editar sector                                  |
| PUT      | `/sectors/{id}`                     | Actualizar sector                              |
| DELETE   | `/sectors/{id}`                     | Eliminar sector                                |
| GET      | `/country-activities`               | Listar actividades por país                    |
| GET      | `/country-activities/create`        | Formulário de nova associação país-actividade  |
| POST     | `/country-activities`               | Guardar associação país-actividade             |
