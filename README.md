# Cita Medica

Sistema de gestion de citas medicas basado en Laravel.

## Modelos principales (`app/Models`)
- `Paciente`: datos basicos del paciente; relacion `hasMany` con `Cita`.
- `Empleado`: profesional que atiende citas; `hasMany` `HorarioEmpleado` y `Cita`.
- `Especialidad`: catalogo de especialidades; `belongsToMany` con `Empleado`.
- `Consultorio`: ubicaciones; relaciones con `HorarioEmpleado` y `Cita`.
- `HorarioEmpleado`: disponibilidad por empleado/dia/consultorio.
- `Cita`: referencia a paciente, empleado, consultorio y especialidad; incluye estado y metadatos.

## Migraciones clave (`database/migrations`)
- `empleado`, `paciente`, `especialidad`, `consultorio`
- `horario_empleado`
- `cita`
- `empleado_especialidad` (pivote muchos-a-muchos)
- Migraciones de soporte para pagos, tokens y ajustes de indices.

### Relaciones principales
- `Cita` pertenece a `Paciente`, `Empleado`, `Consultorio`, `Especialidad`.
- `Empleado` tiene muchas `Cita` y `HorarioEmpleado`; muchos-a-muchos con `Especialidad` via `empleado_especialidad`.
- `Paciente` tiene muchas `Cita`.
- `HorarioEmpleado` pertenece a `Empleado` y `Consultorio`.

## Puesta en marcha rapida
1) Variables de entorno y BD: copiar `.env.example` a `.env` y ajustar `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
2) Dependencias y clave: `composer install` y `php artisan key:generate`.
3) Migraciones: `php artisan migrate`.
4) Frontend (opcional): `npm install` y `npm run dev` (o `npm run build`).
