![Logo DISFARMA](public/sb-admin/img/logo_unah.png)
# Sistema de Gestión Farmacéutica — DISFARMA Honduras

Aplicación web administrativa desarrollada en **Laravel 11** y **Bootstrap 4 (SB Admin 2)** para la gestión integral de inventario farmacéutico, proveedores mayoristas, nómina de personal e indicadores gerenciales (KPIs).

---

## Credenciales de Acceso (Usuario Administrador)

El sistema cuenta con un usuario administrador configurado para pruebas y evaluación:

* **Correo institucional:** `admin@disfarma.hn`
* **Contraseña:** `12345678`

> **Nota para evaluación en entorno nuevo:** Si el proyecto se despliega desde cero en una base de datos vacía, ejecute el comando de creación rápida indicado en el **Paso 5** de la instalación para generar estas credenciales al instante.

---

## Módulos Implementados

1. **Sistema de Autenticación y Seguridad:**
   * Inicio de sesión validado exclusivamente para dominio institucional (`@disfarma.hn`).
   * Funcionalidad de *"Recordar mi sesión"*, cifrado de contraseñas con **Bcrypt**, protección contra ataques CSRF (`@csrf`) y regeneración/invalidación de sesión para prevenir *Session Fixation*.
2. **Dashboard Gerencial (KPIs):**
   * Cálculo dinámico en tiempo real de: total de medicamentos en catálogo, total de proveedores activos, total de empleados en nómina y valoración monetaria total del inventario en Lempiras (`inventario * precio`).
3. **Medicamentos e Inventario Farmacéutico:**
   * CRUD completo con validación de SKU único, precios y existencias.
   * Carga segura de fotografías de empaques en `public/uploads/medicamentos/` (formatos `.jpg`, `.png`, `.webp`, máx. 5 MB).
   * Alertas visuales de stock mediante badges semánticos (*Óptimo*, *Moderado*, *¡Desabastecimiento!*), buscador por nombre/SKU y paginación.
4. **Laboratorios y Proveedores Mayoristas:**
   * CRUD completo con validación estricta de RTN (14 dígitos numéricos únicos), teléfono nacional (8 dígitos iniciando en 2, 3, 8 o 9), límite y plazos de crédito (15, 30, 45 y 60 días).
5. **Recursos Humanos y Personal Farmacéutico:**
   * CRUD de colaboradores con validación de DNI (13 dígitos numéricos sin guiones), asignación de cargos farmacéuticos, salarios base en Lempiras (`L. XX,XXX.XX`) y control de estado.

---

## Requisitos Previos

* PHP >= 8.2
* Composer
* MySQL / MariaDB (o SQLite)

---

## Instalación y Despliegue Local

1. **Clonar el repositorio e ingresar al directorio:**
   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd examen-dos
   ```

2. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Configurar variables de entorno:**
   Copie el archivo de ejemplo y genere la clave de la aplicación:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Edite el archivo `.env` con las credenciales de su base de datos (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4. **Ejecutar las migraciones de la base de datos:**
   ```bash
   php artisan migrate
   ```

5. **Crear el usuario administrador:**
   ```bash
   php artisan tinker --execute="App\Models\User::create(['name' => 'Admin Disfarma', 'email' => 'admin@disfarma.hn', 'password' => '12345678']);"
   ```

6. **Iniciar el servidor de desarrollo:**
   ```bash
   php artisan serve
   ```
   Acceda desde el navegador a `http://127.0.0.1:8000`.

---

## Autor

* **Carlos Manuel Machigua Espinal** — Ingeniería en Sistemas, UNAH.
* **NOTA**: Terminé temprano ya que tenía compromisos en la tarde/noche y no me daría tiempo, así que hice lo posible por terminar antes, espero esté bien el resultado.