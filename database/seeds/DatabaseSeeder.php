<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(BrandTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(OptionGroupTableSeeder::class);
        $this->call(OptionTableSeeder::class);    
        $this->call(ProvinceTableSeeder::class);
        $this->call(DistrictTableSeeder::class);      
        $this->call(WardTableSeeder::class); 
        $this->call(ProductOptionSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(BuyerTableSeeder::class);
        $this->call(SupplierBrandBuyerSeeder::class);
        $this->call(ControllerSeeder::class);
        $this->call(ActionSeeder::class);
        $this->call(UserGroupSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(DeliveryTableSeeder::class);
        $this->call(OrderStatusSeederTable::class);
        $this->call(BannerTableSeeder::class);
    }
}
