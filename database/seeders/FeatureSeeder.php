<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                "feature_name" => "AC",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/7969/7969763.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "TV",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/10618/10618809.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "FAN",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/10669/10669649.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "WiFi",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/2794/2794952.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "Bathroom",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/3130/3130313.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "Toilet",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/456/456446.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "Hot Water",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/7216/7216867.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "Terrace",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/72/72343.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "Windows",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/1353/1353091.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "Sofa",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/10641/10641189.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "Tea Table",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/5497/5497005.png",
                "added_by" => 1,
            ],
            [
                "feature_name" => "Reading Table",
                "feature_url" => "https://cdn-icons-png.flaticon.com/512/4823/4823906.png",
                "added_by" => 1,
            ],

        ];
        foreach ($features as $featureItem) {
            Feature::updateOrCreate(["feature_name" => $featureItem['feature_name']], $featureItem);
        }
    }
}
