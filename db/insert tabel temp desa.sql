INSERT INTO kecamatan(kodekecamatan, namakecamatan, kodekabupaten, tglberdiri)
	SELECT TRIM(`Kode Kecamatan`), TRIM(`Nama Kecamatan`), TRIM(`Kode Kabupaten`), '1950-01-01' FROM tempsambas;

INSERT INTO kelurahan(kodekelurahan, namakelurahan, kodekecamatan)
	SELECT TRIM(`Kode Desa`), TRIM(`Nama Desa`), TRIM(`Kode Kecamatan`) FROM tempkecsambas;

INSERT INTO kelurahan(kodekelurahan, namakelurahan, kodekecamatan)
	SELECT TRIM(`Kode Desa`), TRIM(`Nama Desa`), TRIM(`Kode Kecamatan`) FROM tempkectebas;
		
INSERT INTO kelurahan(kodekelurahan, namakelurahan, kodekecamatan)
	SELECT TRIM(`Kode Desa`), TRIM(`Nama Desa`), TRIM(`Kode Kecamatan`) FROM tempkectelukkeramat;
