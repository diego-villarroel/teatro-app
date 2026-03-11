# Plan: Documentación + Refactorización a Arquitectura Hexagonal en PHP Vanilla

**TL;DR**: Crearemos un documento MD educativo con 3 secciones (teoría, comparativa con arquitectura actual, pasos prácticos) seguido de un plan de refactorización en fases. El proyecto pasará de una estructura incompleta con Singletons acoplados a una arquitectura con puertos/adaptadores inyectables, sin dependencias externas (solo PDO de PHP). Las fases incluyen: crear puertos (interfaces), refactorizar repositorios, implementar casos de uso, adaptar controladores y configurar bootstrap.

**Decisiones clave**:
- **Patrón de inyección**: Constructor injection sin contenedor DI (PHP vanilla)
- **Estructura de carpetas**: Separar `src/Domain`, `src/Application`, `src/Infrastructure` y `src/Presentation`
- **Repositorios**: Interfaz `RepositoryInterface` + `SQLiteRepository` implementación
- **Servicios/Casos de uso**: `TeatroFinder`, `PersonalCreator`, etc. (Use Case Layer)
- **Puntos de entrada**: Bootstrap en `public/index.php` con router simple

---

## Estructura del Plan

### **Fase 1: Documento educativo MD** 
Crear `docs/ARQUITECTURA_HEXAGONAL.md` con:
1. **Introducción teórica**: Qué es hexagonal, por qué la usamos
2. **Comparación antes/después**: Tu proyecto actual vs. refactorizado
3. **Anatomía en tu contexto**: Domain Layer (Teatro, Personal), Application Layer (casos de uso), Infrastructure Layer (SQLiteRepository), Presentation Layer (Controllers)
4. **Patrón de inyección de dependencias**: Manual en PHP vanilla
5. **Ejemplo práctico paso a paso**: Cómo obtener todos los teatros (antes y después)

### **Fase 2: Refactorización estructural**
1. **Crear nuevas carpetas**:
   - `src/Domain/` (entidades + interfaces de puertos)
   - `src/Application/` (casos de uso/servicios)
   - `src/Infrastructure/` (implementaciones, SQLiteRepository)
   - `src/Presentation/` (Controllers, ResponseFormatter)
   - `src/Shared/` (excepciones, utilidades compartidas)

2. **Crear `composer.json`** básico:
   - PSR-4 autoloading
   - Permite namespace consistente sin require manuales
   - `php -r "require 'vendor/autoload.php';"`

3. **Refactorizar modelos existentes**:
   - Mover Teatro, Personal, etc. a `Domain/Models/`
   - Agregar namespace consistent
   - Convertir `ElementoAudio` y otros sin namespace

### **Fase 3: Crear puertos e interfaces**
1. **Puertos (Interfaces)**:
   - `Domain/Ports/TeatroRepositoryInterface.php` (operaciones sobre Teatro)
   - `Domain/Ports/PersonalRepositoryInterface.php`
   - `Domain/Ports/ElementoAudioRepositoryInterface.php`
   - etc.

2. **Refactorizar SQL Connection**:
   - De Singleton global → `Infrastructure/Persistence/SQLiteConnection.php` (inyectable)
   - Crear `Infrastructure/Persistence/SQLiteTeatroRepository.php` que implemente `TeatroRepositoryInterface`

### **Fase 4: Crear capa de aplicación (Casos de Uso)**
1. **Application/UseCases/**:
   - `GetAllTeatros.php` (recibe inyección de TeatroRepositoryInterface)
   - `CreatePersonal.php`
   - `GetElementosAudio.php`
   - etc.

2. Cada caso de uso:
   - Recibe puertos via constructor
   - Implementa lógica de negocio
   - Retorna resultado o lanza excepciones de dominio

### **Fase 5: Adaptar presentación**
1. **Refactorizar TeatrosController**:
   - Constructor recibe inyección de casos de uso
   - Cada acción HTTP llama a un caso de uso
   - Traduce respuestas a JSON/HTTP responses

2. **Crear router simple** en `public/index.php`:
   - Parsear `REQUEST_METHOD` + `REQUEST_URI`
   - Instanciar dependencias
   - Llamar controlador correspondiente

3. **Agregar middleware** (tratado como adaptador):
   - CORS
   - Content-Type validation
   - Error handler global

### **Fase 6: Configuración y bootstrap**
1. **Crear `config/` directorio**:
   - `config/app.php` (configuración de app)
   - `config/database.php` (path a BD, credenciales si aplica)

2. **Crear `bootstrap/container.php`**:
   - Factory que instancia dependencias
   - Retorna objetos listos para inyectar
   - Centraliza la creación de objetos

3. **Actualizar `public/index.php`**:
   - Requerir autoload de composer
   - Requerir bootstrap
   - Manejar rutas
   - Capturar excepciones globales

### **Fase 7: Pruebas y validación**
1. Crear `tests/Unit/` para casos de uso
2. Crear `tests/Integration/` para repositorios
3. Validar flujos: Cliente HTTP → Controller → Caso de uso → Repositorio → BD

---

## Orden de Ejecución Recomendado

| # | Acción | Archivos afectados | Prioridad |
|---|--------|-------------------|-----------|
| 1 | Crear documento ARQUITECTURA_HEXAGONAL.md | Nuevo | **ALTA** |
| 2 | Agregar composer.json (solo PSR-4 autoloading) | Nuevo + raíz | **ALTA** |
| 3 | Refactorizar modelos a Domain/ con namespaces | Mover 8 archivos | **ALTA** |
| 4 | Crear interfaces de puertos en Domain/Ports/ | Nuevos | **ALTA** |
| 5 | Refactorizar SQLiteConnection a Infrastructure/ | Mover + adaptar | **MEDIA** |
| 6 | Crear repositories que implementen puertos | Nuevos en Infrastructure/ | **MEDIA** |
| 7 | Crear casos de uso en Application/UseCases/ | Nuevos | **MEDIA** |
| 8 | Refactorizar TeatrosController | Adaptar existente | **MEDIA** |
| 9 | Implementar router y bootstrap en public/ | Adaptar índex.php + nueva | **BAJA** |
| 10 | Migraciones/tests básicos | Opcionales | **BAJA** |

---

## Verificación y Testing

1. **Estructura de carpetas**:
   - ✓ src/Domain/Models/Teatro.php exist y tiene namespace
   - ✓ src/Domain/Ports/TeatroRepositoryInterface.php existe
   - ✓ src/Infrastructure/Persistence/SQLiteTeatroRepository.php existe
   - ✓ src/Application/UseCases/GetAllTeatros.php existe
   - ✓ src/Presentation/Controllers/TeatrosController.php existe

2. **Funcional - Flujo completo**:
   - Ejecutar: `php public/index.php` (o servidor local)
   - GET `/api/teatros` → Retorna JSON de BD
   - Verificar que no hay errores de namespace/require

3. **Inyección correcta**:
   - GetAllTeatros recibe TeatroRepositoryInterface via constructor
   - TeatrosController recibe GetAllTeatros via constructor
   - Sin Singletons globales

---

## Notas Técnicas

- **Sin composer.json inicialmente**: Necesitas agregarlo para PSR-4
- **Bootstrap manual**: Sin contenedor DI (próximo paso post-refactorización si se necesita complejidad)
- **SQLite**: Seguirá siendo inyectable, preparado para cambiar a MySQL/PostgreSQL
- **Validación**: Agregables en casos de uso o request objects futuros
- **Excepciones propias**: Crear `App\Shared\Exceptions\DomainException`, `ValidationException`, etc.

---

## Próximos Pasos

1. Revisar y refinar este plan
2. Proceder con Fase 1: crear documento educativo ARQUITECTURA_HEXAGONAL.md
3. Luego ejecutar fases 2-7 en orden




CONSULTAS DE ESTRUCTURAS

Excelente pregunta. La diferencia es fundamental en arquitectura hexagonal:

Las 3 propuestas comparadas
Opción 1: Domain/Models + Domain/Repositories + Domain/Services

❌ ANTICUADA (arquitectura en capas tradicional)
- Mezcla interfaces con implementaciones
- Repositories concretos en Domain = acoplamiento
- Services en Domain viola separación de responsabilidades
- Difícil cambiar de BD o adaptadores externos

Opción 2: Domain/Models + Domain/Repositories

⚠️ PARCIAL (mejor, pero incompleta)
- Models ✅ correcto
- Repositories aquí = PROBLEMA
  ¿Son interfaces o implementaciones?
  Si son interfaces → debería llamarse "Ports"
  Si son implementaciones → viola hexagonal

  Opción 3: Domain/Models + Domain/Ports (Mi sugerencia)

  ✅ CORRECTO (arquitectura hexagonal pura)
- Models = entidades del negocio puro
- Ports = interfaces/contratos que EL DOMAIN ESPERA
- Las implementaciones van en Infrastructure, NO en Domain

La diferencia clave: Puertos vs Repositorios
Aspecto	Repositories (Opción 2)	Ports (Opción 3 - Hexagonal)
¿Dónde viven?	Domain/	Domain/Ports/
¿Qué contienen?	¿Interfaces o código concreto? 🤔	Solo interfaces 📋
Implementación	En... ¿Application? ¿Infrastructure? 😕	Infrastructure/Persistence/ ✅
Flujo	Domain → Repositories (?)	Domain → Ports (contratos) ← Infrastructure (implementa)
Inyección	Confuso dónde inyectar	Claro: inyectar implementación de Infrastructure

Ejemplo visual
OPCIÓN 2 (confusa):

<?php
// Domain/Repositories/TeatroRepository.php ??? 
// ¿Esto es interfaz o clase concreta?
public function getAll() { ... }

OPCIÓN 3 (clara - Hexagonal):

<?php
// Domain/Ports/TeatroRepositoryInterface.php
interface TeatroRepositoryInterface {
    public function getAll(): array;
}

// Infrastructure/Persistence/SQLiteTeatroRepository.php
class SQLiteTeatroRepository implements TeatroRepositoryInterface {
    public function getAll(): array { /* código real */ }
}

Por qué Ports es mejor
El Domain NO depende de implementaciones → solo de contratos (interfaces)
Infrastructure implementa los Ports → el Domain "ignora" cómo se almacena
Cambiar de BD es trivial → crear nueva clase que implemente TeatroRepositoryInterface
Testeable → inyectar mock de TeatroRepositoryInterface en tests
Mi recomendación final
Usa Opción 3 (Domain/Models + Domain/Ports):

Sigue hexagonal puro
Las interfaces en Domain expresan qué necesita el negocio
Las implementaciones en Infrastructure expresan cómo lo hacemos
Máxima flexibilidad y mantenibilidad
Si ves "Repositories" en Domain en otros proyectos, probablemente es un atajo de arquitectura en capas tradicional, no hexagonal.





Resumen breve: En la arquitectura hexagonal la carpeta Application/UseCases (Fase 4) contiene los casos de uso: piezas que orquestan operaciones del dominio para cumplir una necesidad de la aplicación (p. ej. "Obtener todos los teatros"). Son la capa que coordina puertos (interfaces) y entidades, aplicando reglas de aplicación, validaciones, transacciones y devolviendo resultados neutrales al transporte (no hacen JSON ni manipulan HTTP).

Responsabilidades concretas:

Orquestar llamadas a puertos (repositorios, servicios externos) para realizar un flujo de negocio.
Encapsular la lógica de aplicación (qué debe hacerse y en qué orden), no la lógica de las entidades (esa vive en Domain).
Realizar validaciones de entrada y reglas de aplicación, levantar/exponer excepciones de dominio.
Definir límites transaccionales (abrir/cerrar transacciones si aplica).
Recibir dependencias por constructor (inyección de TeatroRepositoryInterface, etc.) para facilitar tests y cambio de adaptadores.
Retornar objetos/DTOs del dominio, no respuestas HTTP ni detalles de infraestructura.
Ejemplo concreto (pseudocódigo para GetAllTeatros):

Constructor: recibe un TeatroRepositoryInterface.
Método execute():
Llama al puerto: $teatros = $this->repo->findAll();
Aplica reglas/filtrado/map a DTOs si hace falta.
Retorna el resultado (array de DTOs).
Nunca: no debe hacer echo/json_encode ni acceder a $_SERVER ni al driver de la BD.
Diferencia con otras capas:

Domain: contiene entidades y reglas de negocio puras.
UseCases (Application): orquesta esas entidades para casos concretos de la aplicación.
Infrastructure: implementa los puertos que UseCases llaman (BD, API externas).
Presentation: adapta la entrada/salida (HTTP, CLI) y llama a los UseCases.
Buenas prácticas rápidas:

Un caso de uso = una responsabilidad (Single Responsibility).
No mezclar transporte (HTTP) dentro del use case.
Mantenerlo pequeño y testeable (unit tests que mockean los puertos).
Devolver DTOs simples o colecciones de entidades inmutables.