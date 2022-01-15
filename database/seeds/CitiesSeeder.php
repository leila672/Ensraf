<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $i = 1;
        $cities = [
            [
                'id' => $i++,
                'name_en' => 'Abha',
                'name_ar' => 'ابها',
            ],
            [
                'id' => $i++,
                'name_en' => 'Abu Arish',
                'name_ar' => 'ابو عريش',
            ],
            [
                'id' => $i++,
                'name_en' => 'Mecca',
                'name_ar' => 'مكة المكرمة',
            ],
            [
                'id' => $i++,
                'name_en' => 'Dammam',
                'name_ar' => 'الدمام',
            ],
            [
                'id' => $i++,
                'name_en' => 'Dawadmi',
                'name_ar' => 'الدوادمي',
            ],
            [
                'id' => $i++,
                'name_en' => 'addilam',
                'name_ar' => 'الدلم',
            ],
            [
                'id' => $i++,
                'name_en' => 'Diriyah',
                'name_ar' => 'الدرعية',
            ],
            [
                'id' => $i++,
                'name_en' => 'Afif',
                'name_ar' => 'عفيف',
            ],
            [
                'id' => $i++,
                'name_en' => 'Ahd Al masaraha',
                'name_ar' => 'احد المسارحة',
            ],
            [
                'id' => $i++,
                'name_en' => 'Ahd Roufida',
                'name_ar' => 'احد رفيده',
            ],
            [
                'id' => $i++,
                'name_en' => 'Bukayriyah',
                'name_ar' => 'البكيرية'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Ghat',
                'name_ar' => 'الغاط'
            ],
            [
                'id' => $i++,
                'name_en' => 'Riyad Al Khabra',
                'name_ar' => 'الخبراء'
            ],
            [
                'id' => $i++,
                'name_en' => 'Khafji',
                'name_ar' => 'الخفجي'
            ],
            [
                'id' => $i++,
                'name_en' => 'Hail',
                'name_ar' => 'حائل'
            ],
            [
                'id' => $i++,
                'name_en' => 'AlHarq',
                'name_ar' => 'الحريق'
            ],
            [
                'id' => $i++,
                'name_en' => 'AlKharj',
                'name_ar' => 'الخرج'
            ],
            [
                'id' => $i++,
                'name_en' => 'Khobar',
                'name_ar' => 'الخبر'
            ],
            [
                'id' => $i++,
                'name_en' => 'Hofuf',
                'name_ar' => 'الهفوف'
            ],
            [
                'id' => $i++,
                'name_en' => 'Kherma',
                'name_ar' => 'الخرمة'
            ],
            [
                'id' => $i++,
                'name_en' => 'Jubail',
                'name_ar' => 'الجبيل'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Jumum',
                'name_ar' => 'الجموم'
            ],
            [
                'id' => $i++,
                'name_en' => 'Layla',
                'name_ar' => 'ليلى'
            ],
            [
                'id' => $i++,
                'name_en' => '',
                'name_ar' => 'مدينة الملك عبد الله الاقتصادية'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Majarda',
                'name_ar' => 'المجاردة'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Majmaah',
                'name_ar' => 'المجمعة'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Madhnab',
                'name_ar' => 'المذنب'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Muzahimiyah',
                'name_ar' => 'المزاحمية'
            ],
            [
                'id' => $i++,
                'name_en' => 'Katif',
                'name_ar' => 'القطيف'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Qunfidhah',
                'name_ar' => 'القنفذة'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Qurayyat',
                'name_ar' => 'القريات'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Quwayiyah',
                'name_ar' => 'القويعية'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Wajh',
                'name_ar' => 'الوجه'
            ],
            [
                'id' => $i++,
                'name_en' => 'Inak',
                'name_ar' => 'عنك'
            ],
            [
                'id' => $i++,
                'name_en' => 'An Naghayriyah',
                'name_ar' => 'النعيرية'
            ],
            [
                'id' => $i++,
                'name_en' => 'Arar',
                'name_ar' => 'عرعر'
            ],
            [
                'id' => $i++,
                'name_en' => 'Rass',
                'name_ar' => 'الرس'
            ],
            [
                'id' => $i++,
                'name_en' => 'As Sulayyil',
                'name_ar' => 'السليل'
            ],
            [
                'id' => $i++,
                'name_en' => 'Taif',
                'name_ar' => 'الطائف'
            ],
            [
                'id' => $i++,
                'name_en' => 'Az Zahran',
                'name_ar' => 'الظهران'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Zulfi',
                'name_ar' => 'الزلفي'
            ],
            [
                'id' => $i++,
                'name_en' => 'Badr',
                'name_ar' => 'بدر'
            ],
            [
                'id' => $i++,
                'name_en' => 'Bishah',
                'name_ar' => 'بيشة'
            ],
            [
                'id' => $i++,
                'name_en' => 'buqayq',
                'name_ar' => 'بقيق'
            ],
            [
                'id' => $i++,
                'name_en' => 'Buraidah',
                'name_ar' => 'بريدة'
            ],
            [
                'id' => $i++,
                'name_en' => 'Duba',
                'name_ar' => 'ضبا'
            ],
            [
                'id' => $i++,
                'name_en' => 'hafr el batn',
                'name_ar' => 'حفر البطن'
            ],
            [
                'id' => $i++,
                'name_en' => 'Khamis Mushayt',
                'name_ar' => 'خميس مشيط'
            ],
            [
                'id' => $i++,
                'name_en' => 'Hawtat Bani Tamim',
                'name_ar' => 'حوطه بنى تميم'
            ],
            [
                'id' => $i++,
                'name_en' => 'Khaibar',
                'name_ar' => 'خيبر'
            ],
            [
                'id' => $i++,
                'name_en' => 'Jeddah',
                'name_ar' => 'جدة'
            ],
            [
                'id' => $i++,
                'name_en' => 'Muhayil',
                'name_ar' => 'محايل'
            ],
            [
                'id' => $i++,
                'name_en' => 'Rabigh',
                'name_ar' => 'رابغ'
            ],
            [
                'id' => $i++,
                'name_en' => 'Rafha',
                'name_ar' => 'رفحاء'
            ],
            [
                'id' => $i++,
                'name_en' => 'Safwa',
                'name_ar' => 'صفوى'
            ],
            [
                'id' => $i++,
                'name_en' => 'Sakaka',
                'name_ar' => 'سكاكا'
            ],
            [
                'id' => $i++,
                'name_en' => 'Samtah',
                'name_ar' => 'صامطة'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Shakra',
                'name_ar' => 'شقراء'
            ],
            [
                'id' => $i++,
                'name_en' => 'Sharurah',
                'name_ar' => 'شروره'
            ],
            [
                'id' => $i++,
                'name_en' => 'Sayhat',
                'name_ar' => 'سيهات'
            ], 
            [
                'id' => $i++,
                'name_en' => 'Thadij',
                'name_ar' => 'ثادق'
            ],
            [
                'id' => $i++,
                'name_en' => 'karyat el alya',
                'name_ar' => 'قريه العليا'
            ],
            [
                'id' => $i++,
                'name_en' => 'sbia',
                'name_ar' => 'صبيا'
            ],
            [
                'id' => $i++,
                'name_en' => 'Safwa',
                'name_ar' => 'صفوى',
            ],
            [
                'id' => $i++,
                'name_en' => 'Sakaka',
                'name_ar' => 'سكاكا',
            ],
            [
                'id' => $i++,
                'name_en' => 'Samtah',
                'name_ar' => 'صامطة',
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Shakra',
                'name_ar' => 'شقراء',
            ],
            [
                'id' => $i++,
                'name_en' => 'Sharurah',
                'name_ar' => 'شروره',
            ],
            [
                'id' => $i++,
                'name_en' => 'Sayhat',
                'name_ar' => 'سيهات',
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Shanan',
                'name_ar' => 'الشنان',
            ], 
            [
                'id' => $i++,
                'name_en' => '',
                'name_ar' => 'بللسمر',
            ],
            [
                'id' => $i++,
                'name_en' => 'Ras Tannurah',
                'name_ar' => 'راس تنورة',
            ],
            [
                'id' => $i++,
                'name_en' => 'Tarut',
                'name_ar' => 'تاروت'
            ],
            [
                'id' => $i++,
                'name_en' => 'Tathlith',
                'name_ar' => 'تثليث'
            ],
            [
                'id' => $i++,
                'name_en' => 'Turbah',
                'name_ar' => 'تربه'
            ],
            [
                'id' => $i++,
                'name_en' => 'Turayf',
                'name_ar' => 'طريف'
            ],
            [
                'id' => $i++,
                'name_en' => 'Thul',
                'name_ar' => 'ثول'
            ],
            [
                'id' => $i++,
                'name_en' => 'Unaizah',
                'name_ar' => 'عنيزة'
            ],
            [
                'id' => $i++,
                'name_en' => 'Ash Shimasiyah',
                'name_ar' => 'الشماسية'
            ],
            [
                'id' => $i++,
                'name_en' => 'Yanbu',
                'name_ar' => 'ينبع'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Bahah',
                'name_ar' => 'الباحة'
            ],
            [
                'id' => $i++,
                'name_en' => 'Medina',
                'name_ar' => 'المدينة المنورة'
            ],
            [
                'id' => $i++,
                'name_en' => 'jazan',
                'name_ar' => 'جازان'
            ],
            [
                'id' => $i++,
                'name_en' => 'Najran',
                'name_ar' => 'نجران'
            ],
            [
                'id' => $i++,
                'name_en' => 'Riyadh',
                'name_ar' => 'الرياض'
            ],
            [
                'id' => $i++,
                'name_en' => 'Tabuk',
                'name_ar' => 'تبوك'
            ],
            [
                'id' => $i++,
                'name_en' => 'Duma Al Jandal',
                'name_ar' => 'الجندل'
            ],
            [
                'id' => $i++,
                'name_en' => 'Umluj',
                'name_ar' => 'أملج'
            ],
            [
                'id' => $i++,
                'name_en' => 'Al Badae',
                'name_ar' => 'البدائع'
            ],
        ];
        City::insert($cities);
    }
}
