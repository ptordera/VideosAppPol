# Descripció del Projecte: **VideosApp**

## Objectiu Principal

L'objectiu principal d'aquest projecte és desenvolupar una aplicació web tipus YouTube o similar, on els usuaris puguin registrar-se, visualitzar vídeos, gestionar llistes de reproducció, pujar contingut, etc. El projecte es realitzarà a través de diversos sprints i té com a objectiu final crear una plataforma de vídeos robusta i funcional.

---

## Funcionalitats Clau

1. **Creació d'Usuaris**:
    - Els usuaris poden registrar-se, iniciar sessió i gestionar els seus comptes.
    - Hi ha usuaris amb rols diferents, com ara usuaris normals i professors.
    - Cada usuari està associat a un equip (team), i es poden gestionar diferents permisos a través d'aquest.

2. **Gestió de Vídeos**:
    - Els usuaris poden pujar vídeos amb títol, descripció, URL i data de publicació.
    - Els vídeos poden estar relacionats amb altres vídeos a través de les propietats `previous` i `next`, per crear una navegació entre els vídeos.
    - Els vídeos tenen atributs relacionats amb la data de publicació, com la data formatejada per a la vista d'usuari, les dates relatives com "fa 2 hores" i el valor Unix timestamp per a ús intern.

3. **Rutes i Vistes**:
    - Les rutes de l'aplicació permeten als usuaris veure vídeos, accedir a detalls de vídeos específics i explorar contingut relacionat.
    - Les vistes utilitzen un sistema de components i layouts per a una estructura modular i fàcil de mantenir.
    - El layout principal s'anomena **VideosAppLayout**, que s'utilitza en totes les pàgines de l'aplicació.

4. **Proves i Validacions**:
    - Es realitzen proves unitàries i funcionals per assegurar-se que les funcionalitats de l'aplicació funcionen correctament.
    - Les proves inclouen la creació de vídeos per defecte, la validació de dates, la creació d'usuaris i la navegació entre vídeos.
    - S'utilitzen eines com **PHPUnit** per a les proves i **Larastan** per analitzar el codi i detectar possibles errors.

---

## Descripció dels Sprints

### 1r Sprint:
- **Creació del projecte**:
    - Creació d'un nou projecte anomenat **VideosApp** amb les opcions Jetstream, Livewire, PHPUnit, Teams i SQLite.
- **Creació de tests**:
    - Creació d'un test de helpers per verificar la creació d'usuaris per defecte i professors per defecte.
- **Creació de helpers**:
    - Els helpers s'utilitzen per generar usuaris i videos per defecte.
- **Configuració de base de dades**:
    - Configuració d'una base de dades SQLite per a les proves, evitant que afecti la base de dades de producció.
- **Mòduls de configuració**:
    - Creació dels fitxers de configuració per als usuaris per defecte i les credencials dels usuaris.

### 2n Sprint:
- **Corregir errors del primer sprint**:
    - Revisió i correcció de qualsevol error detectat durant el primer sprint.
- **Migracions de base de dades**:
    - Creació de la migració de vídeos amb els camps `id`, `title`, `description`, `url`, `published_at`, `previous`, `next`, `series_id`.
- **Controlador de vídeos**:
    - Creació del controlador **VideosController** amb les funcions `testedBy` i `show` per mostrar els detalls dels vídeos.
- **Model de vídeos**:
    - Creació d'un model de vídeos amb les funcions per formatar la data de publicació (`getFormattedPublishedAtAttribute`, `getFormattedForHumansPublishedAtAttribute`, `getPublishedAtTimestampAttribute`).
- **Helper de vídeos**:
    - Creació d'un helper per generar vídeos per defecte.
- **Rutes i vistes**:
    - Creació de rutes per a mostrar vídeos específics.
    - Creació de les vistes per a visualitzar els vídeos.
- **Proves de vídeos**:
    - Creació de tests per comprovar la creació i formatació dels vídeos, així com la capacitat dels usuaris per veure vídeos existents.

### 3r Sprint:
- **Gestió de permisos i rols d'usuari**:
    - Instal·lació del paquet **spatie/laravel-permission** per gestionar permisos d'usuaris.
    - Creació d'una migració per afegir el camp `super_admin` a la taula dels usuaris.
    - Modificació del model d'usuaris per afegir les funcions `testedBy()` i `isSuperAdmin()`.
- **Millores en la gestió d'usuaris per defecte**:
    - Afegir el rol `superadmin` al professor a la funció `create_default_professor` dels helpers.
    - Creació de la funció `add_personal_team()` per separar la creació dels equips dels usuaris.
    - Creació de les funcions `create_regular_user()`, `create_video_manager_user()`, `create_superadmin_user()` per generar usuaris amb rols específics.
- **Autenticació i autorització**:
    - Definició de les polítiques d'autorització i permisos a `App/Providers/AppServiceProvider`.
    - Afegir permisos i rols d'usuaris (`superadmin`, `regular user`, `video manager`) al `DatabaseSeeder`.
- **Publicació i personalització de stubs**:
    - Publicació dels stubs de Laravel per personalitzar la generació de fitxers.
- **Proves i testos automatitzats**:
    - Creació del test `VideosManageControllerTest` a `tests/Feature/Videos`.
    - Implementació de proves per verificar la gestió de vídeos segons permisos d'usuari:
        - `user_with_permissions_can_manage_videos()`
        - `regular_users_cannot_manage_videos()`
        - `guest_users_cannot_manage_videos()`
        - `superadmins_can_manage_videos()`
        - `loginAsVideoManager()`, `loginAsSuperAdmin()`, `loginAsRegularUser()`
    - Creació del test `UserTest` a `tests/Unit` per validar la funció `isSuperAdmin()`.
- **Validacions i depuració amb Larastan**:
    - Comprovació de tots els fitxers nous i modificats amb **Larastan** per assegurar la qualitat del codi.
- **Documentació**:
    - Afegir informació sobre el tercer sprint a `resources/markdown/terms`.

---

## Eines Utilitzades

- **Laravel**: Framework PHP per al desenvolupament de l'aplicació.
- **Jetstream amb Livewire**: Per a la gestió d'usuaris i la creació de components interactius.
- **PHPUnit**: Per a les proves unitàries i funcionals.
- **Larastan**: Eina d'anàlisi estàtica per detectar errors de codi.
- **Carbon**: Llibreria per manipular dates i hores en Laravel.
- **SQLite**: Base de dades lleugera per al desenvolupament i les proves.
- **spatie/laravel-permission**: Paquet per gestionar permisos d'usuaris.

---

## Com executar les proves

Per executar les proves del projecte, utilitza la següent comanda:

```bash
php artisan test
```

