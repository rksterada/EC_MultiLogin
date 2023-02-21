<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('primary_categories')->insert([
            [
                'name' => '本・・コミック・雑誌',
                'sort_order' => 1
            ],
            [
                'name' => 'DVD・ミュージック・ゲーム',
                'sort_order' => 2
            ],
            [
                'name' => '家電・カメラ・AV機器',
                'sort_order' => 3
            ],
            [
                'name' => 'パソコン・オフィス用品',
                'sort_order' => 4
            ],
            [
                'name' => '食品・飲料・お酒',
                'sort_order' => 5
            ],
            [
                'name' => 'ベビー・おもちゃ',
                'sort_order' => 6
            ],
            [
                'name' => '服・シューズ・バック',
                'sort_order' => 7
            ],
            [
                'name' => 'スポーツ・アウトドア',
                'sort_order' => 8
            ],
        ]);

        DB::table('secondary_categories')->insert([
            [
                'name' => '洋書',
                'sort_order' => 1,
                'primary_category_id' => 1
            ],
            [
                'name' => 'コミック',
                'sort_order' => 2,
                'primary_category_id' => 1
            ],
            [
                'name' => '雑誌',
                'sort_order' => 3,
                'primary_category_id' => 1
            ],
            [
                'name' => '単行本',
                'sort_order' => 4,
                'primary_category_id' => 1
            ],
            [
                'name' => '文庫',
                'sort_order' => 5,
                'primary_category_id' => 1
            ],
            [
                'name' => '絵本・児童書',
                'sort_order' => 6,
                'primary_category_id' => 1
            ],
            [
                'name' => 'DVD',
                'sort_order' => 7,
                'primary_category_id' => 2
            ],
            [
                'name' => 'ブルーレイ',
                'sort_order' => 8,
                'primary_category_id' => 2
            ],
            [
                'name' => 'ミュージック',
                'sort_order' => 9,
                'primary_category_id' => 2
            ],
            [
                'name' => '生活家電',
                'sort_order' => 10,
                'primary_category_id' => 3
            ],
            [
                'name' => 'カメラ・ビデオカメラ',
                'sort_order' => 11,
                'primary_category_id' => 3
            ],
            [
                'name' => '携帯・スマートフォン・その他',
                'sort_order' => 12,
                'primary_category_id' => 3
            ],
            [
                'name' => 'パソコン・タブレット',
                'sort_order' => 13,
                'primary_category_id' => 4
            ],
            [
                'name' => 'ディスプレイ・モニター',
                'sort_order' => 14,
                'primary_category_id' => 4
            ],
            [
                'name' => 'キーボード・マウス・周辺機器',
                'sort_order' => 15,
                'primary_category_id' => 4
            ],
            [
                'name' => '全ての食品・飲料',
                'sort_order' => 16,
                'primary_category_id' => 5
            ],
            [
                'name' => 'お酒',
                'sort_order' => 17,
                'primary_category_id' => 5
            ],
            [
                'name' => 'ベビー&マタニティ',
                'sort_order' => 18,
                'primary_category_id' => 6
            ],
            [
                'name' => 'おもちゃ',
                'sort_order' => 19,
                'primary_category_id' => 6
            ],
            [
                'name' => 'ホビー',
                'sort_order' => 20,
                'primary_category_id' => 6
            ],
            [
                'name' => 'メンズ',
                'sort_order' => 21,
                'primary_category_id' => 7
            ],
            [
                'name' => 'レディース',
                'sort_order' => 22,
                'primary_category_id' => 7
            ],
            [
                'name' => 'キッズ・ベビー',
                'sort_order' => 23,
                'primary_category_id' => 7
            ],
            [
                'name' => 'スーツ・スーツケース',
                'sort_order' => 24,
                'primary_category_id' => 7
            ],
            [
                'name' => 'スポーツウェア・シューズ',
                'sort_order' => 25,
                'primary_category_id' => 8
            ],
            [
                'name' => 'アウトドア',
                'sort_order' => 26,
                'primary_category_id' => 8
            ],
            [
                'name' => '自転車',
                'sort_order' => 27,
                'primary_category_id' => 8
            ],
        ]);
    }
}
