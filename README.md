# 📔 ZinZin Journal

Un journal intime moderne et élégant construit avec **Laravel 12**, **Vite**, et **Tailwind CSS 4**.

## 🚀 Fonctionnalités

- 📝 **Gestion des Posts** : Créez, modifiez et gérez vos entrées de journal.
- 🔐 **Authentification** : Système d'inscription, connexion et déconnexion sécurisé.
- 🎨 **Design Premium** : Interface épurée utilisant les dernières technologies CSS.
- 🛡️ **Sécurité** : Utilisation de Policies Laravel pour restreindre l'accès aux données.

## 🛠️ Installation

### Prérequis

- PHP >= 8.2
- Composer
- Node.js & npm
- SQLite (ou autre base de données compatible)

### Étapes d'installation

1. **Cloner le projet**

   ```bash
   git clone <url-du-repo>
   cd "Zinzin io"
   ```

2. **Installer les dépendances PHP**

   ```bash
   composer install
   ```

3. **Installer les dépendances JS**

   ```bash
   npm install
   ```

4. **Configuration de l'environnement**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Base de données**

   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

## 💻 Développement

Lancer le serveur de développement Laravel :

```bash
php artisan serve
```

Lancer la compilation des assets (Vite + Tailwind 4) :

```bash
npm run dev
```

## 📂 Structure Clé

- `app/Http/Controllers/Auth` : Logique d'authentification invokable.
- `app/Models/Post.php` : Modèle principal pour les entrées du journal.
- `resources/views` : Templates Blade utilisant Tailwind CSS.
- `routes/web.php` : Définition des routes web et ressources.

---
*Projet généré par ZinZin Team.*

<!-- {{ strtoupper(substr($aibo->user->name, 0, 1)) }} -->
<!-- <div
            class="h-full w-full bg-cover bg-center bg-slate-200 flex items-center justify-center text-primary font-display text-2xl">
           {{ strtoupper(substr($post->user->name, 0, 1)) }}
        </div> -->
