# 🎯 Projet : Nevers Événements – CRUD & Inscriptions

## 🔧 Objectifs

- Mettre en œuvre la logique **utilisateur** (inscription, connexion, session, inscription à un événement)
- Appliquer les bonnes pratiques **PHP backend** : `session_start()`, validation `POST`, protection `SQL` et `XSS`
- Implémenter une **jointure simple** (`users` ↔ `inscriptions` ↔ `evenements`)
- Préparer les fondations pour un futur espace **administrateur (CRUD)**

---

## ✅ Acquis et sécurisations apportées

- 🔐 Accès utilisateur sécurisé par session (`$_SESSION['id']`)
- 📬 Inscription : champs obligatoires, `password_hash()`, `FILTER_VALIDATE_EMAIL`, contrôle `genre`
- 🔑 Connexion : requête préparée, vérification du mot de passe, stockage sécurisé des infos session
- ❌ Empêche les inscriptions multiples à un événement
- 🔄 Redirections claires (login, logout, enregistrement)
- 📊 Affichage personnalisé : "Mes événements" avec jointure SQL `JOIN inscriptions ON evenements.id = ...`
- 🧼 Tous les affichages sont protégés par `htmlspecialchars()`
- 🧠 **Approche backend-first** avec une logique claire, modulaire et réutilisable

---

## 🗺️ Challenge SIG (QGIS/PostGIS)

- Transformation dans QGIS d’une **couche de points en trois couches distinctes** : points / lignes / polygones
- Recomposition des couches en **une seule table unifiée** dans PostGIS avec le champ `geometry`
- Import dans la base PostgreSQL via script `init.sql` (types gérés dynamiquement côté JS + Leaflet)

---

## 🔜 Améliorations prévues (après novembre)

- 🗂️ **Filtrage des événements** par mots-clés (requêtes dynamiques côté PHP + indexation BDD)
- 🧠 Ajout d’un **indicateur de sécurité du mot de passe** côté JS (fort/faible)
- 🎨 **Amélioration visuelle CSS** et structuration responsive
- 🛠️ Création d’un **dashboard admin CRUD** (lecture, suppression, édition des événements)
- 🧪 Séparation plus nette frontend/public ↔ backend/admin

---

## 📁 Stack utilisée

- PHP (procédural), PostgreSQL/PostGIS, Leaflet, QGIS
- HTML/CSS, un soupçon de JavaScript vanilla
- Docker (avec `docker-compose`) pour environnement local
