-- Création de la table des utilisateurs
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'professeur', 'etudiant') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Création de la table des cours
CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    professeur_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (professeur_id) REFERENCES users(id)
);

-- Création de la table des inscriptions
CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    etudiant_id INT NOT NULL,
    course_id INT NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (etudiant_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    UNIQUE KEY unique_enrollment (etudiant_id, course_id)
);

-- Création de la table des notes
CREATE TABLE grades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    etudiant_id INT NOT NULL,
    course_id INT NOT NULL,
    note DECIMAL(4,2) NOT NULL,
    commentaire TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (etudiant_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Création de la table des présences
CREATE TABLE attendance (
    id INT PRIMARY KEY AUTO_INCREMENT,
    etudiant_id INT NOT NULL,
    course_id INT NOT NULL,
    date DATE NOT NULL,
    present BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (etudiant_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Insertion d'un administrateur par défaut
INSERT INTO users (nom, prenom, email, password, role) 
VALUES ('Admin', 'System', 'admin@faculty.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'); 