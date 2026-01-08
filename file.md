# Documentation Technique : Implémentation de l'Upload d'Images

Ce document décrit les étapes techniques nécessaires pour mettre en place l'upload de fichiers (images) dans une application Laravel, basé sur l'implémentation faite pour le modèle `Post`.

## 1. Prérequis Système
Avant de commencer, assurez-vous que le lien symbolique du stockage est créé pour rendre les fichiers publics accessibles.
```bash
php artisan storage:link
```

## 2. Base de Données & Modèle
### Migration
La table doit contenir une colonne pour stocker le chemin du fichier (généralement une string).
```php
// database/migrations/xxxx_create_posts_table.php
$table->string('photo')->nullable();
```

### Modèle
Ajoutez l'attribut `photo` à la propriété `$fillable` pour autoriser l'assignation de masse.
```php
// app/Models/Post.php
protected $fillable = ['message', 'photo'];
```

## 3. Vues (Frontend)
### Formulaire d'Upload
Pour envoyer des fichiers, le formulaire HTML **doit** avoir l'attribut `enctype`.
```html
<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Input fichier (peut être caché et déclenché par JS) -->
    <input type="file" name="photo" accept="image/*">
    
    <button type="submit">Envoyer</button>
</form>
```

### Affichage de l'Image
Utilisez le helper `asset()` en pointant vers le dossier `storage`.
```html
@if ($post->photo)
    <img src="{{ asset('storage/' . $post->photo) }}" alt="Image du post">
@endif
```

## 4. Contrôleur (Backend)
N'oubliez pas d'importer la façade Storage : `use Illuminate\Support\Facades\Storage;`

### Création (Store)
```php
public function store(Request $request)
{
    // 1. Validation
    $data = $request->validate([
        'message' => 'required|string|max:255',
        'photo' => 'nullable|image|max:3000' // Max 3MB
    ]);

    // 2. Traitement de l'upload
    if ($request->hasFile('photo')) {
        // Stocke dans storage/app/public/posts et retourne le chemin relatif
        $data['photo'] = $request->file('photo')->store('posts', 'public');
    }

    // 3. Création en base
    auth()->user()->posts()->create($data);

    return redirect()->back()->with('success', 'Post créé !');
}
```

### Modification (Update)
Lors de la mise à jour, il est bonne pratique de supprimer l'ancienne image si une nouvelle est uploadée.
```php
public function update(Request $request, Post $post)
{
    $data = $request->validate([
        'message' => 'required|string|max:255',
        'photo' => 'nullable|image|max:3000'
    ]);

    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($post->photo) {
            Storage::disk('public')->delete($post->photo);
        }
        // Stocker la nouvelle
        $data['photo'] = $request->file('photo')->store('posts', 'public');
    }

    $post->update($data);

    return redirect()->back()->with('success', 'Post mis à jour !');
}
```

## 5. Authentification avec Contrôleurs Invocables

Une approche propre et modulaire utilisant des **Single Action Controllers**.

### 1. Génération des Contrôleurs
```bash
php artisan make:controller Auth/Register --invokable
php artisan make:controller Auth/Login --invokable
php artisan make:controller Auth/Logout --invokable
```

### 2. Routes (routes/web.php)
L'avantage des contrôleurs invocables est la simplicité de la route : on passe juste le nom de la classe.

```php
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use Illuminate\Support\Facades\Route;

// Affichage des formulaires (si vous utilisez des méthodes séparées ou des vues directes)
Route::view('/register', 'auth.register')->name('register');
Route::view('/login', 'auth.login')->name('login');

// Traitement (POST)
Route::post('/register', Register::class);
Route::post('/login', Login::class);
Route::post('/logout', Logout::class)->name('logout');
```

### 3. Implémentation des Contrôleurs

#### Register (app/Http/Controllers/Auth/Register.php)
```php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
```

#### Login (app/Http/Controllers/Auth/Login.php)
```php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides.',
        ])->onlyInput('email');
    }
}
```

#### Logout (app/Http/Controllers/Auth/Logout.php)
```php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller
{
    public function __invoke(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
```

### Alternative : Laravel Breeze (Starter Kit)

Si vous aviez utilisé **Laravel Breeze**, vous auriez obtenu le même résultat fonctionnel (Login/Register/Logout) automatiquement, mais avec une architecture différente.

### Ce que Breeze fait pour vous :
```bash
composer require laravel/breeze --dev
php artisan breeze:install
```

### Différences avec l'approche "Invocable" manuelle :
1.  **Contrôleurs** : Breeze n'utilise pas de contrôleurs `__invoke`. Il regroupe les actions par "Ressource".
    *   `Login` -> `AuthenticatedSessionController` (méthode `store`)
    *   `Logout` -> `AuthenticatedSessionController` (méthode `destroy`)
    *   `Register` -> `RegisteredUserController` (méthode `store`)
2.  **Routes** : Les routes sont définies dans `routes/auth.php` (qui est inclus dans `web.php`).

Si vous vouliez absolument des contrôleurs invocables **avec** Breeze, il faudrait refactoriser manuellement les contrôleurs générés par Breeze (ex: éclater `AuthenticatedSessionController` en `LoginController` et `LogoutController`).

## 6. Commandes Invocables (Single Action Controllers)

Idéal pour une action unique et spécifique.

### Création
```bash
php artisan make:controller PublishPostController --invokable
```

### Code
```php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PublishPostController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->update(['published_at' => now()]);
        return redirect()->back();
    }
}
```

### Route
```php
use App\Http\Controllers\PublishPostController;

Route::post('/posts/{post}/publish', PublishPostController::class);
```

## 7. Policies (Autorisation)

Pour gérer qui a le droit de faire quoi (ex: modifier un post).

### Création
```bash
php artisan make:policy PostPolicy --model=Post
```

### Code (Policy)
```php
// app/Policies/PostPolicy.php
public function update(User $user, Post $post)
{
    // Seul l'auteur peut modifier
    return $user->id === $post->user_id;
}
```

### Utilisation (Controller)
```php
public function update(Request $request, Post $post)
{
    $this->authorize('update', $post);
    // ... logique de mise à jour
}
```
