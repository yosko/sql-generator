DROP TABLE IF EXISTS 'Series';
CREATE TABLE Series (
    'id' integer not null primary key autoincrement,
    'title' text
);
INSERT INTO 'Series' ('id','title') VALUES (1, 'Thorgal');
INSERT INTO 'Series' ('id','title') VALUES (2, 'Largo Winch');
INSERT INTO 'Series' ('id','title') VALUES (3, 'Blake & Mortimer');

DROP TABLE IF EXISTS 'Volumes';
CREATE TABLE Volumes (
    'id' integer not null primary key autoincrement,
    'seriesId' integer,
    'volumeNumber' integer,
    'title' text,
    FOREIGN KEY (seriesId) REFERENCES Series (id)
);

DROP TABLE IF EXISTS 'Authors';
CREATE TABLE Authors (
    'id' integer not null primary key autoincrement,
    'firstName' text,
    'lastName' text
);
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (1, 'Jean', 'Van Hamme');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (2, 'Yves', 'Sente');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (3, 'Yann', 'Le Pennetier');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (4, 'Grzegorz', 'Rosiński');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (5, 'Fred', 'Vignaux');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (6, 'Éric', 'Giacometti');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (7, 'Philippe', 'Francq');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (8, 'Edgar P.', 'Jacobs');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (9, 'Jean', 'Dufaux');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (10, 'Ted', 'Benoît');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (11, 'André', 'Juillard');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (12, 'Antoine', 'Aubin');
INSERT INTO 'Authors' ('id', 'firstName', 'lastName') VALUES (13, 'Étienne', 'Schréder');

DROP TABLE IF EXISTS 'VolumesAuthors';
CREATE TABLE VolumesAuthors (
    'volumeId' integer,
    'authorId' integer,
    'role' text,
    PRIMARY KEY (volumeId, authorId, role),
    FOREIGN KEY (volumeId) REFERENCES Volumes (id),
    FOREIGN KEY (authorId) REFERENCES Authors (id)
);

INSERT INTO 'Volumes' ('id', 'seriesId', 'volumeNumber','title') VALUES (1, 1, 29, 'Le Sacrifice');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (1, 1, 'writer');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (1, 4, 'artist');
INSERT INTO 'Volumes' ('id', 'seriesId', 'volumeNumber','title') VALUES (2, 1, 30, 'Moi, Jolan');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (2, 2, 'writer');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (2, 4, 'artist');
INSERT INTO 'Volumes' ('id', 'seriesId', 'volumeNumber','title') VALUES (3, 1, 37, 'L''Ermite de Skellingar');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (3, 3, 'writer');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (3, 5, 'artist');
INSERT INTO 'Volumes' ('id', 'seriesId', 'volumeNumber','title') VALUES (4, 2, 20, 'Vingt secondes');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (4, 1, 'writer');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (4, 7, 'artist');
INSERT INTO 'Volumes' ('id', 'seriesId', 'volumeNumber','title') VALUES (5, 2, 21, 'L''Étoile du matin');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (5, 6, 'writer');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (5, 7, 'artist');
INSERT INTO 'Volumes' ('id', 'seriesId', 'volumeNumber','title') VALUES (6, 3, 1, 'Le Secret de l''Espadon');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (6, 8, 'writer');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (6, 8, 'artist');
INSERT INTO 'Volumes' ('id', 'seriesId', 'volumeNumber','title') VALUES (7, 3, 13, 'L''Affaire Francis Blake');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (7, 1, 'writer');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (7, 10, 'artist');
INSERT INTO 'Volumes' ('id', 'seriesId', 'volumeNumber','title') VALUES (8, 3, 14, 'La Machination Voronov');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (8, 2, 'writer');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (8, 11, 'artist');
INSERT INTO 'Volumes' ('id', 'seriesId', 'volumeNumber','title') VALUES (9, 3, 22, 'L''Onde Septimus');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (9, 9, 'writer');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (9, 12, 'artist');
INSERT INTO 'VolumesAuthors' ('volumeId', 'authorId','role') VALUES (9, 13, 'artist');