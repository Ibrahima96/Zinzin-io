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
