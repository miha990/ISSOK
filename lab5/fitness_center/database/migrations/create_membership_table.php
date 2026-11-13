<?php

include __DIR__ . '/../db_connection.php';

$db = connectDatabase();

$query = 'CREATE TABLE IF NOT EXISTS memberships(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        member_name TEXT NOT NULL,
        type TEXT NOT NULL,
        start_date DATE NOT NULL,
        price REAL NOT NULL
    );';

$db->exec($query);
echo "Table created successfully!";