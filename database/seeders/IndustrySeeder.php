<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Industry::truncate();

        $industries = [
            ["title" => "Agriculture"],
            ["title" => "Aerospace & Defence"],
            ["title" => "Air transportation & Tourism"],
            ["title" => "Automotive"],
            ["title" => "Banking"],
            ["title" => "Biotechnology"],
            ["title" => "Catering"],
            ["title" => "Chemicals"],
            ["title" => "Construction"],
            ["title" => "Consumer electronics"],
            ["title" => "Consumer Goods"],
            ["title" => "Digital business models"],
            ["title" => "Electrical engineering"],
            ["title" => "Energy"],
            ["title" => "Facility Services & Security"],
            ["title" => "Family Offices"],
            ["title" => "Financial services"],
            ["title" => "Food & Beverage manufacturing"],
            ["title" => "Healthcare payers"],
            ["title" => "Healthcare providers"],
            ["title" => "Hospitality"],
            ["title" => "Household electronics"],
            ["title" => "Infrastructure"],
            ["title" => "Insurance"],
            ["title" => "Media & Entertainment"],
            ["title" => "Medical devices"],
            ["title" => "Metallurgy & Mining"],
            ["title" => "Oil & gas"],
            ["title" => "Paper & Packaging"],
            ["title" => "Education"],
            ["title" => "Pharmaceuticals"],
            ["title" => "Plant & Machinery"],
            ["title" => "Postal Service & Logistics"],
            ["title" => "Private equity & VC"],
            ["title" => "Professional Service Firms"],
            ["title" => "Public Sector"],
            ["title" => "Rail & Public transport"],
            ["title" => "Real estate"],
            ["title" => "Retail"],
            ["title" => "Semiconductors & Hardware"],
            ["title" => "Shipbuilding"],
            ["title" => "Software & IT services"],
            ["title" => "Sovereign Wealth Funds"],
            ["title" => "Telecommunications"],
            ["title" => "Transport & Logistic"],
            ["title" => "Travel & Tourism"],
            ["title" => "Textile industry"],
            ["title" => "Water & Waste"],
            ["title" => "Others"],
            ["title" => "Patents"],
        ];

        foreach ($industries as $industry) {
            Industry::create($industry);
        }
    }
}
