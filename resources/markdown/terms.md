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
    - Els helpers s'utilitzen per generar usuaris i vídeos per defecte.
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

### 4t Sprint:
- **Corregir errors del 3r sprint**:
    - Corregir els errors detectats durant el 3r sprint, especialment si no s'ha comprovat que els usuaris amb permisos puguin accedir a la ruta `/videosmanage`.
- **Crear el controlador `VideosManageController`**:
    - Crear funcions com `testedBy`, `index`, `store`, `show`, `edit`, `update`, `delete` i `destroy` en el controlador.
- **Funció `index` a `VideosController`**:
    - Crear la funció `index` al controlador `VideosController`.
- **Revisió de vídeos creats**:
    - Comprovar que es tinguin 3 vídeos creats a helpers i afegits al `databaseSeeder`.
- **Creació de vistes per al CRUD de vídeos**:
    - Crear vistes per al CRUD que només poden veure els usuaris amb permisos adients: `resources/views/videos/manage/index.blade.php`, `create.blade.php`, `edit.blade.php`, `delete.blade.php`.
    - Afegir taules i formularis a les vistes corresponents, utilitzant l'atribut `data-qa` per facilitar les proves.
- **Funcions de test a `VideoTest`**:
    - Crear funcions per verificar l'accés a les vistes i permisos: `user_without_permissions_can_see_default_videos_page`, `user_with_permissions_can_see_default_videos_page`, `not_logged_users_can_see_default_videos_page`.
- **Rutes i middleware per al CRUD de vídeos**:
    - Crear rutes de CRUD per als vídeos amb el seu middleware corresponent, amb l'index accessible tant per usuaris autenticats com no autenticats.
- **Navbar i footer a `videosapp`**:
    - Afegir un navbar i footer a la plantilla `resources/layouts/videosapp`, permetent la navegació entre pàgines.
- **Afegir documentació al markdown**:
    - Afegir la descripció de les tasques realitzades al 4t sprint a `resources/markdown/terms`.
- **Revisió amb Larastan**:
    - Comprovar tots els fitxers creats amb **Larastan**.

### 5è Sprint:
- **Corregir errors del 4t sprint**:
    - Solucionar els errors detectats al sprint anterior, especialment aquells relacionats amb permisos i rutes d'accés.
- **Afegir el camp `user_id` a la taula de vídeos**:
    - Modificació de la migració de vídeos per afegir el camp `user_id`.
    - Adaptació del model, controladors i helpers perquè en crear un vídeo es guardi automàticament l’usuari que l’ha creat.
    - Comprovació i correcció dels tests anteriors en cas que s’hagin vist afectats pels canvis.
- **Creació del `UsersManageController`**:
    - Implementació de les funcions: `testedBy`, `index`, `store`, `edit`, `update`, `delete`, `destroy` per gestionar usuaris.
- **Millores a `UsersController`**:
    - Afegides les funcions `index` i `show` per llistar i mostrar informació detallada d’un usuari i els seus vídeos.
- **Creació de vistes per al CRUD d’usuaris**:
    - `resources/views/users/manage/index.blade.php`: vista amb la taula del CRUD d’usuaris.
    - `create.blade.php`: formulari per afegir usuaris amb atributs `data-qa` per facilitar les proves.
    - `edit.blade.php`: formulari per editar informació d’usuaris.
    - `delete.blade.php`: confirmació d’eliminació d’un usuari.
- **Vista pública dels usuaris**:
    - `resources/views/users/index.blade.php`: mostra tots els usuaris i permet cercar-los; en clicar un usuari es mostra el seu detall i vídeos associats.
- **Gestió de permisos**:
    - Creació de permisos específics per a la gestió d’usuaris.
    - Assignació d’aquests permisos als usuaris amb rol `superadmin` mitjançant els helpers.
- **Proves a `UserTest`**:
    - Funcions de test per comprovar els permisos i la visualització correcta de les pàgines:
        - `user_without_permissions_can_see_default_users_page`
        - `user_with_permissions_can_see_default_users_page`
        - `not_logged_users_cannot_see_default_users_page`
        - `user_without_permissions_can_see_user_show_page`
        - `user_with_permissions_can_see_user_show_page`
        - `not_logged_users_cannot_see_user_show_page`
- **Proves a `UsersManageControllerTest`**:
    - Implementació de funcions per verificar permisos i funcionalitats del CRUD:
        - `loginAsVideoManager`, `loginAsSuperAdmin`, `loginAsRegularUser`
        - `user_with_permissions_can_see_add_users`
        - `user_without_users_manage_create_cannot_see_add_users`
        - `user_with_permissions_can_store_users`
        - `user_without_permissions_cannot_store_users`
        - `user_with_permissions_can_destroy_users`
        - `user_without_permissions_cannot_destroy_users`
        - `user_with_permissions_can_see_edit_users`
        - `user_without_permissions_cannot_see_edit_users`
        - `user_with_permissions_can_update_users`
        - `user_without_permissions_cannot_update_users`
        - `user_with_permissions_can_manage_users`
        - `regular_users_cannot_manage_users`
        - `guest_users_cannot_manage_users`
        - `superadmins_can_manage_users`
- **Rutes per a la gestió d’usuaris**:
    - Creació de rutes per al CRUD d’usuaris amb middleware de permisos.
    - Les rutes de l’índex i el detall (`index`, `show`) només estan disponibles per a usuaris autenticats.
- **Navegació entre pàgines**:
    - Integració del sistema de navegació entre les diferents seccions de l’aplicació.
- **Documentació**:
    - Afegida la descripció del 5è sprint a `resources/markdown/terms`.
- **Validació amb Larastan**:
    - Comprovació de tots els fitxers nous i modificats per garantir la qualitat i consistència del codi.

## 6è Sprint

- **Corregir els errors del 5è sprint**:
    - Solucionar els errors detectats al 5è sprint.
    - En cas que al modificar el codi falli algun test d’un sprint anterior, s’han d’arreglar.

- **Modificar vídeos per poder assignar-los a les sèries**:
    - Afegir la funcionalitat per associar vídeos amb sèries.

- **Permetre als usuaris regulars crear vídeos**:
    - Afegir les funcions del CRUD de vídeos per als usuaris regulars a `VideoController`.
    - Crear els botons per al CRUD a la vista de vídeos.

- **Crear migració per a les sèries**:
    - Crear la migració de sèries amb els camps següents:
        - `id`, `title`, `description`, `image`, `user_name`, `user_photo_url`, `published_at`.

- **Crear model de sèries**:
    - Crear el model `Serie` amb les funcions següents:
        - `testedBy()`, `videos()`, `getFormattedCreatedAtAttribute()`, `getFormattedForHumansCreatedAtAttribute()`, `getCreatedAtTimestampAttribute()`.

- **Afegir la relació 1:N entre vídeos i sèries**:
    - Modificar el model de vídeos per afegir la relació 1:N amb les sèries.

- **Crear `SeriesManageController`**:
    - Crear les funcions següents:
        - `testedBy()`, `index()`, `store()`, `edit()`, `update()`, `delete()`, `destroy()`.

- **Crear `SeriesController`**:
    - Crear les funcions següents:
        - `index()` i `show()`.

- **Afegir funcions al model de sèries**:
    - Afegir les funcions següents al model `Serie`:
        - `testedBy()`, `videos()`, `getFormattedCreatedAtAttribute()`, `getFormattedForHumansCreatedAtAttribute()`, `getCreatedAtTimestampAttribute()`.

- **Crear la migració de les sèries**:
    - Afegir els camps `id`, `title`, `description`, `image` (nullable), `user_name`, `user_photo_url` (nullable), `published_at` (nullable).

- **Afegir la funció `create_series()` a helpers**:
    - Crear 3 sèries per defecte a través de la funció `create_series()`.

- **Crear vistes per al CRUD de sèries**:
    - Crear les següents vistes per al CRUD de sèries, accessibles només per a usuaris amb els permisos adequats:
        - `resources/views/series/manage/index.blade.php`
        - `resources/views/series/manage/create.blade.php`
        - `resources/views/series/manage/edit.blade.php`
        - `resources/views/series/manage/delete.blade.php`
    - A cada vista s’ha d’utilitzar l'atribut `data-qa` per facilitar la identificació a les proves.

- **Afegir funcionalitat de CRUD a la vista `index.blade.php`**:
    - Afegir la taula del CRUD de sèries.

- **Afegir formulari per crear sèries a `create.blade.php`**:
    - Afegir el formulari per crear noves sèries.

- **Afegir taula de sèries a `edit.blade.php`**:
    - Afegir la taula del CRUD per editar sèries.

- **Afegir confirmació d'eliminació de sèries a `delete.blade.php`**:
    - Afegir una confirmació per eliminar les sèries i els vídeos associats a aquestes. Si no es vol eliminar els vídeos, es pot desassignar la relació.

- **Crear vista pública per a la visualització de sèries**:
    - Crear la vista `resources/views/series/index.blade.php` per mostrar totes les sèries i permetre cercar-les. Quan es fa clic en una sèrie, es mostren els vídeos associats a aquesta.

- **Crear permisos per gestionar sèries**:
    - Crear els permisos per gestionar les sèries i assignar-los als usuaris amb rol `superadmin`.

- **Afegir proves a `SerieTest`**:
    - Crear la funció `serie_have_videos()` per verificar que les sèries tenen vídeos associats.

- **Afegir proves a `SeriesManageControllerTest`**:
    - Crear les següents funcions de test:
        - `loginAsVideoManager`, `loginAsSuperAdmin`, `loginAsRegularUser`
        - `user_with_permissions_can_see_add_series`
        - `user_without_series_manage_create_cannot_see_add_series`
        - `user_with_permissions_can_store_series`
        - `user_without_permissions_cannot_store_series`
        - `user_with_permissions_can_destroy_series`
        - `user_without_permissions_cannot_destroy_series`
        - `user_with_permissions_can_see_edit_series`
        - `user_without_permissions_cannot_see_edit_series`
        - `user_with_permissions_can_update_series`
        - `user_without_permissions_cannot_update_series`
        - `user_with_permissions_can_manage_series`
        - `regular_users_cannot_manage_series`
        - `guest_users_cannot_manage_series`
        - `videomanagers_can_manage_series`
        - `superadmins_can_manage_series`

- **Crear rutes per a la gestió de sèries**:
    - Crear les rutes per al CRUD de sèries i les rutes d'índex i show, protegides amb middleware d'autenticació.

- **Navegació entre pàgines**:
    - Assegurar-se que la navegació entre pàgines funciona correctament.

- **Afegir documentació al markdown**:
    - Afegir la descripció del 6è sprint a `resources/markdown/terms`.

- **Comprovació amb Larastan**:
    - Comprovar tots els fitxers creats amb **Larastan** per garantir la qualitat i consistència del codi.


---

## Eines Utilitzades

- **Laravel**: Framework PHP per al desenvolupament de l'aplicació.
- **Jetstream amb Livewire**: Per a la gestió d'usuaris i la creació de components interactius.
- **PHPUnit**: Per a les proves unitàries i funcionals.
- **Larastan**: Eina d'anàlisi estàtica per detectar errors de codi.
- **Carbon**: Llibreria per manipular dates i hores en Laravel.
- **SQLite**: Base de dades lleugera per al desenvolupament i les proves.
- **spatie/laravel-permission**: Paquet per gestionar permisos d'usuaris.
