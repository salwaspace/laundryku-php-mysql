CREATE DATABASE IF NOT EXISTS sim_laundry CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sim_laundry;
CREATE TABLE IF NOT EXISTS users (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(50) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS laundry (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 kode VARCHAR(20) NOT NULL UNIQUE,
 pelanggan VARCHAR(100) NOT NULL,
 telepon VARCHAR(16) NOT NULL,
 layanan ENUM('Cuci Kering','Cuci Setrika','Setrika Saja') NOT NULL,
 berat DECIMAL(6,1) NOT NULL,
 status ENUM('Proses','Selesai','Diambil') NOT NULL DEFAULT 'Proses',
 harga_per_kg INT UNSIGNED NOT NULL,
 total_harga INT UNSIGNED NOT NULL
) ENGINE=InnoDB;
-- Hash untuk akun demo admin/admin123 (password tidak disimpan sebagai teks biasa).
INSERT INTO users (username,password_hash) VALUES ('admin','$2y$12$ITVOzJ7/QYZgHp.BbDiEGO2zrYW/DwotQMSmYbZLn1m1yz4L9ssfW')
ON DUPLICATE KEY UPDATE username = VALUES(username);
INSERT INTO laundry (kode,pelanggan,telepon,layanan,berat,status,harga_per_kg,total_harga) VALUES
 ('LDY-001','Alya Putri','081234567890','Cuci Kering',2.5,'Proses',6000,15000),
 ('LDY-002','Rafi Pratama','081298765432','Cuci Setrika',3.0,'Selesai',8000,24000),
 ('LDY-003','Nina Sari','081233344455','Setrika Saja',1.5,'Diambil',5000,7500)
ON DUPLICATE KEY UPDATE kode=VALUES(kode);
