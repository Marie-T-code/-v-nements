CREATE EXTENSION IF NOT EXISTS postgis; 

CREATE TABLE evenements (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY, 
    slug TEXT UNIQUE, 
    openagenda TEXT, 
    titre TEXT, 
    description TEXT, 
    mots_clefs TEXT, 
    image TEXT, 
    im_credits TEXT, 
    dates TEXT, 
    type TEXT, 
    type_geom TEXT NOT NULL, 
    geom geometry(Geometry, 4326) NOT NULL
);

CREATE TABLE users (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY, 
    nom TEXT NOT NULL, 
    prenom TEXT NOT NULL, 
    genre TEXT CHECK(genre IN ('female', 'male', 'other')),
    email TEXT NOT NULL UNIQUE, 
    mot_de_passe TEXT,
    telephone TEXT, 
    -- téléphones toujours en texte, INTEGER suprimme les 0 et enpêche les espaces et les +33 etc.
    is_admin BOOLEAN DEFAULT false
);

CREATE TABLE inscriptions (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    user_id INTEGER REFERENCES users(id),
    evenement_id INTEGER REFERENCES evenements(id), 
    nb_places INTEGER DEFAULT 1, 
    date_inscription DATE DEFAULT CURRENT_DATE 
);