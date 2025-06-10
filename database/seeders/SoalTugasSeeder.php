<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoalTugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Soal Pilihan Ganda
        $soalPilihanGanda = [
            [
                'tugas_id' => 1, // Gantilah dengan ID tugas yang sesuai
                'tipe' => 'pg',
                'pertanyaan' => 'Manakah dari berikut ini yang merupakan kelebihan dari sistem manajemen basis data (DBMS)?',
                'pilihan_a' => 'Membutuhkan ruang penyimpanan yang besar',
                'pilihan_b' => 'Meningkatkan redundansi data',
                'pilihan_c' => 'Memungkinkan akses data secara bersamaan oleh banyak pengguna',
                'pilihan_d' => 'Menyulitkan pemeliharaan data',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Salah satu keunggulan DBMS adalah kemampuannya untuk memungkinkan akses data secara multi-user, sehingga beberapa pengguna dapat mengakses dan memodifikasi data secara bersamaan tanpa mengganggu integritas data.',
            ],
            [
                'tugas_id' => 1,
                'tipe' => 'pg',
                'pertanyaan' => 'Jenis relasi antar tabel yang paling umum dalam basis data relasional adalah:',
                'pilihan_a' => 'One-to-zero',
                'pilihan_b' => 'Zero-to-many',
                'pilihan_c' => 'One-to-many',
                'pilihan_d' => 'Circular',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Relasi one-to-many adalah yang paling umum, contohnya: satu dosen mengajar banyak mata kuliah. Relasi ini memudahkan pengorganisasian data yang saling terhubung.',
            ],
            [
                'tugas_id' => 1,
                'tipe' => 'pg',
                'pertanyaan' => 'Perintah SQL untuk menampilkan semua kolom dari tabel Mahasiswa adalah:',
                'pilihan_a' => 'DISPLAY * FROM Mahasiswa;',
                'pilihan_b' => 'SELECT ALL FROM Mahasiswa;',
                'pilihan_c' => 'SELECT * FROM Mahasiswa;',
                'pilihan_d' => 'SHOW ALL FROM Mahasiswa;',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Sintaks SELECT * FROM nama_tabel digunakan untuk menampilkan semua kolom dari suatu tabel dalam SQL. Karakter * mewakili seluruh kolom.',
            ],
            [
                'tugas_id' => 1,
                'tipe' => 'pg',
                'pertanyaan' => 'Dalam model data relasional, primary key digunakan untuk:',
                'pilihan_a' => 'Menyimpan gambar dan file besar',
                'pilihan_b' => 'Menghubungkan database dengan jaringan',
                'pilihan_c' => 'Menyusun laporan data secara otomatis',
                'pilihan_d' => 'Mengidentifikasi secara unik setiap baris dalam tabel',
                'jawaban_benar' => 'D',
                'alasan_jawaban' => 'Primary key adalah atribut atau kombinasi atribut yang mengidentifikasi secara unik setiap baris (record) dalam tabel. Tidak boleh ada duplikasi dan tidak boleh bernilai NULL.',
            ],
            [
                'tugas_id' => 1,
                'tipe' => 'pg',
                'pertanyaan' => 'Normalisasi dalam basis data bertujuan untuk:',
                'pilihan_a' => 'Meningkatkan jumlah tabel',
                'pilihan_b' => 'Menghapus data yang tidak terpakai',
                'pilihan_c' => 'Mengurangi redundansi dan meningkatkan integritas data',
                'pilihan_d' => 'Mengubah tipe data',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Normalisasi adalah proses untuk menyusun data agar tidak terjadi pengulangan (redundansi) dan untuk menjaga konsistensi dan integritas data. Ini dilakukan dengan membagi data menjadi beberapa tabel dan menghubungkannya dengan kunci.',
            ],

        ];

        // Soal Essay
        $soalEssay = [
            [
                'tugas_id' => 1, // Gantilah dengan ID tugas yang sesuai
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan perbedaan antara DBMS dan RDBMS serta berikan contohnya!',
                'jawaban_benar' => 'DBMS (Database Management System) mengelola data tanpa struktur relasional (contoh: XML database). RDBMS (Relational DBMS) menyimpan data dalam bentuk tabel yang saling berelasi (contoh: MySQL, PostgreSQL).',
                'alasan_jawaban' => 'DBMS (Database Management System) mengelola data tanpa struktur relasional (contoh: XML database). RDBMS (Relational DBMS) menyimpan data dalam bentuk tabel yang saling berelasi (contoh: MySQL, PostgreSQL).',
            ],
            [
                'tugas_id' => 1,
                'tipe' => 'essay',
                'pertanyaan' => 'Apa itu normalisasi dan mengapa penting dalam perancangan basis data?',
                'jawaban_benar' => 'Normalisasi adalah proses pengorganisasian data untuk mengurangi duplikasi dan inkonsistensi. Penting untuk memastikan efisiensi penyimpanan dan integritas data.',
                'alasan_jawaban' => 'Normalisasi adalah proses pengorganisasian data untuk mengurangi duplikasi dan inkonsistensi. Penting untuk memastikan efisiensi penyimpanan dan integritas data.',
            ],
            [
                'tugas_id' => 1,
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan perbedaan antara PRIMARY KEY dan FOREIGN KEY dalam basis data!',
                'jawaban_benar' => 'PRIMARY KEY: atribut yang secara unik mengidentifikasi tiap baris dalam tabel. FOREIGN KEY: atribut yang mengacu pada PRIMARY KEY di tabel lain untuk membentuk relasi antar tabel.',
                'alasan_jawaban' => 'PRIMARY KEY: atribut yang secara unik mengidentifikasi tiap baris dalam tabel. FOREIGN KEY: atribut yang mengacu pada PRIMARY KEY di tabel lain untuk membentuk relasi antar tabel.',
            ],
            [
                'tugas_id' => 1,
                'tipe' => 'essay',
                'pertanyaan' => 'Sebutkan dan jelaskan tiga jenis perintah utama dalam SQL!',
                'jawaban_benar' => 'DDL (Data Definition Language): untuk mendefinisikan struktur (contoh: CREATE, ALTER). DML (Data Manipulation Language): untuk manipulasi data (contoh: INSERT, UPDATE, DELETE). DCL (Data Control Language): untuk kontrol hak akses (contoh: GRANT, REVOKE).',
                'alasan_jawaban' => 'DDL (Data Definition Language): untuk mendefinisikan struktur (contoh: CREATE, ALTER). DML (Data Manipulation Language): untuk manipulasi data (contoh: INSERT, UPDATE, DELETE). DCL (Data Control Language): untuk kontrol hak akses (contoh: GRANT, REVOKE).',
            ],
            [
                'tugas_id' => 1,
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan langkah-langkah umum dalam merancang basis data relasional!',
                'jawaban_benar' => '1. Menentukan kebutuhan data (analisis kebutuhan). 2. Membuat diagram ERD (Entity Relationship Diagram). 3. Mengonversi ERD ke model relasional. 4. Menentukan kunci primer dan relasi antar tabel. 5. Melakukan normalisasi. 6. Mengimplementasikan ke dalam DBMS.',
                'alasan_jawaban' => '1. Menentukan kebutuhan data (analisis kebutuhan). 2. Membuat diagram ERD (Entity Relationship Diagram). 3. Mengonversi ERD ke model relasional. 4. Menentukan kunci primer dan relasi antar tabel. 5. Melakukan normalisasi. 6. Mengimplementasikan ke dalam DBMS.',
                // ID 2
            ],

        ];

        // Insert soal pilihan ganda
        foreach ($soalPilihanGanda as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }

        // Insert soal essay
        foreach ($soalEssay as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }

        // ID 2

        // Soal Pilihan Ganda
        $soalPilihanGanda = [
            [
                'tugas_id' => 2, // tugas_id 2 untuk tugas ini
                'tipe' => 'pg',
                'pertanyaan' => 'Apa keuntungan menggunakan sistem bilangan biner dalam sistem digital?',
                'pilihan_a' => 'Hanya menggunakan angka 0 dan 1',
                'pilihan_b' => 'Efisien untuk manusia membaca',
                'pilihan_c' => 'Lebih sulit untuk diproses komputer',
                'pilihan_d' => 'Tidak dapat digunakan dalam logika digital',
                'jawaban_benar' => 'A',
                'alasan_jawaban' => 'Sistem biner hanya menggunakan dua angka, 0 dan 1, yang mudah direpresentasikan dalam logika digital (on/off).',
            ],
            [
                'tugas_id' => 2,
                'tipe' => 'pg',
                'pertanyaan' => 'Gerbang logika dasar apa saja yang digunakan dalam sistem digital?',
                'pilihan_a' => 'XOR, NAND, NOR',
                'pilihan_b' => 'AND, OR, NOT',
                'pilihan_c' => 'NOR, XNOR, AND',
                'pilihan_d' => 'NAND, XOR, OR',
                'jawaban_benar' => 'B',
                'alasan_jawaban' => 'Gerbang dasar yang paling umum adalah AND, OR, dan NOT, karena gerbang ini dapat digabung untuk membentuk fungsi logika yang kompleks.',
            ],
            [
                'tugas_id' => 2,
                'tipe' => 'pg',
                'pertanyaan' => 'Apa fungsi utama dari flip-flop SR dalam sistem digital?',
                'pilihan_a' => 'Menjumlahkan dua bilangan',
                'pilihan_b' => 'Menyimpan satu bit data',
                'pilihan_c' => 'Mengubah sinyal analog ke digital',
                'pilihan_d' => 'Meningkatkan kecepatan clock',
                'jawaban_benar' => 'B',
                'alasan_jawaban' => 'Flip-flop SR berfungsi sebagai penyimpan bit tunggal yang dapat mempertahankan status sampai diberi sinyal reset atau set.',
            ],
            [
                'tugas_id' => 2,
                'tipe' => 'pg',
                'pertanyaan' => 'Bagaimana cara mengonversi angka desimal 45 ke bilangan biner?',
                'pilihan_a' => 'Menggunakan metode pembagian berturut-turut dengan 2',
                'pilihan_b' => 'Menjumlahkan angka desimal langsung',
                'pilihan_c' => 'Mengalikan angka dengan 2',
                'pilihan_d' => 'Menggunakan logaritma basis 10',
                'jawaban_benar' => 'A',
                'alasan_jawaban' => 'Konversi desimal ke biner biasanya dilakukan dengan metode pembagian berulang dengan angka 2, menyimpan sisa hasil bagi.',
            ],
            [
                'tugas_id' => 2,
                'tipe' => 'pg',
                'pertanyaan' => 'Apa perbedaan utama antara rangkaian kombinasi dan rangkaian sekuensial?',
                'pilihan_a' => 'Kombinasi menggunakan flip-flop, sekuensial tidak',
                'pilihan_b' => 'Kombinasi tidak memiliki memori, sekuensial memiliki memori',
                'pilihan_c' => 'Sekuenial tidak dapat menyimpan data',
                'pilihan_d' => 'Kombinasi menggunakan clock, sekuensial tidak',
                'jawaban_benar' => 'B',
                'alasan_jawaban' => 'Rangkaian kombinasi hanya output berdasarkan input saat itu, sementara rangkaian sekuensial output-nya juga bergantung pada keadaan (memori) sebelumnya.',
            ],
        ];

        // Soal Essay
        $soalEssay = [
            [
                'tugas_id' => 2, // tugas_id 2
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan mengapa sistem bilangan biner sangat cocok digunakan dalam teknologi digital!',
                'jawaban_benar' => 'Sistem biner hanya menggunakan dua angka, 0 dan 1, yang sesuai dengan kondisi listrik (off/on) dalam sirkuit digital. Ini membuat sistem digital lebih sederhana dan tahan terhadap noise dibandingkan sistem bilangan lainnya.',
                'alasan_jawaban' => 'Sistem biner hanya menggunakan dua angka, 0 dan 1, yang sesuai dengan kondisi listrik (off/on) dalam sirkuit digital. Ini membuat sistem digital lebih sederhana dan tahan terhadap noise dibandingkan sistem bilangan lainnya.',
            ],
            [
                'tugas_id' => 2,
                'tipe' => 'essay',
                'pertanyaan' => 'Sebutkan dan jelaskan tiga jenis gerbang logika dasar dalam sistem digital!',
                'jawaban_benar' => 'AND: Output 1 hanya jika semua input 1. OR: Output 1 jika salah satu input 1. NOT: Membalikkan input, jika input 1 output 0, dan sebaliknya.',
                'alasan_jawaban' => 'AND: Output 1 hanya jika semua input 1. OR: Output 1 jika salah satu input 1. NOT: Membalikkan input, jika input 1 output 0, dan sebaliknya.',
            ],
            [
                'tugas_id' => 2,
                'tipe' => 'essay',
                'pertanyaan' => 'Apa fungsi utama dari flip-flop dalam rangkaian digital? Jelaskan!',
                'jawaban_benar' => 'Flip-flop digunakan untuk menyimpan satu bit data dalam sistem digital. Flip-flop dapat mempertahankan keadaan output sampai diberikan sinyal kontrol yang mengubahnya.',
                'alasan_jawaban' => 'Flip-flop digunakan untuk menyimpan satu bit data dalam sistem digital. Flip-flop dapat mempertahankan keadaan output sampai diberikan sinyal kontrol yang mengubahnya.',
            ],
            [
                'tugas_id' => 2,
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan langkah-langkah mengubah bilangan desimal ke biner menggunakan metode pembagian!',
                'jawaban_benar' => 'Bagi angka desimal dengan 2. Catat sisa bagi (0 atau 1). Gunakan hasil bagi untuk pembagian berikutnya. Ulangi sampai hasil bagi 0. Baca sisa hasil bagi dari bawah ke atas sebagai hasil biner.',
                'alasan_jawaban' => 'Bagi angka desimal dengan 2. Catat sisa bagi (0 atau 1). Gunakan hasil bagi untuk pembagian berikutnya. Ulangi sampai hasil bagi 0. Baca sisa hasil bagi dari bawah ke atas sebagai hasil biner.',
            ],
            [
                'tugas_id' => 2,
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan perbedaan antara rangkaian kombinasi dan sekuensial serta contohnya!',
                'jawaban_benar' => 'Rangkaian kombinasi menghasilkan output hanya berdasarkan input saat itu tanpa memori, contoh: gerbang logika, adder. Rangkaian sekuensial memiliki memori dan outputnya tergantung input saat ini dan keadaan sebelumnya, contoh: flip-flop, counter.',
                'alasan_jawaban' => 'Rangkaian kombinasi menghasilkan output hanya berdasarkan input saat itu tanpa memori, contoh: gerbang logika, adder. Rangkaian sekuensial memiliki memori dan outputnya tergantung input saat ini dan keadaan sebelumnya, contoh: flip-flop, counter.',
            ],
        ];

        // Insert soal pilihan ganda
        foreach ($soalPilihanGanda as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }

        // Insert soal essay
        foreach ($soalEssay as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }


        // ID 3

        // Soal Pilihan Ganda
        $soalPilihanGanda = [
            [
                'tugas_id' => 3, // tugas_id 3
                'tipe' => 'pg',
                'pertanyaan' => 'Apa fungsi utama dari protokol dalam komunikasi data?',
                'pilihan_a' => 'Mempercepat pengiriman data',
                'pilihan_b' => 'Mengurangi ukuran data',
                'pilihan_c' => 'Mengatur aturan komunikasi antar perangkat',
                'pilihan_d' => 'Menyimpan data pengguna',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Protokol adalah seperangkat aturan yang mengatur cara komunikasi antar perangkat dalam jaringan agar proses pertukaran data berjalan dengan benar.',
            ],
            [
                'tugas_id' => 3,
                'tipe' => 'pg',
                'pertanyaan' => 'Media transmisi yang menggunakan sinyal cahaya untuk mentransfer data adalah:',
                'pilihan_a' => 'Kabel koaksial',
                'pilihan_b' => 'Kabel UTP',
                'pilihan_c' => 'Serat optik',
                'pilihan_d' => 'Gelombang mikro',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Serat optik menggunakan cahaya (laser/LED) sebagai media transmisi sehingga memiliki kecepatan tinggi dan ketahanan terhadap gangguan elektromagnetik.',
            ],
            [
                'tugas_id' => 3,
                'tipe' => 'pg',
                'pertanyaan' => 'Apa yang dimaksud dengan \'bit rate\' dalam komunikasi data?',
                'pilihan_a' => 'Jumlah pengguna dalam jaringan',
                'pilihan_b' => 'Panjang kabel transmisi',
                'pilihan_c' => 'Jumlah bit yang dikirim per satuan waktu',
                'pilihan_d' => 'Ukuran file yang dikirim',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Bit rate adalah jumlah bit data yang dikirim per detik, biasanya dinyatakan dalam bit per second (bps).',
            ],
            [
                'tugas_id' => 3,
                'tipe' => 'pg',
                'pertanyaan' => 'Dalam model OSI, lapisan yang bertanggung jawab untuk menjamin pengiriman data tanpa kesalahan adalah:',
                'pilihan_a' => 'Network',
                'pilihan_b' => 'Session',
                'pilihan_c' => 'Transport',
                'pilihan_d' => 'Data Link',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Lapisan Transport pada model OSI bertanggung jawab atas keandalan pengiriman data, termasuk koreksi kesalahan dan pengurutan ulang paket.',
            ],
            [
                'tugas_id' => 3,
                'tipe' => 'pg',
                'pertanyaan' => 'Apa perbedaan utama antara komunikasi sinkron dan asinkron?',
                'pilihan_a' => 'Sinkron lebih cepat dari asinkron',
                'pilihan_b' => 'Sinkron menggunakan sinyal listrik, asinkron tidak',
                'pilihan_c' => 'Sinkron mengirimkan data terus-menerus, asinkron mengirimkan data secara tidak tetap',
                'pilihan_d' => 'Sinkron hanya digunakan dalam internet',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Komunikasi sinkron mengirim data secara terus-menerus dengan sinkronisasi clock, sedangkan asinkron mengirimkan data secara tidak tetap menggunakan start dan stop bit.',
            ],
        ];

        // Soal Essay
        $soalEssay = [
            [
                'tugas_id' => 3, // tugas_id 3
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan perbedaan antara komunikasi serial dan paralel dalam transmisi data!',
                'jawaban_benar' => 'Komunikasi serial mengirimkan bit satu per satu, paralel mengirim beberapa bit secara bersamaan.',
                'alasan_jawaban' => 'Komunikasi serial mengirimkan bit satu per satu, paralel mengirim beberapa bit secara bersamaan.',
            ],
            [
                'tugas_id' => 3,
                'tipe' => 'essay',
                'pertanyaan' => 'Apa fungsi utama dari lapisan Network dalam model OSI?',
                'jawaban_benar' => 'Pengalamatan logis dan routing data antar jaringan.',
                'alasan_jawaban' => 'Pengalamatan logis dan routing data antar jaringan.',
            ],
            [
                'tugas_id' => 3,
                'tipe' => 'essay',
                'pertanyaan' => 'Sebutkan dan jelaskan dua jenis protokol komunikasi yang umum digunakan dalam jaringan komputer!',
                'jawaban_benar' => 'TCP (koneksi, andal) dan UDP (tanpa koneksi, cepat).',
                'alasan_jawaban' => 'TCP (koneksi, andal) dan UDP (tanpa koneksi, cepat).',
            ],
            [
                'tugas_id' => 3,
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan konsep bandwidth dan throughput dalam komunikasi data!',
                'jawaban_benar' => 'Bandwidth: kapasitas maksimal untuk mengirim data. Throughput: kecepatan aktual pengiriman data.',
                'alasan_jawaban' => 'Bandwidth: kapasitas maksimal untuk mengirim data. Throughput: kecepatan aktual pengiriman data.',
            ],
            [
                'tugas_id' => 3,
                'tipe' => 'essay',
                'pertanyaan' => 'Apa peran sinyal dalam komunikasi data dan bedakan antara sinyal analog dan digital!',
                'jawaban_benar' => 'Sinyal mewakili data. Analog: kontinyu, digital: diskrit.',
                'alasan_jawaban' => 'Sinyal mewakili data. Analog: kontinyu, digital: diskrit.',
            ],
        ];

        // Insert soal pilihan ganda
        foreach ($soalPilihanGanda as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }

        // Insert soal essay
        foreach ($soalEssay as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }

        // ID 4
        // Soal Pilihan Ganda
        $soalPilihanGanda = [
            [
                'tugas_id' => 4, // tugas_id 4
                'tipe' => 'pg',
                'pertanyaan' => 'Apa itu enkapsulasi dalam pemrograman berorientasi objek?',
                'pilihan_a' => 'Proses menyalin objek',
                'pilihan_b' => 'Menyembunyikan data dan hanya memperbolehkan akses melalui method tertentu',
                'pilihan_c' => 'Menghubungkan beberapa class menjadi satu',
                'pilihan_d' => 'Menyusun ulang method dalam class',
                'jawaban_benar' => 'B',
                'alasan_jawaban' => 'Enkapsulasi menyembunyikan implementasi internal suatu objek dan hanya mengekspos antarmuka publik.',
            ],
            [
                'tugas_id' => 4,
                'tipe' => 'pg',
                'pertanyaan' => 'Apa yang dimaksud dengan pewarisan (inheritance) dalam OOP?',
                'pilihan_a' => 'Proses menyimpan data ke file',
                'pilihan_b' => 'Menerapkan enkapsulasi pada class',
                'pilihan_c' => 'Pembuatan objek baru dari class yang sama',
                'pilihan_d' => 'Class anak mewarisi properti dan method dari class induk',
                'jawaban_benar' => 'D',
                'alasan_jawaban' => 'Inheritance memungkinkan reuse kode dengan mewariskan atribut dan method dari class induk ke class anak.',
            ],
            [
                'tugas_id' => 4,
                'tipe' => 'pg',
                'pertanyaan' => 'Manakah pernyataan yang benar mengenai polymorphism?',
                'pilihan_a' => 'Polymorphism tidak dapat digunakan dalam interface',
                'pilihan_b' => 'Polymorphism hanya berlaku di Python',
                'pilihan_c' => 'Objek dapat memiliki banyak bentuk atau perilaku',
                'pilihan_d' => 'Hanya method yang bisa diwariskan',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Polymorphism memungkinkan method yang sama memiliki implementasi berbeda di class berbeda.',
            ],
            [
                'tugas_id' => 4,
                'tipe' => 'pg',
                'pertanyaan' => 'Apa tujuan dari constructor dalam sebuah class?',
                'pilihan_a' => 'Menghapus objek',
                'pilihan_b' => 'Menampilkan data',
                'pilihan_c' => 'Menginisialisasi objek saat dibuat',
                'pilihan_d' => 'Menyimpan method',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Constructor adalah method khusus yang otomatis dipanggil saat objek dibuat, untuk inisialisasi.',
            ],
            [
                'tugas_id' => 4,
                'tipe' => 'pg',
                'pertanyaan' => 'Konsep OOP yang memungkinkan penggunaan method yang sama dengan implementasi berbeda disebut?',
                'pilihan_a' => 'Abstraksi',
                'pilihan_b' => 'Overriding',
                'pilihan_c' => 'Overloading',
                'pilihan_d' => 'Polymorphism',
                'jawaban_benar' => 'D',
                'alasan_jawaban' => 'Polymorphism adalah konsep di mana satu interface dapat memiliki banyak implementasi berbeda.',
            ],
        ];

        // Soal Essay
        $soalEssay = [
            [
                'tugas_id' => 4, // tugas_id 4
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan konsep enkapsulasi dan bagaimana penerapannya dalam Python!',
                'jawaban_benar' => 'Enkapsulasi menyembunyikan data dengan menjadikannya private dan hanya diakses lewat method (getter/setter). Di Python, menggunakan _ atau __ di nama atribut.',
                'alasan_jawaban' => 'Enkapsulasi menyembunyikan data dengan menjadikannya private dan hanya diakses lewat method (getter/setter). Di Python, menggunakan _ atau __ di nama atribut.',
            ],
            [
                'tugas_id' => 4,
                'tipe' => 'essay',
                'pertanyaan' => 'Apa kelebihan utama penggunaan inheritance dalam OOP?',
                'jawaban_benar' => 'Pewarisan memungkinkan reuse kode dan memperjelas hierarki class.',
                'alasan_jawaban' => 'Pewarisan memungkinkan reuse kode dan memperjelas hierarki class.',
            ],
            [
                'tugas_id' => 4,
                'tipe' => 'essay',
                'pertanyaan' => 'Berikan contoh polymorphism dalam Python!',
                'jawaban_benar' => 'dua class dengan method yang sama namun implementasi berbeda. Bisa digunakan bersama di loop yang sama.',
                'alasan_jawaban' => 'dua class dengan method yang sama namun implementasi berbeda. Bisa digunakan bersama di loop yang sama.',
            ],
            [
                'tugas_id' => 4,
                'tipe' => 'essay',
                'pertanyaan' => 'Apa fungsi utama constructor dalam OOP dan bagaimana cara membuatnya di Python?',
                'jawaban_benar' => 'Constructor digunakan untuk inisialisasi objek. Di Python dibuat dengan def __init__().',
                'alasan_jawaban' => 'Constructor digunakan untuk inisialisasi objek. Di Python dibuat dengan def __init__().',
            ],
            [
                'tugas_id' => 4,
                'tipe' => 'essay',
                'pertanyaan' => 'Apa itu method overriding? Berikan contoh penggunaannya!',
                'jawaban_benar' => 'Overriding adalah mendefinisikan ulang method di subclass yang sudah ada di superclass. Contoh: method display() yang berbeda antara superclass dan subclass.',
                'alasan_jawaban' => 'Overriding adalah mendefinisikan ulang method di subclass yang sudah ada di superclass. Contoh: method display() yang berbeda antara superclass dan subclass.',
            ],
        ];

        // Insert soal pilihan ganda
        foreach ($soalPilihanGanda as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }

        // Insert soal essay
        foreach ($soalEssay as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }

        // ID 5

        // Soal Pilihan Ganda
        $soalPilihanGanda = [
            [
                'tugas_id' => 5, // tugas_id 5
                'tipe' => 'pg',
                'pertanyaan' => 'Apa fungsi utama dari protokol TCP dalam jaringan komputer?',
                'pilihan_a' => 'Mengatur alamat IP',
                'pilihan_b' => 'Menyediakan layanan pengiriman data tanpa koneksi',
                'pilihan_c' => 'Menjamin pengiriman data secara andal dan berurutan',
                'pilihan_d' => 'Mengatur perangkat keras jaringan',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'TCP menjamin pengiriman data secara andal, berurutan, dan bebas duplikasi.',
            ],
            [
                'tugas_id' => 5,
                'tipe' => 'pg',
                'pertanyaan' => 'Perangkat jaringan mana yang berfungsi untuk menghubungkan dua jaringan yang berbeda?',
                'pilihan_a' => 'Switch',
                'pilihan_b' => 'Hub',
                'pilihan_c' => 'Repeater',
                'pilihan_d' => 'Router',
                'jawaban_benar' => 'D',
                'alasan_jawaban' => 'Router menghubungkan dua atau lebih jaringan berbeda dan meneruskan data antar jaringan.',
            ],
            [
                'tugas_id' => 5,
                'tipe' => 'pg',
                'pertanyaan' => 'Alamat IP versi 4 terdiri dari berapa bit?',
                'pilihan_a' => '16 bit',
                'pilihan_b' => '32 bit',
                'pilihan_c' => '64 bit',
                'pilihan_d' => '128 bit',
                'jawaban_benar' => 'B',
                'alasan_jawaban' => 'IPv4 menggunakan alamat 32-bit dalam format desimal bertitik.',
            ],
            [
                'tugas_id' => 5,
                'tipe' => 'pg',
                'pertanyaan' => 'Apa fungsi dari protokol DNS dalam jaringan?',
                'pilihan_a' => 'Menyimpan file secara online',
                'pilihan_b' => 'Menerjemahkan nama domain ke alamat IP',
                'pilihan_c' => 'Mengamankan jaringan dari ancaman luar',
                'pilihan_d' => 'Mengatur koneksi Wi-Fi',
                'jawaban_benar' => 'B',
                'alasan_jawaban' => 'DNS mengubah nama domain seperti google.com menjadi alamat IP.',
            ],
            [
                'tugas_id' => 5,
                'tipe' => 'pg',
                'pertanyaan' => 'Lapisan mana dalam model OSI yang bertanggung jawab terhadap routing dan pengalamatan logis?',
                'pilihan_a' => 'Fisik',
                'pilihan_b' => 'Data Link',
                'pilihan_c' => 'Jaringan (Network)',
                'pilihan_d' => 'Transport',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Lapisan Network bertugas untuk pengalamatan logis (IP) dan menentukan rute terbaik.',
            ],
        ];

        // Soal Essay
        $soalEssay = [
            [
                'tugas_id' => 5, // tugas_id 5
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan perbedaan antara protokol TCP dan UDP!',
                'jawaban_benar' => 'TCP koneksi-oriented dan andal, UDP connectionless dan cepat tanpa jaminan pengiriman.',
                'alasan_jawaban' => 'TCP koneksi-oriented dan andal, UDP connectionless dan cepat tanpa jaminan pengiriman.',
            ],
            [
                'tugas_id' => 5,
                'tipe' => 'essay',
                'pertanyaan' => 'Apa yang dimaksud dengan subnetting dan apa manfaatnya?',
                'jawaban_benar' => 'Subnetting membagi jaringan besar menjadi kecil, meningkatkan efisiensi dan keamanan.',
                'alasan_jawaban' => 'Subnetting membagi jaringan besar menjadi kecil, meningkatkan efisiensi dan keamanan.',
            ],
            [
                'tugas_id' => 5,
                'tipe' => 'essay',
                'pertanyaan' => 'Bagaimana cara kerja proses routing pada jaringan komputer?',
                'jawaban_benar' => 'Routing menentukan jalur terbaik data menggunakan tabel routing dan algoritma seperti RIP atau OSPF.',
                'alasan_jawaban' => 'Routing menentukan jalur terbaik data menggunakan tabel routing dan algoritma seperti RIP atau OSPF.',
            ],
            [
                'tugas_id' => 5,
                'tipe' => 'essay',
                'pertanyaan' => 'Apa itu firewall dan bagaimana peranannya dalam jaringan?',
                'jawaban_benar' => 'Firewall menyaring lalu lintas berdasarkan aturan keamanan, mencegah akses tidak sah.',
                'alasan_jawaban' => 'Firewall menyaring lalu lintas berdasarkan aturan keamanan, mencegah akses tidak sah.',
            ],
            [
                'tugas_id' => 5,
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan proses komunikasi data dua arah menggunakan model OSI!',
                'jawaban_benar' => 'Data melewati 7 lapisan OSI dari sumber ke tujuan dan sebaliknya, memungkinkan komunikasi dua arah.',
                'alasan_jawaban' => 'Data melewati 7 lapisan OSI dari sumber ke tujuan dan sebaliknya, memungkinkan komunikasi dua arah.',
            ],
        ];

        // Insert soal pilihan ganda
        foreach ($soalPilihanGanda as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }

        // Insert soal essay
        foreach ($soalEssay as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }

        //ID 6
        // Soal Pilihan Ganda
        $soalPilihanGanda = [
            [
                'tugas_id' => 6, // tugas_id 6
                'tipe' => 'pg',
                'pertanyaan' => 'Apa tujuan utama dari kecerdasan buatan?',
                'pilihan_a' => 'Menggantikan semua pekerjaan manusia',
                'pilihan_b' => 'Membuat mesin yang dapat bekerja tanpa listrik',
                'pilihan_c' => 'Membuat mesin yang dapat meniru dan menyelesaikan tugas seperti manusia',
                'pilihan_d' => 'Menciptakan robot humanoid',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Kecerdasan buatan bertujuan menciptakan sistem yang dapat menyelesaikan tugas seperti manusia secara otomatis.',
            ],
            [
                'tugas_id' => 6,
                'tipe' => 'pg',
                'pertanyaan' => 'Algoritma mana yang digunakan dalam supervised learning?',
                'pilihan_a' => 'K-Means',
                'pilihan_b' => 'DBSCAN',
                'pilihan_c' => 'Decision Tree',
                'pilihan_d' => 'Apriori',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Decision Tree merupakan algoritma supervised learning karena menggunakan data berlabel.',
            ],
            [
                'tugas_id' => 6,
                'tipe' => 'pg',
                'pertanyaan' => 'Metode mana yang termasuk dalam unsupervised learning?',
                'pilihan_a' => 'KNN',
                'pilihan_b' => 'Naive Bayes',
                'pilihan_c' => 'Logistic Regression',
                'pilihan_d' => 'K-Means',
                'jawaban_benar' => 'D',
                'alasan_jawaban' => 'K-Means merupakan metode clustering tanpa label.',
            ],
            [
                'tugas_id' => 6,
                'tipe' => 'pg',
                'pertanyaan' => 'Komponen utama dalam sistem pakar adalah?',
                'pilihan_a' => 'Sensor',
                'pilihan_b' => 'Aktuator',
                'pilihan_c' => 'Basis pengetahuan',
                'pilihan_d' => 'Proyektor',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Basis pengetahuan menyimpan fakta dan aturan untuk pengambilan keputusan dalam sistem pakar.',
            ],
            [
                'tugas_id' => 6,
                'tipe' => 'pg',
                'pertanyaan' => 'Apa yang dimaksud dengan heuristik dalam AI?',
                'pilihan_a' => 'Proses otomatisasi pengumpulan data',
                'pilihan_b' => 'Prosedur acak',
                'pilihan_c' => 'Strategi pemecahan masalah berdasarkan pengalaman atau pendekatan praktis',
                'pilihan_d' => 'Pemetaan jaringan saraf',
                'jawaban_benar' => 'C',
                'alasan_jawaban' => 'Heuristik adalah pendekatan praktis berbasis pengalaman untuk menyelesaikan masalah secara efisien.',
            ],
        ];

        // Soal Essay
        $soalEssay = [
            [
                'tugas_id' => 6, // tugas_id 6
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan perbedaan antara supervised learning dan unsupervised learning disertai contoh masing-masing!',
                'jawaban_benar' => 'Supervised learning menggunakan data berlabel untuk pelatihan model, contoh: klasifikasi spam. Unsupervised learning tidak menggunakan label, contoh: clustering dengan K-Means.',
                'alasan_jawaban' => 'Supervised learning menggunakan data berlabel untuk pelatihan model, contoh: klasifikasi spam. Unsupervised learning tidak menggunakan label, contoh: clustering dengan K-Means.',
            ],
            [
                'tugas_id' => 6,
                'tipe' => 'essay',
                'pertanyaan' => 'Apa itu jaringan saraf tiruan (Artificial Neural Network) dan bagaimana prinsip kerjanya secara umum?',
                'jawaban_benar' => 'ANN meniru otak manusia dengan lapisan neuron. Input diproses melalui lapisan tersembunyi dan bobot, hasil akhir adalah output melalui fungsi aktivasi.',
                'alasan_jawaban' => 'ANN meniru otak manusia dengan lapisan neuron. Input diproses melalui lapisan tersembunyi dan bobot, hasil akhir adalah output melalui fungsi aktivasi.',
            ],
            [
                'tugas_id' => 6,
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan konsep fuzzy logic dan berikan satu contoh penerapannya dalam kehidupan sehari-hari!',
                'jawaban_benar' => 'Fuzzy logic adalah logika berbasis derajat keanggotaan. Contoh penerapannya adalah pengatur suhu AC yang menyesuaikan berdasarkan suhu dan kelembaban ruangan.',
                'alasan_jawaban' => 'Fuzzy logic adalah logika berbasis derajat keanggotaan. Contoh penerapannya adalah pengatur suhu AC yang menyesuaikan berdasarkan suhu dan kelembaban ruangan.',
            ],
            [
                'tugas_id' => 6,
                'tipe' => 'essay',
                'pertanyaan' => 'Sebutkan dan jelaskan perbedaan antara sistem pakar dan sistem berbasis machine learning!',
                'jawaban_benar' => 'Sistem pakar berdasarkan aturan eksplisit, sedangkan ML belajar dari data. Sistem pakar statis, ML bersifat adaptif.',
                'alasan_jawaban' => 'Sistem pakar berdasarkan aturan eksplisit, sedangkan ML belajar dari data. Sistem pakar statis, ML bersifat adaptif.',
            ],
            [
                'tugas_id' => 6,
                'tipe' => 'essay',
                'pertanyaan' => 'Jelaskan langkah-langkah umum dalam pengembangan sistem kecerdasan buatan dari awal hingga implementasi!',
                'jawaban_benar' => '(1) Identifikasi masalah, (2) Kumpulkan data, (3) Pilih metode, (4) Latih model, (5) Evaluasi, (6) Implementasikan.',
                'alasan_jawaban' => '(1) Identifikasi masalah, (2) Kumpulkan data, (3) Pilih metode, (4) Latih model, (5) Evaluasi, (6) Implementasikan.',
            ],
        ];

        // Insert soal pilihan ganda
        foreach ($soalPilihanGanda as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }

        // Insert soal essay
        foreach ($soalEssay as $soal) {
            DB::table('soal_tugas')->insert($soal);
        }
    }
}
