<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswaData = [
            ['name' => "Ammar Siraj Ananda",              'email' => "ammarsananda345@gmail.com",                  'npm' => "G1A023021"],
            ['name' => "Achmad Azza Alhaqi",              'email' => "ahmadazzaalhaqi@gmail.com",                  'npm' => "G1A023037"],
            ['name' => "Pebi Heriansyah",                 'email' => "febypertama1@gmail.com",                     'npm' => "G1A023003"],
            ['name' => "Muhammad Fadli Rahmansyah",       'email' => "muhammadfadlirahmansyah@gmail.com",          'npm' => "G1A023005"],
            ['name' => "Muhammad Zuhri Al kauri",         'email' => "alkauri44@gmail.com",                        'npm' => "G1A023029"],
            ['name' => "Sallaa Fikriyatul 'Arifah",       'email' => "officialsella1@gmail.com",                   'npm' => "G1A023015"],
            ['name' => "Reffki Andrea Pratama",           'email' => "reffkip@gmail.com",                          'npm' => "G1A023939"],
            ['name' => "Muhammad Ariqoh Firjatullah",     'email' => "ariqohfirza01@gmail.com",                    'npm' => "G1A023033"],
            ['name' => "hana syarifah",                   'email' => "hanasyarifah27@gmail.com",                   'npm' => "G1A023017"],
            ['name' => "koreza almukadima",               'email' => "zonevista860@gmail.com",                     'npm' => "G1A023011"],
            ['name' => "Sidik Bagus Firmansyah",          'email' => "sidikbagus46@gmail.com",                     'npm' => "G1A023027"],
            ['name' => "Khaylilla Shafaraly Irnanda",     'email' => "khaylillasi@gmail.com",                      'npm' => "G1A023079"],
            ['name' => "Abim Bintang Audio",              'email' => "abimbintangaudio3@gmail.com",                'npm' => "G1A023073"],
            ['name' => "Najwa Nabilah Wibisono",          'email' => "najwanaa16@gmail.com",                       'npm' => "G1A023065"],
            ['name' => "Lio Kusnata",                     'email' => "liokusnata321@gmail.com",                    'npm' => "G1A023013"],
            ['name' => "Agyl Wendi Pratama",              'email' => "agylwendipratama09@gmail.com",               'npm' => "G1A023087"],
            ['name' => "Mohamad Irvan Ramadhansyah",      'email' => "irvan.46124@gmail.com",                      'npm' => "G1A023089"],
            ['name' => "Rayhan Muhammad Adha",            'email' => "rayhanma0032@gmail.com",                     'npm' => "G1A023051"],
            ['name' => "Nadya Alicia Putri",              'email' => "aliciaanadya@gmail.com",                     'npm' => "G1A023019"],
            ['name' => "Rahman Firdaus Illahi",           'email' => "rahmanfirdaus65@gmail.com",                  'npm' => "G1A023055"],
            ['name' => "Salah Nasser Hasan Meqdam",       'email' => "salahmeqdam80@gmail.com",                    'npm' => "G1A023095"],
            ['name' => "Hendro Paulus Limbong",           'email' => "hendrol678@gmail.com",                       'npm' => "G1A023091"],
            ['name' => "Merischa Theresia Hutauruk",      'email' => "merischateresiaa@gmail.com",                 'npm' => "G1A023071"],
            ['name' => "JUNDI AL FARROS",                 'email' => "alfarros05@gmail.com",                       'npm' => "G1A023031"],
            ['name' => "I Nyoman Dimas Kresna Adryan",    'email' => "dimaskresnaadryan2016@gmail.com",            'npm' => "G1A023077"],
            ['name' => "Muhammad Farhan Dzakki",          'email' => "mfdzakki@gmail.com",                         'npm' => "G1A023041"],
            ['name' => "Ricardo Gellael",                 'email' => "ricardogellael48@gmail.com",                 'npm' => "G1A023061"],
            ['name' => "Yohanes Adi Prasetya",            'email' => "desi.gc123@gmail.com",                       'npm' => "G1A023049"],
            ['name' => "Tis Fidiatul Hasanah",            'email' => "tisfidiatulhasanah@gmail.com",               'npm' => "G1A023023"],
            ['name' => "Habib Al Qodri",                  'email' => "viraazzahra017@gmail.com",                   'npm' => "G1A023047"],
            ['name' => "Ajis Saputra Hidayah",            'email' => "ajiss1296@gmail.com",                        'npm' => "G1A023083"],
            ['name' => "Abram Dimas Hoswandi",            'email' => "abramdimas1@gmail.com",                      'npm' => "G1A021043"],
            ['name' => "Waridhania As Syifa",             'email' => "syifawaridhania10@gmail.com",                'npm' => "G1A023075"],
            ['name' => "Linia Nur Aini",                  'email' => "liniaaini@gmail.com",                        'npm' => "G1A023007"],
            ['name' => "Ayu Dewanti Suci",                'email' => "ayudewanti2005@gmail.com",                   'npm' => "G1A023057"],
            ['name' => "aurel moura athanafisah",         'email' => "aurelmouraa17@gmail.com",                    'npm' => "G1A023001"],
            ['name' => "Lidya Feronica",                  'email' => "lidyaferonica206@gmail.com",                 'npm' => "G1A023009"],
            ['name' => "Aulia Dwi Rahmadani",             'email' => "auliarainbow25@gmail.com",                   'npm' => "G1A023043"],
            ['name' => "Muhammad Ryan Al Habsy",          'email' => "mryanalhabsy@gmail.com",                     'npm' => "G1A023093"],
            ['name' => "Habib Eddler Marpen",             'email' => "boboiboysaja08@gmail.com",                   'npm' => "G1A023025"],
            ['name' => "Ghazi Al-Ghifari",                'email' => "ghazimc27@gmail.com",                        'npm' => "G1A023053"],
            ['name' => "Attar Zaki Al Ghifari",           'email' => "attarzaq@gmail.com",                         'npm' => "G1A023035"],
            ['name' => "Juan Agraprana Putra",            'email' => "juanagrapranaputra123@gmail.com",            'npm' => "G1A023085"],
            ['name' => "Khayla Rahma Levina",             'email' => "khayla.levina19@gmail.com",                  'npm' => "G1A023045"],
            ['name' => "Kenia Nurma Feblia",              'email' => "keniafeblia21@gmail.com",                    'npm' => "G1A023004"],
            ['name' => "Muhammad Hafizh Ario Diffo",      'email' => "muhammadhafizhariodiffo@gmail.com",          'npm' => "G1A023032"],
            ['name' => "Anisa Julianti",                  'email' => "anisajulianti16@gmail.com",                  'npm' => "G1A023052"],
            ['name' => "Muhammad Ripal Rabbani",          'email' => "mhdripalrabbani@gmail.com",                  'npm' => "G1A023064"],
            ['name' => "Aditya Saputra",                  'email' => "shinra0316@gmail.com",                       'npm' => "G1A023024"],
            ['name' => "Rheby Ersa Monica",               'email' => "rhebyersa@gmail.com",                        'npm' => "G1A023016"],
            ['name' => "Bavio Robia Rahmadan",            'email' => "baviorobiar@gmail.com",                      'npm' => "G1A023002"],
            ['name' => "azzahra faranisa",                'email' => "rarazahraaza@gmail.com",                     'npm' => "G1A023010"],
            ['name' => "Rahma Hidayati Fitrah",           'email' => "rahmahidayatif@gmail.com",                   'npm' => "G1A023074"],
            ['name' => "Herlita",                         'email' => "hlita7636@gmail.com",                        'npm' => "G1A023018"],
            ['name' => "Anis Syarifatul Mursyidah",       'email' => "anis0syarif@gmail.com",                      'npm' => "G1A023036"],
            ['name' => "Muhammad Yasser Ghifari Tegar Awally", 'email' => "abgtegar@gmail.com",                   'npm' => "G1A023030"],
            ['name' => "Qonita Adzkiatul Mardiyah",       'email' => "qonitaazqia207@gmail.com",                   'npm' => "G1A023086"],
            ['name' => "Muhammad Aimar Apda Hadis",       'email' => "aimar369258@gmail.com",                      'npm' => "G1A023048"],
            ['name' => "Ramadan Mufian",                  'email' => "mufianramadan7@gmail.com",                   'npm' => "G1A023020"],
            ['name' => "Filya Chiara Amanda",             'email' => "filyachiaraamanda@gmail.com",                'npm' => "G1A023034"],
            ['name' => "Carissa Nabilah Putri Rozi",      'email' => "carissanabilah10@gmail.com",                 'npm' => "G1A023026"],
            ['name' => "Fidia Dewi Wulandari Batu Bara",  'email' => "fidiadwii8@gmail.com",                       'npm' => "G1A023040"],
            ['name' => "Khalisa Rizgita Amanda",          'email' => "khalisa.amanda84@gmail.com",                 'npm' => "G1A023080"],
            ['name' => "Revialdi Rifqi Ramadhan Permana", 'email' => "rifqi.slackers@gmail.com",                   'npm' => "G1A023066"],
            ['name' => "Primanda Nafissa Alfiansyah",     'email' => "primandanafissaalfiansyah79@gmail.com",      'npm' => "G1A023044"],
            ['name' => "Adelia Nurazizah Omega Putri",    'email' => "adeliomega04@gmail.com",                     'npm' => "G1A023022"],
            ['name' => "Fathiyya Nafisah",                'email' => "fathiyya.nafisah2@gmail.com",                'npm' => "G1A023056"],
            ['name' => "Dinda Krisnauli Pakpahan",        'email' => "dindakrisnauli04@gmail.com",                 'npm' => "G1A023076"],
            ['name' => "Diosi Putri Arlita",              'email' => "diosiputriarlita06@gmail.com",               'npm' => "G1A023012"],
            ['name' => "Fassrah Putra Gunawan",           'email' => "fassrahpgunawan@gmail.com",                  'npm' => "G1A023038"],
            ['name' => "Robi Septian Subhan",             'email' => "robby7922@gmail.com",                        'npm' => "G1A023060"],
            ['name' => "Abid Al Husain",                  'email' => "mhdal844@gmail.com",                         'npm' => "G1A023062"],
            ['name' => "HANIF AL KAHFI",                  'email' => "haniplahat@gmail.com",                       'npm' => "G1A023078"],
            ['name' => "Yovanza Villareal",               'email' => "yovanza123@gmail.com",                       'npm' => "G1A023054"],
            ['name' => "Muhammad Tariq Pratama Buhar",    'email' => "yatariqqq@gmail.com",                        'npm' => "G1A023028"],
            ['name' => "Arrafi Andersont",                'email' => "andersontarrafi@gmail.com",                  'npm' => "G1A023090"],
            ['name' => "Muhammad Adani Saputra",          'email' => "adanisaputra01@gmail.com",                   'npm' => "G1A023082"],
            ['name' => "Migel Ray Sirait",                'email' => "migelsirait23@gmail.com",                    'npm' => "G1A023088"],
            ['name' => "Intan Oktaviani Presia",          'email' => "intanoktav272@gmail.com",                    'npm' => "G1A023014"],
            ['name' => "M. ihtifanul Montaghib",          'email' => "m.ihtifanul@gmail.com",                      'npm' => "G1A023094"],
        ];

        foreach ($mahasiswaData as $data) {
            User::factory()->mahasiswa()->create($data);
        }


        // Buat 1 admin
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
        ]);

        // Buat 1 Dosen
        User::factory()->dosen()->create([
            'name' => 'Dosen User',
            'email' => 'dosen@gmail.com',
        ]);

        // Buat 1 Mahasiswa
        User::factory()->mahasiswa()->create([
            'name' => 'Mahasiswa User',
            'email' => 'mahasiswa@gmail.com',
        ]);



        // Buat 5 dosen
        // User::factory(5)->dosen()->create();

        // Buat 10 mahasiswa
        // User::factory(15)->mahasiswa()->create();
    }
}
