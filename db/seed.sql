
-- Remplacer les hash par ceux générés via generate_hash.php
USE campus_helpdesk;

INSERT INTO utilisateurs (nom, email, mdp_hash, role) VALUES
('Etudiant Test', 'student@campus.local', '$2y$10$XrA7INoytJGsteDhPpN6fObg3NxSg7XX1XWxvRh2FZjJg6FJk8Bn6', 'ETUDIANT'),
('Tech Test',     'tech@campus.local',    '$2y$10$cziRZmMGIY6zQ1MmD4bLNOBg33yjQJZbx5vfKsjCUETFXPgtgqqpa',    'TECH'),
('Admin Test',    'admin@campus.local',   '$2y$10$S3oGcJSqiz2snUZ/NU8Au.dTOrc6Oo5TtG5ZKIvlx/pKT04NrFTMS',   'ADMIN');
