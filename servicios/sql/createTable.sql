CREATE TABLE IF NOT EXISTS gh_tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    icono VARCHAR(100) NOT NULL DEFAULT 'fa-solid fa-list-check'
    );

CREATE TABLE IF NOT EXISTS gh_historial (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tarea_id INT NOT NULL,
    fecha DATE NOT NULL,
    FOREIGN KEY (tarea_id) REFERENCES gh_tareas(id) ON DELETE CASCADE,
    UNIQUE(tarea_id, fecha)
    );