# Laravel Project — Ilias Ben Fodda

## Projectbeschrijving en functionaliteiten

Dit project is een dynamische webapplicatie gebouwd met **Laravel 13** en **SQLite**. Het platform biedt een centrale
plek voor nieuws, FAQ, forum en contactmogelijkheden, met een volledig uitgewerkt gebruikers- en adminbeheer.

### Functionaliteiten

#### 🔐 Login & gebruikersbeheer

- Bezoekers kunnen registreren en inloggen (incl. "Remember me" en wachtwoord vergeten)
- Twee rollen: gewone gebruiker en admin
- Admins kunnen andere gebruikers beheren (aanmaken, rol wijzigen, verwijderen)
- Admins kunnen zichzelf niet de-adminnen

#### 👤 Profielpagina

- Elke gebruiker heeft een publieke profielpagina (ook zichtbaar voor niet-ingelogden)
- Profielvelden: naam, e-mail, verjaardag, profielfoto, "over mij" tekst
- Ingelogde gebruikers kunnen hun eigen profiel bewerken
- Profielfoto wordt opgeslagen op de server

#### 📰 Nieuws

- Admins kunnen nieuwsitems aanmaken, bewerken en verwijderen
- Elk nieuwsitem heeft: titel, afbeelding, inhoud en publicatiedatum
- Alle bezoekers kunnen de nieuwslijst en detailpagina bekijken
- Nieuwsitems kunnen gekoppeld worden aan onderwerpen (tags)

#### ❓ FAQ

- FAQ-vragen zijn gegroepeerd per categorie
- Admins kunnen categorieën en vraag/antwoord-paren beheren
- Alle bezoekers kunnen de FAQ bekijken
- Ingelogde gebruikers kunnen FAQ-vragen voorstellen; admins kunnen deze goedkeuren of afwijzen

#### 📬 Contact

- Elk bezoeker kan een contactformulier invullen
- Bij verzenden krijgt de admin een e-mail met de inhoud
- Admins kunnen berichten inzien, als gelezen markeren en verwijderen

#### 💬 Forum

- Ingelogde gebruikers kunnen forumthreads aanmaken
- Threads zijn ingedeeld per onderwerp
- Gebruikers kunnen reageren op threads

#### 📋 Admin dashboard

- Overzicht van contactberichten, gebruikers, nieuws, FAQ en voorgestelde FAQ-vragen

---

## Implementatie van elke technische vereiste

### Views

| Vereiste                                                            | Bestand                                        | Lijnnummer |
|---------------------------------------------------------------------|------------------------------------------------|------------|
| **Twee layouts** — `x-app-layout` (hoofdlayout)                     | `resources/views/dashboard.blade.php`          | L1         |
| **Twee layouts** — `x-guest-layout` (gastlayout)                    | `resources/views/auth/login.blade.php`         | L1         |
| **Component** — `x-text-input`                                      | `resources/views/auth/register.blade.php`      | L8, L16    |
| **Component** — `x-primary-button`                                  | `resources/views/auth/register.blade.php`      | L42        |
| **Component** — `x-input-error`                                     | `resources/views/auth/register.blade.php`      | L10        |
| **Control structure** — `@forelse`                                  | `resources/views/forum/index.blade.php`        | L14        |
| **Control structure** — `@foreach`                                  | `resources/views/faq/index.blade.php`          | ~L25       |
| **Control structure** — `@if`                                       | `resources/views/layouts/navigation.blade.php` | ~L10       |
| **XSS protection** — `{{ }}` auto-escape                            | `resources/views/faq/index.blade.php`          | L27        |
| **CSRF protection** — `@csrf`                                       | `resources/views/contact/index.blade.php`      | L19        |
| **Client-side validatie** — `required`, `minlength`, `type="email"` | `resources/views/contact/index.blade.php`      | L24–L37    |

### Routes

| Vereiste                               | Bestand          | Lijnnummer |
|----------------------------------------|------------------|------------|
| **Controller methods**                 | `routes/web.php` | L22–L29    |
| **Middleware** — `auth` groep          | `routes/web.php` | L34        |
| **Middleware** — `admin` groep         | `routes/web.php` | L51        |
| **Gegroepeerde routes** — forum prefix | `routes/web.php` | L42–L48    |
| **Gegroepeerde routes** — admin prefix | `routes/web.php` | L51–L53    |

### Controllers

| Vereiste                              | Bestand                                         | Lijnnummer |
|---------------------------------------|-------------------------------------------------|------------|
| **Resource controller** — users       | `app/Http/Controllers/Admin/UserController.php` | L11–L70    |
| **Resource controller** — onderwerpen | `app/Http/Controllers/OnderwerpController.php`  | —          |
| **CRUD logica** — nieuws              | `app/Http/Controllers/NieuwsController.php`     | L12–L90    |
| **CRUD logica** — FAQ                 | `app/Http/Controllers/FaqController.php`        | L13–L55    |
| **Admin middleware**                  | `app/Http/Middleware/IsAdmin.php`               | L14–L19    |

### Models & Relaties

| Vereiste                                        | Bestand                    | Lijnnummer |
|-------------------------------------------------|----------------------------|------------|
| **One-to-many** — Category → Faq                | `app/Models/Category.php`  | L17        |
| **One-to-many** — Category → Faq (inverse)      | `app/Models/Faq.php`       | L17        |
| **One-to-many** — User → Threads                | `app/Models/User.php`      | L55        |
| **One-to-many** — Thread → Replies              | `app/Models/Thread.php`    | L20        |
| **Many-to-many** — Nieuws ↔ Onderwerp           | `app/Models/Nieuws.php`    | L24        |
| **Many-to-many** — Nieuws ↔ Onderwerp (inverse) | `app/Models/Onderwerp.php` | L17        |

### Database

| Vereiste                       | Bestand                                                                      |
|--------------------------------|------------------------------------------------------------------------------|
| Migraties                      | `database/migrations/` (14 migratiebestanden)                                |
| Seeders                        | `database/seeders/AdminSeeder.php`, `CategorySeeder.php`, `NieuwsSeeder.php` |
| Default admin (`admin@ehb.be`) | `database/seeders/AdminSeeder.php`                                           |

### Authentication

| Vereiste             | Bestand                                | Lijnnummer |
|----------------------|----------------------------------------|------------|
| Login / Logout       | `routes/auth.php`                      | L16–L22    |
| Registreren          | `routes/auth.php`                      | L14–L15    |
| Remember me          | `resources/views/auth/login.blade.php` | L30–L32    |
| Wachtwoord resetten  | `routes/auth.php`                      | L24–L30    |
| Default admin seeder | `database/seeders/AdminSeeder.php`     | —          |

---

## Installatiehandleiding

### Vereisten

- PHP 8.2+
- Composer
- Node.js & npm

### Stappen

```bash
# 1. Kloon de repository
git clone <repo-url>
cd <project-map>

# 2. Installeer PHP-dependencies
composer install

# 3. Installeer JS-dependencies
npm install

# 4. Maak .env aan en genereer sleutel
cp .env.example .env
php artisan key:generate

# 5. Database aanmaken en seeden
php artisan migrate:fresh --seed

# 6. Opslag koppelen
php artisan storage:link

# 7. Herd server starten

# 8. Frontend bouwen
npm run dev

```

### Standaard admin account

E-mail: admin@ehb.be
Wachtwoord: Password!321

---

## Screenshots

![Homepage](screenshots/Screenshot%20homepage.png)
![Admin dashboard](screenshots/Screenshot%20Admin%20dashboard.png)
![FaqPage](screenshots/Screenshot%20Faq.png)
![Forumpage](screenshots/Screenshot%20Forumpage.png)
![Contactpage](screenshots/Screenshot%20Contactpage.png)
---

## Gebruikte bronnen

- Logi n
    - https://medium.com/@galiherlanggadev/laravel-auth-page-with-breeze-d51db7b117e3
    - https://laraveldaily.com/lesson/laravel-beginners/login-register-breeze
- Migraties
    - https://laraveldaily.com/lesson/laravel-from-scratch/database-migrations
    - https://stackoverflow.com/questions/30220377/how-do-laravel-migrations-work
    - https://laravel.com/docs/13.x/migrations
- Profielfoto
    - https://laravel-news.com/uploading-files-laravel
    - https://medium.com/@rohitdhiman91/file-upload-in-laravel-a-beginner-friendly-guide-73952ed5a34a
- Email
    - https://medium.com/@rohitdhiman91/sending-emails-in-laravel-with-mailtrap-a-beginners-guide-06ab2c69f64c
- AI
    - ChatGPT voor opmaak, seeders, readme, algemene vragen, errors, stukken van implementatie
