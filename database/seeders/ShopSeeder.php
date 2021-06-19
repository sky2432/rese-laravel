<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owners = Owner::all()->pluck('id');

        $genres = ['寿司', '焼肉', '居酒屋', 'イタリアン', 'ラーメン'];
        $genreIds = [];

        foreach ($genres as $genre) {
            $genreId = Genre::where('name', $genre)->value('id');
            $genreIds[] = $genreId;
        }


        //オーナー1人に対して一つの店舗を所有しているようにテストデータを作成
        DB::table('shops')->insert([
            [
                'name' => '仙人',
                'owner_id' => $owners[0],
                'genre_id' => $genreIds[0],
                'overview' => '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。',
                'postal_code' => '1060032',
                'main_address' => "東京都港区六本木6-10",
                'option_address' => "六本木ヒルズ森タワー",
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '牛助',
                'owner_id' => $owners[1],
                'genre_id' => $genreIds[1],
                'overview' => '焼肉業界で20年間経験を積み、肉を熟知したマスターによる実力派焼肉店。長年の実績とお付き合いをもとに、なかなか食べられない希少部位も仕入れております。また、ゆったりとくつろげる空間はお仕事終わりの一杯や女子会にぴったりです。',
                'postal_code' => '5300001',
                'main_address' => "大阪府大阪市北区梅田1",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '戦慄',
                'owner_id' => $owners[2],
                'genre_id' => $genreIds[2],
                'overview' => '気軽に立ち寄れる昔懐かしの大衆居酒屋です。キンキンに冷えたビールを、なんと199円で。鳥かわ煮込み串は販売総数100000本突破の名物料理です。仕事帰りに是非御来店ください。',
                'postal_code' => '8180117',
                'main_address' => "福岡県太宰府市宰府2-7-12",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ルーク',
                'owner_id' => $owners[3],
                'genre_id' => $genreIds[3],
                'overview' => '都心にひっそりとたたずむ、古民家を改築した落ち着いた空間です。イタリアで修業を重ねたシェフによるモダンなイタリア料理とソムリエセレクトによる厳選ワインとのペアリングが好評です。ゆっくりと上質な時間をお楽しみください。',
                'postal_code' => '1410022',
                'main_address' => "東京都品川区東五反田1-14",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '志摩屋',
                'owner_id' => $owners[4],
                'genre_id' => $genreIds[4],
                'overview' => 'ラーメン屋とは思えない店内にはカウンター席はもちろん、個室も用意してあります。ラーメンはこってり系・あっさり系ともに揃っています。その他豊富な一品料理やアルコールも用意しており、居酒屋としても利用できます。ぜひご来店をお待ちしております。',
                'postal_code' => '8020002',
                'main_address' => "福岡県北九州市小倉北区京町3-12",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '香',
                'owner_id' => $owners[5],
                'genre_id' => $genreIds[1],
                'overview' => '大小さまざまなお部屋をご用意してます。デートや接待、記念日や誕生日など特別な日にご利用ください。皆様のご来店をお待ちしております。',
                'postal_code' => '1040028',
                'main_address' => "東京都中央区八重洲2-6",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'JJ',
                'owner_id' => $owners[6],
                'genre_id' => $genreIds[3],
                'overview' => 'イタリア製ピザ窯芳ばしく焼き上げた極薄のミラノピッツァや厳選されたワインをお楽しみいただけます。女子会や男子会、記念日やお誕生日会にもオススメです。',
                'postal_code' => '5400034',
                'main_address' => "大阪府大阪市中央区島町1-2",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'らーめん極み',
                'owner_id' => $owners[7],
                'genre_id' => $genreIds[4],
                'overview' => '一杯、一杯心を込めて職人が作っております。味付けは少し濃いめです。 食べやすく最後の一滴まで美味しく飲めると好評です。',
                'postal_code' => '1600023',
                'main_address' => "東京都新宿区西新宿1-17",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '鳥雨',
                'owner_id' => $owners[8],
                'genre_id' => $genreIds[2],
                'overview' => '素材の旨味を存分に引き出す為に、塩焼を中心としたお店です。比内地鶏を中心に、厳選素材を職人が備長炭で豪快に焼き上げます。清潔な内装に包まれた大人の隠れ家で贅沢で優雅な時間をお過ごし下さい。',
                'postal_code' => '5830012',
                'main_address' => "大阪府藤井寺市道明寺2-9",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '築地色合',
                'owner_id' => $owners[9],
                'genre_id' => $genreIds[0],
                'overview' => '鮨好きの方の為の鮨屋として、迫力ある大きさの握りを1貫ずつ提供致します。',
                'postal_code' => '1110034',
                'main_address' => "東京都台東区雷門2-17",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '晴海',
                'owner_id' => $owners[10],
                'genre_id' => $genreIds[1],
                'overview' => '毎年チャンピオン牛を買い付け、仙台市長から表彰されるほどの上質な仕入れをする精肉店オーナーの本当に美味しい国産牛を食べてもらいたいという思いから誕生したお店です。','postal_code' => '5690805',
                'main_address' => "大阪府高槻市上田辺町４",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '三子',
                'owner_id' => $owners[11],
                'genre_id' => $genreIds[1],
                'overview' => '最高級の美味しいお肉で日々の疲れを軽減していただければと贅沢にサーロインを盛り込んだ御膳をご用意しております。',
                'postal_code' => '8300032',
                'main_address' => "福岡県久留米市東町31−33",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '八戒',
                'owner_id' => $owners[12],
                'genre_id' => $genreIds[2],
                'overview' => '当店自慢の鍋や焼き鳥などお好きなだけ堪能できる食べ放題プランをご用意しております。飲み放題は2時間と3時間がございます。',
                'postal_code' => '1310045',
                'main_address' => "東京都墨田区押上1-11",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '福助',
                'owner_id' => $owners[13],
                'genre_id' => $genreIds[0],
                'overview' => 'ミシュラン掲載店で磨いた、寿司職人の旨さへのこだわりはもちろん、 食事をゆっくりと楽しんでいただける空間作りも意識し続けております。 接待や大切なお食事にはぜひご利用ください。',
                'postal_code' => '5320011',
                'main_address' => "大阪府大阪市淀川区西中島5-5",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ラー北',
                'owner_id' => $owners[14],
                'genre_id' => $genreIds[4],
                'overview' => 'お昼にはランチを求められるサラリーマン、夕方から夜にかけては、学生や会社帰りのサラリーマン、小上がり席もありファミリー層にも大人気です。',
                'postal_code' => '1710021',
                'main_address' => "東京都豊島区西池袋1-17",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '翔',
                'owner_id' => $owners[15],
                'genre_id' => $genreIds[2],
                'overview' => '博多出身の店主自ら厳選した新鮮な旬の素材を使ったコース料理をご提供します。一人一人のお客様に目が届くようにしております。',
                'postal_code' => '1710021',
                'main_address' => "大阪府堺市堺区向陵中町2-4",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '経緯',
                'owner_id' => $owners[16],
                'genre_id' => $genreIds[0],
                'overview' => '職人が一つ一心つを込めて丁寧に仕上げた、江戸前鮨ならではの味をお楽しみ頂けます。鮨に合った希少なお酒も数多くご用意しております。他にはない海鮮太巻き、当店自慢の蒸し鮑、是非ご賞味下さい。',
                'postal_code' => '1708630',
                'main_address' => "東京都豊島区東池袋3-1-3",
                'option_address' => 'サンシャインシティ ワールドインポートマートビル',
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '漆',
                'owner_id' => $owners[17],
                'genre_id' => $genreIds[1],
                'overview' => '店内に一歩足を踏み入れると、肉の焼ける音と芳香が猛烈に食欲を掻き立ててくる。そんな漆で味わえるのは至極の焼き肉です。',
                'postal_code' => '1230843',
                'main_address' => "東京都足立区西新井栄町2-2",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'THE TOOL',
                'owner_id' => $owners[18],
                'genre_id' => $genreIds[3],
                'overview' => '非日常的な空間で日頃の疲れを癒し、ゆったりとした上質な時間を過ごせる大人の為のレストラン&バーです。',
                'postal_code' => '8330031',
                'main_address' => "福岡県筑後市山ノ井240-1",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '木船',
                'owner_id' => $owners[19],
                'genre_id' => $genreIds[0],
                'overview' => '毎日店主自ら市場等に出向き、厳選した魚介類が、お鮨をはじめとした繊細な料理に仕立てられます。また、選りすぐりの種類豊富なドリンクもご用意しております。',
                'postal_code' => '5980048',
                'main_address' => "大阪府泉佐野市りんくう往来北1-7",
                'option_address' => null,
                'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
