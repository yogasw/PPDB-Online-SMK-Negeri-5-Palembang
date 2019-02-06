ERROR - 2019-02-07 05:19:48 --> SELECT *
FROM `siswa`
WHERE `siswa`.`jurusan` = 'a'
OR  `siswa`.`no_peserta` LIKE '%a%' ESCAPE '!'
OR  `siswa`.`nisn` LIKE '%a%' ESCAPE '!'
OR  `siswa`.`nama_lengkap` LIKE '%a%' ESCAPE '!'
OR  `siswa`.`asal_sekolah` LIKE '%a%' ESCAPE '!'
OR  `siswa`.`jurusan` LIKE '%a%' ESCAPE '!'
ERROR - 2019-02-07 05:19:59 --> SELECT *
FROM `siswa`
LEFT JOIN `nilai_un` ON `siswa`.`nisn`=`nilai_un`.`nisn`
LEFT JOIN `nilai_usbn` ON `siswa`.`nisn`=`nilai_usbn`.`nisn`
WHERE `siswa`.`jurusan` = 'akuntansi'
ORDER BY `siswa`.`nama_lengkap` ASC
LIMIT 10
ERROR - 2019-02-07 05:20:00 --> SELECT *
FROM `siswa`
WHERE `siswa`.`jurusan` = 'A'
OR  `siswa`.`no_peserta` LIKE '%A%' ESCAPE '!'
OR  `siswa`.`nisn` LIKE '%A%' ESCAPE '!'
OR  `siswa`.`nama_lengkap` LIKE '%A%' ESCAPE '!'
OR  `siswa`.`asal_sekolah` LIKE '%A%' ESCAPE '!'
OR  `siswa`.`jurusan` LIKE '%A%' ESCAPE '!'
