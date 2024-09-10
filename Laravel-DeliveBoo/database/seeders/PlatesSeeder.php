<?php

namespace Database\Seeders;

use App\Models\Plate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PlatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Plate::truncate();

        $name = [
            'Lasagna alla Bolognese',
            'Risotto ai Funghi',
            'Spaghetti alla Carbonara',
            'Pizza Margherita',
            'Parmigiana di Melanzane',
            'Pollo al Curry',
            'Tiramisù',
            'Gnocchi al Pesto',
            'Bruschetta al Pomodoro',
            'Tagliata di Manzo'
        ];

        $description = [
            'Un piatto tradizionale italiano a base di strati di pasta all\'uovo, ragù di carne, besciamella e formaggio grattugiato, il tutto cotto al forno fino a doratura.',

            'Un cremoso risotto fatto con riso Arborio, funghi freschi, burro, parmigiano e un tocco di vino bianco, perfetto per le stagioni fredde.',

            'Un classico della cucina romana preparato con spaghetti, guanciale croccante, uova, pecorino romano e pepe nero, senza panna.',

            'Una pizza semplice e deliziosa, condita con salsa di pomodoro, mozzarella fresca, basilico e un filo di olio d\'oliva, cotta in forno a legna.',

            'Fette di melanzane fritte disposte a strati con salsa di pomodoro, mozzarella e parmigiano, poi cotte al forno fino a quando non diventano dorate e filanti.',

            'Un piatto speziato di origine indiana, preparato con pezzi di pollo cotti in una salsa ricca di curry, latte di cocco, cipolla e spezie, servito con riso basmati.',

            'Un dolce italiano a base di strati di savoiardi inzuppati nel caffè, alternati con una crema di mascarpone e cacao in polvere, il tutto refrigerato fino a raggiungere una consistenza soffice.',

            'Soffici gnocchi di patate conditi con un pesto di basilico fresco, pinoli, aglio, parmigiano e olio d\'oliva, per un piatto pieno di sapore.',

            'Fette di pane tostato condite con pomodori freschi a dadini, aglio, basilico, olio d\'oliva e sale, un antipasto semplice e rinfrescante.',

            'Fette di manzo grigliato, servite al sangue o media cottura, condite con rucola, scaglie di parmigiano e un filo di olio d\'oliva, spesso accompagnate da patate arrosto.'
        ];

        $ingredients = [
            [
                'Pasta all\'uovo',
                'Ragù di carne (manzo e maiale)',
                'Besciamella',
                'Formaggio grattugiato (parmigiano)',
                'Olio d\'oliva',
                'Cipolla',
                'Carota',
                'Sedano',
                'Vino rosso',
                'Pomodori pelati',
                'Burro'
            ],
            [
                'Riso Arborio',
                'Funghi freschi (porcini o champignon)',
                'Brodo vegetale',
                'Burro',
                'Parmigiano',
                'Vino bianco',
                'Cipolla',
                'Aglio',
                'Olio d\'oliva',
                'Prezzemolo'
            ],
            [
                'Spaghetti',
                'Guanciale',
                'Uova',
                'Pecorino romano',
                'Pepe nero',
                'Sale'
            ],
            [
                'Farina',
                'Acqua',
                'Lievito',
                'Sale',
                'Mozzarella fresca',
                'Salsa di pomodoro',
                'Basilico fresco',
                'Olio d\'oliva'
            ],
            [
                'Melanzane',
                'Mozzarella',
                'Parmigiano',
                'Salsa di pomodoro',
                'Basilico',
                'Aglio',
                'Olio d\'oliva',
                'Farina (per friggere)',
                'Sale',
                'Pepe'
            ],
            [
                'Pollo',
                'Cipolla',
                'Aglio',
                'Zenzero',
                'Curry in polvere',
                'Latte di cocco',
                'Pomodori pelati',
                'Olio di semi',
                'Riso basmati',
                'Peperoncino',
                'Coriandolo fresco'
            ],
            [
                'Savoiardi',
                'Mascarpone',
                'Uova',
                'Zucchero',
                'Caffè',
                'Cacao in polvere',
                'Liquore (facoltativo, es. Marsala o rum)',
                'Vaniglia (facoltativo)'
            ],
            [
                'Gnocchi di patate',
                'Basilico fresco',
                'Pinoli',
                'Aglio',
                'Parmigiano',
                'Olio d\'oliva',
                'Sale',
                'Pepe'
            ],
            [
                'Pane (preferibilmente casereccio)',
                'Pomodori freschi',
                'Aglio',
                'Basilico fresco',
                'Olio d\'oliva',
                'Sale',
                'Pepe'
            ],
            [
                'Manzo (controfiletto o costata)',
                'Rucola',
                'Scaglie di parmigiano',
                'Olio d\'oliva',
                'Sale grosso',
                'Pepe',
                'Patate (per l\'accompagnamento, facoltativo)'
            ]
        ];

        $img = [
            'https://www.cucchiaio.it/content/cucchiaio/it/ricette/2009/12/ricetta-lasagne-bolognese/jcr:content/header-par/image_single.img.jpg/1462958827968.jpg?im=Resize=(984)',
            'https://www.ricettedalmondo.it/images/foto-ricette/r/29778-risotto-ai-funghi-porcini-ds.jpg',
            'https://leitesculinaria.com/wp-content/uploads/2024/04/spaghetti-carbonara-1200.jpg',
            'https://citynews-cibotoday.stgy.ovh/~media/horizontal-hi/31583586473285/pizza-margherita-di-sofia.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-N05xHgAlNxEydkwU5HI0L09MLZhZtw6G8g&s',
            'https://www.giallozafferano.it/images/165-16577/Pollo-al-curry_650x433_wm.jpg',
            'https://cdn.robadadonne.it/wp-content/uploads/sites/4/2023/10/12155420/tiramisu-classico.jpg',
            'https://assets.tmecosys.com/image/upload/t_web767x639/img/recipe/ras/Assets/A39DEDA6-3C6B-4F02-B6A2-DAD2F8639A45/Derivates/2fae282e-739a-42d2-b9d7-84bf3374e63f.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmumjsg1CF2bWfYrWiWUecpCcaHGmh3Mf6vA&s',
            'https://www.gustissimo.it/articoli/ricette/carne-di-manzo/tagliata-di-manzo-alla-piastra.jpeg'
        ];

        $price = [
            '12.00',
            '14.00',
            '13.50',
            '8.00',
            '11.50',
            '15.00',
            '6.50',
            '12.00',
            '5.00',
            '18.50'
        ];

        $allergenes = [
            [
                'Glutine',
                'Latte e derivati',
                'Uova',
                'Sedano'
            ],
            [
                'Latte e derivati',
                'Solfiti' // A causa del vino bianco usato nella preparazione
            ],
            [
                'Glutine',
                'Uova',
                'Latte e derivati' // Pecorino romano
            ],
            [
                'Glutine',
                'Latte e derivati'
            ],
            [
                'Glutine',
                'Latte e derivati',
                'Uova'
            ],
            [
                'Solfiti' // A causa di alcune spezie o del vino bianco se usato
            ],
            [
                'Uova',
                'Latte e derivati',
                'Glutine' // Nei savoiardi
            ],
            [
                'Latte e derivati',
                'Glutine', // Nei gnocchi
                'Frutta a guscio' // Pinoli nel pesto
            ],
            [
                'Glutine'
            ],
            [
                'Latte e derivati' // Parmigiano nelle scaglie
            ]
        ];

        $available = [0, 0, 1, 1, 1, 0, 1, 1, 0, 1];

        $length = count($name);

        for ($i = 0; $i < $length; $i++) {
            $new_plate = new Plate();
            $new_plate->name = $name[$i];
            $new_plate->description = $description[$i];
            $new_plate->ingredients = implode(', ', $ingredients[$i]);
            $new_plate->img = $img[$i];
            $new_plate->price = $price[$i];
            $new_plate->allergenes = implode(', ', $allergenes[$i]);
            $new_plate->available = $available[$i];
            $new_plate->slug = Str::of($name[$i])->slug();
            $new_plate->save();
        }

        Schema::enableForeignKeyConstraints();
    }
}
