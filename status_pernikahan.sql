SELECT *, (CASE WHEN status_keluarga = 'I' THEN CONCAT('Isteri Dari ',(
    SELECT nama FROM master_kependudukan as mk
    INNER JOIN data_pernikahan as mp on mp.nik = mk.nik AND mp.no_akta_nikah = mp.no_akta_nikah
    WHERE mk.nik != dp.nik )) WHEN status_keluarga = 'S' THEN CONCAT('Suami Dari ',(
    SELECT nama FROM master_kependudukan as mk
    INNER JOIN data_pernikahan as mp on mp.nik = mk.nik AND mp.no_akta_nikah = mp.no_akta_nikah
    WHERE mk.nik != dp.nik )) END) AS keterangan
FROM master_kependudukan as mkk
JOIN data_pernikahan as dp on dp.nik = mkk.nik
WHERE dp.no_akta_nikah = dp.no_akta_nikah;