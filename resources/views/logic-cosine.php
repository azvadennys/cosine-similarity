<?php

class EnhancedTextSimilarityAnalyzer
{
    private $config = [
        'case_sensitive' => false,
        'keep_punctuation' => false,
        'remove_stopwords' => false,  // Disabled by default for debugging
        'tf_method' => 'normalized',
        'idf_method' => 'smooth',     // More reliable than standard
        'normalize_vectors' => true,
        'min_word_length' => 2,       // Ignore single-character words
        'debug_mode' => true          // Helps identify issues
    ];

    private $stopwords = [
        'ada',
        'adalah',
        'adanya',
        'adapun',
        'agak',
        'agaknya',
        'agar',
        'akan',
        'akankah',
        'akhirnya',
        'aku',
        'akulah',
        'amat',
        'amatlah',
        'anda',
        'andalah',
        'antar',
        'antara',
        'antaranya',
        'apa',
        'apaan',
        'apabila',
        'apakah',
        'apalagi',
        'apatah',
        'atau',
        'ataukah',
        'ataupun',
        'bagai',
        'bagaikan',
        'bagaimana',
        'bagaimanakah',
        'bagaimanapun',
        'bagi',
        'bagian',
        'bahkan',
        'bahwa',
        'bahwasanya',
        'baik',
        'bakal',
        'bakalan',
        'balik',
        'banyak',
        'bapak',
        'baru',
        'bawah',
        'beberapa',
        'begini',
        'beginian',
        'beginikah',
        'beginilah',
        'begitu',
        'begitukah',
        'begitulah',
        'begitupun',
        'bekerja',
        'belakang',
        'belum',
        'belumlah',
        'benar',
        'benarkah',
        'benarlah',
        'berada',
        'berakhir',
        'berakhirlah',
        'berakhirnya',
        'berapa',
        'berapakah',
        'berapalah',
        'berapapun',
        'berarti',
        'berawal',
        'berbagai',
        'berdatangan',
        'beri',
        'berikan',
        'berikut',
        'berikutnya',
        'berjumlah',
        'berkali-kali',
        'berkata',
        'berkehendak',
        'berkeinginan',
        'berkenaan',
        'berlainan',
        'berlalu',
        'berlangsung',
        'berlebihan',
        'bermacam',
        'bermacam-macam',
        'bermaksud',
        'bermula',
        'bersama',
        'bersama-sama',
        'bersiap',
        'bersiap-siap',
        'bertanya',
        'bertanya-tanya',
        'berturut',
        'berturut-turut',
        'bertutur',
        'berujar',
        'berupa',
        'besar',
        'betul',
        'betulkah',
        'biasa',
        'biasanya',
        'bila',
        'bilakah',
        'bisa',
        'bisakah',
        'boleh',
        'bolehkah',
        'bolehlah',
        'buat',
        'bukan',
        'bukankah',
        'bukanlah',
        'bukannya',
        'bulan',
        'bung',
        'cara',
        'caranya',
        'cukup',
        'cukupkah',
        'cukuplah',
        'cuma',
        'dahulu',
        'dalam',
        'dan',
        'dapat',
        'dari',
        'daripada',
        'datang',
        'dekat',
        'demi',
        'demikian',
        'demikianlah',
        'dengan',
        'depan',
        'di',
        'dia',
        'diakhiri',
        'diakhirinya',
        'dialah',
        'diantara',
        'diantaranya',
        'diberi',
        'diberikan',
        'diberikannya',
        'dibuat',
        'dibuatnya',
        'didapat',
        'didatangkan',
        'digunakan',
        'diibaratkan',
        'diibaratkannya',
        'diingat',
        'diingatkan',
        'diinginkan',
        'dijawab',
        'dikatakan',
        'dikatakannya',
        'dikerjakan',
        'diketahui',
        'diketahuinya',
        'dikira',
        'dilakukan',
        'dilalui',
        'dilihat',
        'dimaksud',
        'dimaksudkan',
        'dimaksudkannya',
        'dimaksudnya',
        'diminta',
        'dimintai',
        'dimisalkan',
        'dimulai',
        'dimulailah',
        'dimulainya',
        'dimungkinkan',
        'dini',
        'dipastikan',
        'diperbuat',
        'diperbuatnya',
        'dipergunakan',
        'diperkirakan',
        'diperlihatkan',
        'diperlukan',
        'diperlukannya',
        'dipersoalkan',
        'dipertanyakan',
        'dipunyai',
        'diri',
        'dirinya',
        'disampaikan',
        'disebut',
        'disebutkan',
        'disebutkannya',
        'disini',
        'disinilah',
        'ditambahkan',
        'ditandaskan',
        'ditanya',
        'ditanyai',
        'ditanyakan',
        'ditegaskan',
        'ditujukan',
        'ditunjuk',
        'ditunjuki',
        'ditunjukkan',
        'ditunjukkannya',
        'ditunjuknya',
        'dituturkan',
        'dituturkannya',
        'diucapkan',
        'diucapkannya',
        'diungkapkan',
        'dong',
        'dua',
        'dulu',
        'empat',
        'enggak',
        'enggaknya',
        'entah',
        'entahlah',
        'guna',
        'gunakan',
        'hal',
        'hampir',
        'hanya',
        'hanyalah',
        'hari',
        'harus',
        'haruslah',
        'harusnya',
        'hendak',
        'hendaknya',
        'hingga',
        'ia',
        'ialah',
        'ibarat',
        'ibaratkan',
        'ibaratnya',
        'ibu',
        'ikut',
        'ingat',
        'ingin',
        'inginkah',
        'inginkan',
        'ini',
        'inikah',
        'inilah',
        'itu',
        'itukah',
        'itulah',
        'jadi',
        'jadilah',
        'jadinya',
        'jangan',
        'jangankan',
        'janganlah',
        'jauh',
        'jawab',
        'jawaban',
        'jawabnya',
        'jelas',
        'jelaskan',
        'jelaslah',
        'jelasnya',
        'jika',
        'jikalau',
        'juga',
        'jumlah',
        'jumlahnya',
        'justru',
        'kala',
        'kalau',
        'kalaulah',
        'kalaupun',
        'kalian',
        'kami',
        'kamilah',
        'kamu',
        'kamulah',
        'kan',
        'kapan',
        'kapankah',
        'kapanpun',
        'karena',
        'karenanya',
        'kasus',
        'kata',
        'katakan',
        'katakanlah',
        'katanya',
        'ke',
        'keadaan',
        'kebetulan',
        'kecil',
        'kedua',
        'keduanya',
        'keinginan',
        'kelamaan',
        'kelihatan',
        'kelihatannya',
        'kelima',
        'keluar',
        'kembali',
        'kemudian',
        'kemungkinan',
        'kemungkinannya',
        'kenapa',
        'kepada',
        'kepadanya',
        'kesampaian',
        'keseluruhan',
        'keseluruhannya',
        'keterlaluan',
        'ketika',
        'khusus',
        'khususnya',
        'kini',
        'kinilah',
        'kira',
        'kira-kira',
        'kiranya',
        'kita',
        'kitalah',
        'kok',
        'kurang',
        'lagi',
        'lagian',
        'lah',
        'lain',
        'lainnya',
        'lalu',
        'lama',
        'lamanya',
        'lanjut',
        'lanjutnya',
        'lebih',
        'lewat',
        'lima',
        'luar',
        'macam',
        'maka',
        'makanya',
        'makin',
        'malah',
        'malahan',
        'mampu',
        'mampukah',
        'mana',
        'manakala',
        'manalagi',
        'masa',
        'masalah',
        'masalahnya',
        'masih',
        'masihkah',
        'masing',
        'masing-masing',
        'mau',
        'maupun',
        'melainkan',
        'melakukan',
        'melalui',
        'melihat',
        'melihatnya',
        'memang',
        'memastikan',
        'memberi',
        'memberikan',
        'membuat',
        'memerlukan',
        'memihak',
        'meminta',
        'memintakan',
        'memisalkan',
        'memperbuat',
        'mempergunakan',
        'memperkirakan',
        'memperlihatkan',
        'mempersiapkan',
        'mempersoalkan',
        'mempertanyakan',
        'mempunyai',
        'memulai',
        'memungkinkan',
        'menaiki',
        'menambahkan',
        'menandaskan',
        'menanti',
        'menantikan',
        'menanya',
        'menanyai',
        'menanyakan',
        'mendapat',
        'mendapatkan',
        'mendatang',
        'mendatangi',
        'mendatangkan',
        'menegaskan',
        'mengakhiri',
        'mengapa',
        'mengatakan',
        'mengatakannya',
        'mengenai',
        'mengerjakan',
        'mengetahui',
        'menggunakan',
        'menghendaki',
        'mengibaratkan',
        'mengibaratkannya',
        'mengingat',
        'mengingatkan',
        'menginginkan',
        'mengira',
        'mengucapkan',
        'mengucapkannya',
        'mengungkapkan',
        'menjadi',
        'menjawab',
        'menjelaskan',
        'menuju',
        'menunjuk',
        'menunjuki',
        'menunjukkan',
        'menunjuknya',
        'menurut',
        'menuturkan',
        'menyampaikan',
        'menyangkut',
        'menyatakan',
        'menyebutkan',
        'menyeluruh',
        'menyiapkan',
        'merasa',
        'mereka',
        'merekalah',
        'merupakan',
        'meski',
        'meskipun',
        'meyakini',
        'meyakinkan',
        'minta',
        'mirip',
        'misal',
        'misalkan',
        'misalnya',
        'mula',
        'mulai',
        'mulailah',
        'mulanya',
        'mungkin',
        'mungkinkah',
        'nah',
        'naik',
        'namun',
        'nanti',
        'nantinya',
        'nyaris',
        'nyatanya',
        'oleh',
        'olehnya',
        'pada',
        'padahal',
        'padanya',
        'pak',
        'paling',
        'panjang',
        'pantas',
        'para',
        'pasti',
        'pastilah',
        'penting',
        'pentingnya',
        'per',
        'percuma',
        'perlu',
        'perlukah',
        'perlunya',
        'pernah',
        'persoalan',
        'pertama',
        'pertama-tama',
        'pertanyaan',
        'pertanyakan',
        'pihak',
        'pihaknya',
        'pukul',
        'pula',
        'pun',
        'punya',
        'rasa',
        'rasanya',
        'rata',
        'rupanya',
        'saat',
        'saatnya',
        'saja',
        'sajalah',
        'saling',
        'sama',
        'sama-sama',
        'sambil',
        'sampai',
        'sampai-sampai',
        'sampaikan',
        'sana',
        'sangat',
        'sangatlah',
        'satu',
        'saya',
        'sayalah',
        'se',
        'sebab',
        'sebabnya',
        'sebagai',
        'sebagaimana',
        'sebagainya',
        'sebagian',
        'sebaik',
        'sebaik-baiknya',
        'sebaiknya',
        'sebaliknya',
        'sebanyak',
        'sebegini',
        'sebegitu',
        'sebelum',
        'sebelumnya',
        'sebenarnya',
        'seberapa',
        'sebesar',
        'sebetulnya',
        'sebisanya',
        'sebuah',
        'sebut',
        'sebutlah',
        'sebutnya',
        'secara',
        'secukupnya',
        'sedang',
        'sedangkan',
        'sedemikian',
        'sedikit',
        'sedikitnya',
        'seenaknya',
        'segala',
        'segalanya',
        'segera',
        'seharusnya',
        'sehingga',
        'seingat',
        'sejak',
        'sejauh',
        'sejenak',
        'sejumlah',
        'sekadar',
        'sekadarnya',
        'sekali',
        'sekali-kali',
        'sekalian',
        'sekaligus',
        'sekalipun',
        'sekarang',
        'sekarang',
        'sekecil',
        'seketika',
        'sekiranya',
        'sekitar',
        'sekitarnya',
        'sekurang-kurangnya',
        'sekurangnya',
        'sela',
        'selain',
        'selaku',
        'selalu',
        'selama',
        'selama-lamanya',
        'selamanya',
        'selanjutnya',
        'seluruh',
        'seluruhnya',
        'semacam',
        'semakin',
        'semampu',
        'semampunya',
        'semasa',
        'semasih',
        'semata',
        'semata-mata',
        'semaunya',
        'sementara',
        'semisal',
        'semisalnya',
        'sempat',
        'semua',
        'semuanya',
        'semula',
        'sendiri',
        'sendirian',
        'sendirinya',
        'seolah',
        'seolah-olah',
        'seorang',
        'sepanjang',
        'sepantasnya',
        'sepantasnyalah',
        'seperlunya',
        'seperti',
        'sepertinya',
        'sepihak',
        'sering',
        'seringnya',
        'serta',
        'serupa',
        'sesaat',
        'sesama',
        'sesampai',
        'sesegera',
        'sesekali',
        'seseorang',
        'sesuatu',
        'sesuatunya',
        'sesudah',
        'sesudahnya',
        'setelah',
        'setempat',
        'setengah',
        'seterusnya',
        'setiap',
        'setiba',
        'setibanya',
        'setidak-tidaknya',
        'setidaknya',
        'setinggi',
        'seusai',
        'sewaktu',
        'siap',
        'siapa',
        'siapakah',
        'siapapun',
        'sini',
        'sinilah',
        'soal',
        'soalnya',
        'suatu',
        'sudah',
        'sudahkah',
        'sudahlah',
        'supaya',
        'tadi',
        'tadinya',
        'tahu',
        'tahun',
        'tak',
        'tambah',
        'tambahnya',
        'tampak',
        'tampaknya',
        'tandas',
        'tandasnya',
        'tanpa',
        'tanya',
        'tanyakan',
        'tanyanya',
        'tapi',
        'tegas',
        'tegasnya',
        'telah',
        'tempat',
        'tengah',
        'tentang',
        'tentu',
        'tentulah',
        'tentunya',
        'tepat',
        'terakhir',
        'terasa',
        'terbanyak',
        'terdahulu',
        'terdapat',
        'terdiri',
        'terhadap',
        'terhadapnya',
        'teringat',
        'teringat-ingat',
        'terjadi',
        'terjadilah',
        'terjadinya',
        'terkira',
        'terlalu',
        'terlebih',
        'terlihat',
        'termasuk',
        'ternyata',
        'tersampaikan',
        'tersebut',
        'tersebutlah',
        'tertentu',
        'tertuju',
        'terus',
        'terutama',
        'tetap',
        'tetapi',
        'tiap',
        'tiba',
        'tiba-tiba',
        'tidak',
        'tidakkah',
        'tidaklah',
        'tiga',
        'toh',
        'tunjuk',
        'turut',
        'tutur',
        'tuturnya',
        'ucap',
        'ucapnya',
        'ujar',
        'ujarnya',
        'umum',
        'umumnya',
        'ungkap',
        'ungkapnya',
        'untuk',
        'usah',
        'usai',
        'waduh',
        'wah',
        'wahai',
        'waktu',
        'waktunya',
        'walau',
        'walaupun',
        'wong',
        'yaitu',
        'yakin',
        'yakni',
        'yang'
    ];

    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);

        if ($this->config['debug_mode']) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }
    }

    public function compareSentences(string $sentence1, string $sentence2): array
    {
        // Debug output
        if ($this->config['debug_mode']) {
            echo "<pre>Original Sentence 1: " . htmlspecialchars($sentence1) . "\n";
            echo "Original Sentence 2: " . htmlspecialchars($sentence2) . "\n";
        }

        $tokens1 = $this->tokenize($sentence1);
        $tokens2 = $this->tokenize($sentence2);

        if ($this->config['debug_mode']) {
            echo "\nTokens 1: " . print_r($tokens1, true);
            echo "Tokens 2: " . print_r($tokens2, true);
        }

        // Check for empty token sets
        if (empty($tokens1) || empty($tokens2)) {
            return $this->handleEmptyInput($tokens1, $tokens2);
        }

        $tfidf = $this->calculateTfIdfVectors($tokens1, $tokens2);
        $similarity = $this->cosineSimilarity($tfidf['vector1'], $tfidf['vector2']);

        if ($this->config['debug_mode']) {
            echo "\nTF Sentence 1: " . print_r($tfidf['term_frequencies']['sentence1'], true);
            echo "TF Sentence 2: " . print_r($tfidf['term_frequencies']['sentence2'], true);
            echo "IDF Values: " . print_r($tfidf['idf_values'], true);
            echo "TF-IDF Vector 1: " . print_r($tfidf['vector1'], true);
            echo "TF-IDF Vector 2: " . print_r($tfidf['vector2'], true);
            echo "Similarity: " . $similarity . "\n</pre>";
        }

        return [
            'similarity_score' => $similarity,
            'similarity_percentage' => round($similarity * 100, 2),
            'interpretation' => $this->interpretSimilarity($similarity),
            'vectors' => $tfidf,
            'tokens' => [
                'sentence1' => $tokens1,
                'sentence2' => $tokens2
            ],
            'config' => $this->config,
            'warnings' => $this->checkForWarnings($tokens1, $tokens2, $tfidf)
        ];
    }

    private function handleEmptyInput(array $tokens1, array $tokens2): array
    {
        $warning = '';
        if (empty($tokens1)) $warning .= "Sentence 1 became empty after processing. ";
        if (empty($tokens2)) $warning .= "Sentence 2 became empty after processing.";

        return [
            'similarity_score' => 0,
            'similarity_percentage' => 0,
            'interpretation' => "No comparable content found",
            'vectors' => [
                'vector1' => [],
                'vector2' => [],
                'vocabulary' => [],
                'term_frequencies' => [
                    'sentence1' => [],
                    'sentence2' => []
                ],
                'idf_values' => []
            ],
            'tokens' => [
                'sentence1' => $tokens1,
                'sentence2' => $tokens2
            ],
            'config' => $this->config,
            'warnings' => $warning
        ];
    }

    private function tokenize(string $text): array
    {
        if (!$this->config['case_sensitive']) {
            $text = mb_strtolower($text, 'UTF-8');
        }

        if (!$this->config['keep_punctuation']) {
            $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text);
        }

        $tokens = preg_split('/\s+/', trim($text), -1, PREG_SPLIT_NO_EMPTY);

        // Filter by minimum word length
        $tokens = array_filter($tokens, function ($token) {
            return mb_strlen($token, 'UTF-8') >= $this->config['min_word_length'];
        });

        if ($this->config['remove_stopwords']) {
            $tokens = array_diff($tokens, $this->stopwords);
        }

        return array_values($tokens);
    }

    private function calculateTfIdfVectors(array $tokens1, array $tokens2): array
    {
        $vocabulary = array_unique(array_merge($tokens1, $tokens2));
        $documents = [$tokens1, $tokens2];

        $tf1 = $this->calculateTermFrequency($tokens1, $vocabulary);
        $tf2 = $this->calculateTermFrequency($tokens2, $vocabulary);
        $idf = $this->calculateInverseDocumentFrequency($documents, $vocabulary);

        $vector1 = $this->calculateTfIdf($tf1, $idf);
        $vector2 = $this->calculateTfIdf($tf2, $idf);

        if ($this->config['normalize_vectors']) {
            $vector1 = $this->normalizeVector($vector1);
            $vector2 = $this->normalizeVector($vector2);
        }

        return [
            'vector1' => $vector1,
            'vector2' => $vector2,
            'vocabulary' => $vocabulary,
            'term_frequencies' => [
                'sentence1' => $tf1,
                'sentence2' => $tf2
            ],
            'idf_values' => $idf
        ];
    }

    private function calculateTermFrequency(array $tokens, array $vocabulary): array
    {
        $wordCounts = array_count_values($tokens);
        $totalWords = count($tokens);
        $tf = [];

        foreach ($vocabulary as $word) {
            $count = $wordCounts[$word] ?? 0;

            switch ($this->config['tf_method']) {
                case 'raw':
                    $tf[$word] = $count;
                    break;
                case 'log':
                    $tf[$word] = $count > 0 ? log(1 + $count) : 0;
                    break;
                case 'double':
                    $maxCount = max($wordCounts);
                    $tf[$word] = 0.5 + 0.5 * ($count / ($maxCount ?: 1));
                    break;
                default: // normalized
                    $tf[$word] =  round($totalWords > 0 ? $count / $totalWords : 0, 3);
            }
        }

        return $tf;
    }

    private function calculateInverseDocumentFrequency(array $documents, array $vocabulary): array
    {
        $totalDocuments = count($documents);
        $idf = [];

        foreach ($vocabulary as $word) {
            $documentsWithWord = 0;
            foreach ($documents as $doc) {
                if (in_array($word, $doc)) {
                    $documentsWithWord++;
                }
            }

            // Ensure we never divide by zero
            $documentsWithWord = max($documentsWithWord, 1);

            switch ($this->config['idf_method']) {
                case 'smooth':
                    $idf[$word] = log(1 + ($totalDocuments / $documentsWithWord));
                    break;
                case 'smooth_addone':  // Your requested method
                    $idf[$word] = round(log10($totalDocuments / (1 + $documentsWithWord)) + 1, 3);
                    break;
                case 'max':
                    $maxDocs = 0;
                    foreach ($vocabulary as $w) {
                        $dw = 0;
                        foreach ($documents as $doc) {
                            if (in_array($w, $doc)) $dw++;
                        }
                        if ($dw > $maxDocs) $maxDocs = $dw;
                    }
                    $idf[$word] = log(1 + ($maxDocs / $documentsWithWord));
                    break;
                case 'probabilistic':
                    $idf[$word] = log(($totalDocuments - $documentsWithWord) / $documentsWithWord);
                    break;
                default: // standard
                    $idf[$word] = log($totalDocuments / $documentsWithWord);
            }

            // Ensure IDF is never negative
            $idf[$word] = max($idf[$word], 0);
        }

        return $idf;
    }

    private function calculateTfIdf(array $tf, array $idf): array
    {
        $tfidf = [];
        foreach ($tf as $word => $tfValue) {
            $tfidf[$word] = round($tfValue * $idf[$word], 3);
        }
        return $tfidf;
    }

    private function normalizeVector(array $vector): array
    {
        $magnitude = 0;
        foreach ($vector as $value) {
            $magnitude += $value * $value;
        }
        $magnitude = sqrt($magnitude);

        if ($magnitude > 0) {
            foreach ($vector as $word => $value) {
                $vector[$word] = $value / $magnitude;
            }
        }

        return $vector;
    }

    private function cosineSimilarity(array $vector1, array $vector2): float
    {
        if (empty($vector1) || empty($vector2)) {
            return 0.0;
        }

        $dotProduct = 0;
        $magnitude1 = 0;
        $magnitude2 = 0;

        $allWords = array_unique(array_merge(array_keys($vector1), array_keys($vector2)));

        $allWords = array_unique(array_merge(array_keys($vector1), array_keys($vector2)));

        foreach ($allWords as $word) {
            $val1 = $vector1[$word] ?? 0;
            $val2 = $vector2[$word] ?? 0;

            $dotProduct += $val1 * $val2;
            if ($this->config['debug_mode']) {
                echo 'dot product ' . $word . ' = ' . $val1 . 'x' . $val2 . ' = ' . ($val1 * $val2) . "\n";
            }
            $magnitude1 += $val1 * $val1;
            $magnitude2 += $val2 * $val2;
        }



        $magnitude1 = sqrt($magnitude1);
        $magnitude2 = sqrt($magnitude2);

        $denominator = $magnitude1 * $magnitude2;

        if ($denominator == 0) {
            return 0.0;
        }
        if ($this->config['debug_mode']) {
            echo 'total dot product = ' . $dotProduct . "\n";
            echo 'total magnitude1 = ' . $magnitude1 . "\n";
            echo 'total magnitude2 = ' . $magnitude2 . "\n";
            echo 'total denominator = ' . $denominator . "\n";
            echo 'total cosine = ' . $dotProduct / $denominator . "\n";
        }
        return max(min($dotProduct / $denominator, 1.0), 0.0);
    }

    private function interpretSimilarity(float $score): string
    {
        if ($score >= 0.9) return "Very high similarity (nearly identical)";
        if ($score >= 0.7) return "High similarity (very similar content)";
        if ($score >= 0.5) return "Moderate similarity (shared concepts)";
        if ($score >= 0.3) return "Low similarity (some relation)";
        if ($score > 0) return "Very low similarity (minimal relation)";
        return "No similarity detected";
    }

    private function checkForWarnings(array $tokens1, array $tokens2, array $tfidf): array
    {
        $warnings = [];

        // Check for empty inputs
        if (empty($tokens1)) $warnings[] = "Sentence 1 became empty after processing";
        if (empty($tokens2)) $warnings[] = "Sentence 2 became empty after processing";

        // Check for no overlapping vocabulary
        $overlap = array_intersect($tokens1, $tokens2);
        if (empty($overlap)) $warnings[] = "No common words between sentences";

        // Check for zero IDF values
        $zeroIdf = array_filter($tfidf['idf_values'], function ($val) {
            return $val == 0;
        });
        if (!empty($zeroIdf)) {
            $warnings[] = "Some terms have IDF=0 (appear in all documents): " . implode(', ', array_keys($zeroIdf));
        }

        return $warnings;
    }

    public function generateHtmlReport(array $analysis): string
    {
        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Enhanced Text Similarity Report</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; margin: 20px; }
                .container { max-width: 1000px; margin: 0 auto; }
                .panel { border: 1px solid #ddd; border-radius: 5px; padding: 15px; margin-bottom: 20px; }
                .similarity-score { 
                    font-size: 28px; text-align: center; margin: 20px 0; padding: 20px;
                    background: linear-gradient(135deg, #e6f7ff, #f0faff);
                    border-radius: 5px;
                }
                .score-value { font-size: 36px; font-weight: bold; color: #2c7be5; }
                .warning { 
                    background-color: #fff3cd; 
                    border-left: 4px solid #ffc107;
                    padding: 10px;
                    margin: 10px 0;
                }
                table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
                th { background-color: #f5f7fa; }
                .highlight { background-color: #fffde7; }
                .zero-value { color: #999; }
                .bar-container { display: flex; height: 20px; background: #f0f0f0; margin-top: 5px; }
                .bar { height: 100%; background: #4CAF50; }
                .config-summary { background: #f8f9fa; padding: 10px; border-radius: 5px; }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Enhanced Text Similarity Report</h1>';

        // Display warnings if any
        if (!empty($analysis['warnings'])) {
            $html .= '<div class="warning"><h3>⚠️ Warnings</h3><ul>';
            foreach ($analysis['warnings'] as $warning) {
                $html .= '<li>' . htmlspecialchars($warning) . '</li>';
            }
            $html .= '</ul></div>';
        }

        $html .= '
                <div class="panel">
                    <h2>Input Sentences</h2>
                    <p><strong>Sentence 1:</strong> ' . htmlspecialchars(implode(' ', $analysis['tokens']['sentence1'])) . '</p>
                    <p><strong>Sentence 2:</strong> ' . htmlspecialchars(implode(' ', $analysis['tokens']['sentence2'])) . '</p>
                </div>
                
                <div class="panel config-summary">
                    <h2>Configuration</h2>
                    <p><strong>Case Sensitive:</strong> ' . ($analysis['config']['case_sensitive'] ? 'Yes' : 'No') . '</p>
                    <p><strong>Keep Punctuation:</strong> ' . ($analysis['config']['keep_punctuation'] ? 'Yes' : 'No') . '</p>
                    <p><strong>Remove Stopwords:</strong> ' . ($analysis['config']['remove_stopwords'] ? 'Yes' : 'No') . '</p>
                    <p><strong>TF Method:</strong> ' . htmlspecialchars($analysis['config']['tf_method']) . '</p>
                    <p><strong>IDF Method:</strong> ' . htmlspecialchars($analysis['config']['idf_method']) . '</p>
                    <p><strong>Normalize Vectors:</strong> ' . ($analysis['config']['normalize_vectors'] ? 'Yes' : 'No') . '</p>
                </div>
                
                <div class="panel similarity-score">
                    <h2>Similarity Result</h2>
                    <div class="score-value">' . $analysis['similarity_percentage'] . '%</div>
                    <p>' . $analysis['interpretation'] . '</p>
                    <div class="bar-container">
                        <div class="bar" style="width: ' . $analysis['similarity_percentage'] . '%"></div>
                    </div>
                </div>
                
                <div class="panel">
                    <h2>Term Analysis</h2>
                    <table>
                        <tr>
                            <th>Term</th>
                            <th>TF Sentence 1</th>
                            <th>TF Sentence 2</th>
                            <th>IDF</th>
                            <th>TF-IDF Sentence 1</th>
                            <th>TF-IDF Sentence 2</th>
                            <th>Contribution</th>
                        </tr>';

        foreach ($analysis['vectors']['vocabulary'] as $term) {
            $tf1 = $analysis['vectors']['term_frequencies']['sentence1'][$term] ?? 0;
            $tf2 = $analysis['vectors']['term_frequencies']['sentence2'][$term] ?? 0;
            $idf = $analysis['vectors']['idf_values'][$term] ?? 0;
            $tfidf1 = $analysis['vectors']['vector1'][$term] ?? 0;
            $tfidf2 = $analysis['vectors']['vector2'][$term] ?? 0;
            $contribution = $tfidf1 * $tfidf2;

            $rowClass = $contribution > 0 ? 'highlight' : '';
            $zeroClass = fn($val) => $val == 0 ? 'zero-value' : '';

            $html .= '<tr class="' . $rowClass . '">
                <td><strong>' . htmlspecialchars($term) . '</strong></td>
                <td class="' . $zeroClass($tf1) . '">' . number_format($tf1, 4) . '</td>
                <td class="' . $zeroClass($tf2) . '">' . number_format($tf2, 4) . '</td>
                <td>' . number_format($idf, 4) . '</td>
                <td class="' . $zeroClass($tfidf1) . '">' . number_format($tfidf1, 4) . '</td>
                <td class="' . $zeroClass($tfidf2) . '">' . number_format($tfidf2, 4) . '</td>
                <td class="' . $zeroClass($contribution) . '">' . number_format($contribution, 4) . '</td>
            </tr>';
        }

        $html .= '</table>
                </div>
            </div>
        </body>
        </html>';

        return $html;
    }
}

// Example Usage with Debugging
$config = [
    'case_sensitive' => false,
    'keep_punctuation' => false,
    'remove_stopwords' => true, // Start with false for debugging
    'tf_method' => 'normalized', // 'raw', 'log', 'double'. 'normalized'
    'idf_method' => 'smooth_addone', // 'smooth', 'max', 'probabilistic','smooth_addone'
    'normalize_vectors' => false,
    'min_word_length' => 2,
    'debug_mode' => true
];

$analyzer = new EnhancedTextSimilarityAnalyzer($config);

$sentence1 = "Perubahan iklim menyebabkan cuaca ekstrem, kekeringan, dan mencairya es di kutub yang berdampak besar pada kehidupan manusia";
$sentence2 = "Perubahan iklim berdampak pada manusia";

$analysis = $analyzer->compareSentences($sentence1, $sentence2);
$report = $analyzer->generateHtmlReport($analysis);

// Output the report
echo $report;

// To save to file:
// file_put_contents('similarity_analysis.html', $report);