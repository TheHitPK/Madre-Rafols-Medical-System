# Sistema de Cardiología

Registro de estudios para uso en la red local, por áreas:
- **Cardiología**: ecocardiogramas, holters y MAPA.
- **Imágenes**: qué tipo de estudio se hizo (Rayos X, ecografía, tomografía...) y, opcionalmente, el informe médico en PDF o Word.
PHP 8.1 + MariaDB 10.4 (XAMPP), Bootstrap 5, jQuery y DataTables. Funciona sin internet.

## Instalación / actualización

> **Orden importante:** primero la base de datos, después el código.
> Las migraciones solo **agregan** columnas, índices y tablas, así que la versión anterior del sistema
> sigue funcionando con la base ya migrada. Al revés no: el código nuevo necesita las migraciones.

1. **Respaldo**: phpMyAdmin → base `cardiologia` → Exportar.
2. **Migraciones**: en phpMyAdmin → pestaña SQL, ejecutar en este orden:
   1. `documents/app/database/migracion_01_seguridad.sql` (contraseñas seguras, índices).
   2. `documents/app/database/migracion_02_auditoria.sql` (auditoría, papelera, marcas compartidas).
   3. `documents/app/database/migracion_03_imagenes.sql` (áreas y módulo de Imágenes; los usuarios actuales quedan en Cardiología).

   Se pueden ejecutar más de una vez sin problema.
3. **Código**: copiar la carpeta del proyecto a `C:\xampp\htdocs\`.
4. **Configuración**: revisar `documents/app/config/config.php` (datos de conexión, cédulas autorizadas a eliminar, tiempo de sesión,
   carpeta de informes `INFORMES_DIR`).
5. **Sacar el respaldo de datos de la carpeta web**: `documents/app/database/cardiologia.sql` contiene datos reales de pacientes.
   Está bloqueado por `.htaccess`, pero lo correcto es guardarlo fuera de `htdocs`.
6. **Usuario de base de datos propio** (recomendado): instrucciones al final de `migracion_01_seguridad.sql`.

**Volver a la versión anterior:** es posible (la base migrada es compatible), pero los usuarios que ya
iniciaron sesión con la versión nueva tienen la contraseña en formato bcrypt y la versión anterior no puede
validarla; habría que restaurar el respaldo de la base o reasignarles la contraseña.

Después de actualizar, cada usuario debe iniciar sesión otra vez. Las contraseñas antiguas siguen funcionando
y se convierten a formato seguro (bcrypt) automáticamente en ese primer inicio de sesión.

## Respaldos

Hay que respaldar **dos cosas**:
1. La base de datos (phpMyAdmin → Exportar).
2. La carpeta de informes médicos de Imágenes: `C:\xampp\informes_imagenes` (`INFORMES_DIR` en `config.php`).
   Los archivos están fuera de `htdocs` a propósito: solo se abren desde el sistema, que revisa la sesión y el área,
   y cada consulta queda en la auditoría.

## Áreas, roles y permisos

Cada usuario tiene un **rol** (Administrador o Empleado) y un **área** (Cardiología o Imágenes).
- **Administradores**: ven y gestionan todas las áreas. Crean usuarios (también otros administradores).
- **Empleados**: solo ven los módulos de su área. Un empleado de Imágenes no ve ecos, holters ni MAPA, y al revés;
  en el historial de pacientes solo aparecen los estudios de su área.
- Un cambio de área o de rol se aplica al instante, sin que el usuario tenga que volver a entrar.

| Acción | Administrador | Empleado | Empleado autorizado¹ |
|---|:-:|:-:|:-:|
| Ver, agregar y editar los estudios de su área | ✔ (todas) | ✔ | ✔ |
| Subir, reemplazar y quitar informes (Imágenes) | ✔ | ✔ | ✔ |
| Eliminar estudios (van a la papelera) | ✔ | ✘ | ✔ |
| Agregar y editar tipos de estudio (Imágenes) | ✔ | ✔ | ✔ |
| Eliminar tipos de estudio | ✔ | ✘ | ✘ |
| Historial de pacientes (de su área) | ✔ (todas) | ✔ | ✔ |
| Agregar y editar médicos | ✔ | ✔ | ✔ |
| Eliminar médicos | ✔ | ✘ | ✘ |
| Centros de costo | ✔ | ✘ | ✘ |
| Usuarios | ✔ | ✘ | ✘ |
| Auditoría y restaurar registros eliminados | ✔ | ✘ | ✘ |

¹ Cédulas listadas en `CEDULAS_AUTORIZADAS_ELIMINAR` (`config.php`).

Todos los permisos se validan en el servidor, no solo en la pantalla.

## Funciones principales

- **Auditoría** (menú Módulos → Auditoría): quién creó, editó o eliminó cada registro y cuándo, con los campos que cambiaron;
  cambios de usuarios; inicios de sesión correctos, fallidos y bloqueados.
- **Papelera**: eliminar un estudio no lo borra; un administrador lo restaura desde Auditoría.
- **Historial de pacientes**: busca por cédula o nombre y muestra juntos todos los estudios del paciente de las áreas que el usuario puede ver.
- **Informes médicos (Imágenes)**: PDF o Word (.doc/.docx) de hasta `INFORME_MAX_MB` MB. Se revisa el contenido real del archivo,
  no solo la extensión. Los PDF se abren en una pestaña; los Word se descargan.
- **Autocompletar**: al escribir la cédula en "Nuevo", el sistema ofrece los datos ya registrados del paciente.
  No hay una tabla única de pacientes a propósito: la misma cédula puede corresponder a más de una persona
  (por ejemplo, menores registrados con la cédula de un familiar), así que el usuario elige.
- **Marcas** (checkbox junto a la factura): se guardan en la base de datos y las ven todos los equipos.
  La primera vez que cada equipo abre una tabla, se suben las marcas que tenía guardadas en su navegador.

## Estructura

```
index.php                  Login
documents/app/
  config/config.php        Configuración (único archivo a editar al instalar)
  core/                    Arranque, sesión y permisos, CSRF, validación, auditoría
  models/                  Acceso a datos (consultas preparadas). EstudioModel es común a ecos/holters/mapas/imágenes
  controllers/             Endpoints AJAX: un archivo por acción, todos validan sesión y permisos
  views/                   Páginas, tablas (fragmentos AJAX), modales y JS de cada módulo
  database/                Respaldo y migraciones (bloqueado al navegador)
documents/assets/          CSS, JS y fuentes locales
```

Respuestas de los controladores: `1` éxito, `2` registro repetido, `3` caso especial (contraseña corta / tiene estudios asociados),
`4` datos inválidos, `5` informe no válido o muy grande, `6` estudio guardado pero el informe no, `0` error. Sesión vencida → HTTP 401; sin permiso o token CSRF inválido → HTTP 403.

Al modificar archivos JS o CSS propios, subir `ASSET_VERSION` en `config.php` para que los navegadores descarguen la versión nueva.

## HTTPS en la red local (recomendado)

Sin HTTPS, las contraseñas y los datos de pacientes viajan sin cifrar por la red. Con XAMPP:

1. Generar un certificado para el nombre o IP del servidor. La forma más simple es [mkcert](https://github.com/FiloSottile/mkcert):
   `mkcert -install` y luego `mkcert 192.168.1.10 servidor-cardiologia` (usar la IP/nombre reales).
2. Copiar los archivos generados a `C:\xampp\apache\conf\ssl.crt\` y `ssl.key\`, y apuntar a ellos en
   `C:\xampp\apache\conf\extra\httpd-ssl.conf` (`SSLCertificateFile` y `SSLCertificateKeyFile`).
3. Instalar la autoridad de mkcert (`mkcert -CAROOT` muestra dónde está `rootCA.pem`) en cada PC que use el sistema,
   para que el navegador no muestre advertencias.
4. Reiniciar Apache y entrar por `https://<servidor>/cardiologia/`.

El sistema detecta HTTPS y marca la cookie de sesión como segura automáticamente.

## Problemas comunes

| Síntoma | Causa probable |
|---|---|
| Todo da "contacte al administrador" después de actualizar | Falta ejecutar una migración. El log de Apache (`C:\xampp\apache\logs\error.log`) dice "FALTA EJECUTAR UNA MIGRACIÓN". |
| "Access denied" al conectar | Usuario/contraseña de `config.php` no coinciden con MariaDB. |
| Página muy lenta (segundos) | `DB_HOST` debe ser `127.0.0.1`, no `localhost`. |
| "Demasiados intentos fallidos" | 5 intentos fallidos desde ese equipo: esperar 10 minutos (`LOGIN_LOCK_MINUTES`). |
| Cambios en JS/CSS no se ven | Subir `ASSET_VERSION` en `config.php`. |
