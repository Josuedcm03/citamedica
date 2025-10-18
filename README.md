# Cita Médica

Este repositorio implementa la asignación de creación de modelos y migraciones para un sistema de gestión de citas médicas.

## Asignación realizada

- Modelos creados (`app/Models`):
  - `Paciente`: datos básicos del paciente y relación `hasMany` con `Cita`.
  - `Medico`: datos del médico, `hasMany` `HorarioMedico` y `hasMany` `Cita`.
  - `Especialidad`: catálogo de especialidades; relación `belongsToMany` con `Medico`.
  - `Consultorio`: datos del consultorio y relaciones con `HorarioMedico` y `Cita`.
  - `HorarioMedico`: horario disponible del médico por día/consultorio.
  - `Cita`: referencia a paciente, médico, consultorio y especialidad, con estado y metadatos.

- Migraciones creadas (`database/migrations`):
  - `paciente`
  - `medico`
  - `especialidad`
  - `consultorio`
  - `horario_medico`
  - `cita`
  - `medico_especialidad` (tabla pivote para la relación muchos-a-muchos)

### Relaciones principales

- `Cita` pertenece a: `Paciente`, `Medico`, `Consultorio`, `Especialidad`.
- `Paciente` tiene muchas `Cita`.
- `Medico` tiene muchas `Cita` y `HorarioMedico`; además, muchos-a-muchos con `Especialidad` vía `medico_especialidad`.
- `HorarioMedico` pertenece a `Medico` y `Consultorio`.

## Tecnologías utilizadas

- Backend: PHP `^8.2`, Laravel `^12.0` (Eloquent ORM, Migraciones)
- Base de datos: MySQL 
- Frontend/Build: Vite, Tailwind CSS 4, Axios
- Herramientas: Composer, Node.js + NPM

## Puesta en marcha rápida

1. Copiar variables de entorno y ajustar conexión a BD:
   - `cp .env.example .env` (o crear `.env`)
   - Configurar `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
2. Instalar dependencias y generar clave:
   - `composer install`
   - `php artisan key:generate`
3. Crear esquema de base de datos:
   - `php artisan migrate`
4. (Opcional) Frontend en desarrollo/compilación:
   - `npm install`
   - `npm run dev` (o `npm run build` para producción)
