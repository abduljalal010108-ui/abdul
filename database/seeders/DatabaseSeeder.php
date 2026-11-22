<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@rasakita.test'],
            ['name' => 'Admin RasaKita', 'password' => 'password', 'is_admin' => true]
        );

        $categories = [
            ['name'=>'Makanan Utama','slug'=>'makanan-utama','description'=>'Menu utama favorit.'],
            ['name'=>'Camilan','slug'=>'camilan','description'=>'Camilan untuk menemani waktu santai.'],
            ['name'=>'Minuman','slug'=>'minuman','description'=>'Minuman segar.'],
        ];
        foreach ($categories as $cat) Category::updateOrCreate(['slug'=>$cat['slug']], $cat);

        $utama = Category::where('slug','makanan-utama')->first();
        $camilan = Category::where('slug','camilan')->first();
        $minuman = Category::where('slug','minuman')->first();

        $products = [
            [$utama,'Nasi Goreng Spesial','Nasi goreng dengan telur dan ayam.',18000,30],
            [$utama,'Ayam Geprek','Ayam crispy dengan sambal pilihan.',20000,25],
            [$utama,'Mie Goreng Jawa','Mie goreng gurih dengan sayuran.',17000,20],
            [$camilan,'Pisang Cokelat','Pisang crispy dengan cokelat.',12000,40],
            [$camilan,'Kentang Goreng','Kentang goreng renyah.',10000,50],
            [$minuman,'Es Teh Manis','Teh manis dingin.',5000,60],
            [$minuman,'Jus Alpukat','Jus alpukat creamy dan segar.',14000,25],
        ];
        foreach ($products as [$cat,$name,$desc,$price,$stock]) {
            Product::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($name)],
                ['category_id'=>$cat->id,'name'=>$name,'description'=>$desc,'price'=>$price,'stock'=>$stock,'is_active'=>true]
            );
        }
    }
}
