# Documentación del Proyecto: Calvo & Garcia Abogados

## 1. Identificación del Proyecto (1.5 Puntos)

### 1.1 Identificación y Competencia
**Proyecto:** Sitio web corporativo para el bufete de abogados "Calvo & Garcia Abogados".
**Objetivo:** Ofrecer servicios legales especializados (Civil, Penal, Laboral, Mercantil) a particulares y empresas, transmitiendo confianza, profesionalidad y cercanía.
**Competencia:** Otros despachos de abogados locales y plataformas de asesoría jurídica online.

### 1.2 Estudio de Palabras Clave y Público Objetivo

**Palabras Clave (Keywords):**
- Abogados [Ciudad] (e.g., Abogados Madrid/Barcelona)
- Despacho de abogados
- Asesoría legal experta
- Abogado divorcio
- Abogado laboralista
- defensa penal
- Calvo & Garcia

**Público Objetivo (Target Audience):**
- Particulares: Personas de 30-60 años que necesitan resolver conflictos personales (divorcios, herencias) o laborales.
- Empresas: PYMES que requieren asesoría legal recurrente.

**Buyer Persona:**
- **Nombre:** Carlos Martínez
- **Edad:** 45 años
- **Ocupación:** Dueño de una pequeña empresa de logística.
- **Necesidad:** Busca un abogado de confianza para revisar contratos con proveedores y gestionar un despido disciplinario. Valora la rapidez de respuesta y la claridad en los honorarios.

### 1.3 KPIs (Key Performance Indicators)
1.  **Formularios de contacto enviados:** Objetivo > 10 mensuales.
2.  **Llamadas telefónicas desde el móvil (Click-to-Call):** Objetivo > 15 mensuales.
3.  **Tiempo de permanencia en la página de Servicios:** > 2 minutos (indica interés).

### 1.4 Prototipado (Wireframe/Retícula)

**Estructura General (Grid):**
- **Header:** Logo (Izquierda) | Menú Navegación (Derecha)
- **Hero:** Imagen de fondo profesional + H1 ("Defendemos tus derechos") + CTA ("Contáctanos")
- **Main Section:** 3 Columnas destacando servicios principales.
- **Team Section:** Foto y bio breve de los socios.
- **Footer:** Datos de contacto, Enlaces legales, Mapa del sitio.

### 1.5 Dominio y Estrategia
- **Dominio Propuesto:** `www.calvoygarciaabogados.es` (Si está disponible) o `www.calvogarcia-legal.com`.
- **Alineación:** Contiene las palabras clave de marca y la actividad ("abogados"), fácil de recordar.

### 1.6 Estudio de Tecnologías

#### Frontend
- **HTML5 Semántico:** Estructura limpia y accesible.
- **CSS3:** Diseño Responsive mediante Flexbox y Grid, variables CSS para theming.
- **JavaScript:** Lógica de banner de cookies y validaciones simples.

#### Backend
- **Lenguaje:** PHP 8 (Compatible con XAMPP).
- **Base de Datos:** MySQL / MariaDB.
- **Servidor Web:** Apache (vía XAMPP).
- **Conectividad:** Uso de PDO para prevenir inyecciones SQL.

### 1.7 Guía de Estilo
- **Colores:**
  - Principal: Azul Marino (`#003366`) - Transmite confianza y seriedad.
  - Secundario: Dorado/Ocre (`#C5A059`) - Acento para botones y llamadas a la acción, evoca prestigio.
  - Fondo: Blanco o Gris muy claro (`#F9F9F9`).
- **Tipografía:**
  - Títulos: 'Cinzel' o 'Playfair Display' (Serif) - Tradicional y elegante.
  - Cuerpo: 'Lato' o 'Open Sans' (Sans-serif) - Legible y moderna.

## 2. Instrucciones de Despliegue (XAMPP)

1.  **Copiar Archivos:** Mover la carpeta del proyecto a `C:\xampp\htdocs\Decima`.
2.  **Base de Datos:**
    - Abrir `phpMyAdmin` (`http://localhost/phpmyadmin`).
    - Importar el script `sql/database.sql` para crear la BD `calvoygarcia` y tablas.
3.  **Configuración:** Verificar credenciales en `includes/db.php` (Usuario: `root`, Pass: vacío por defecto).
4.  **Ejecución:** Abrir navegador en `http://localhost/Decima/index.html`.
5.  **Panel Admin:** Acceder a `http://localhost/Decima/admin/login.php` (Usuario: `admin`, Pass: `admin`).

---
**Nota sobre validación y cumplimiento:**
Se realizarán validaciones W3C para HTML y CSS. Se seguirán pautas WCAG para accesibilidad.
