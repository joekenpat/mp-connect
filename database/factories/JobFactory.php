<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $skills = [
            "Strategy - Business plan development",
            "Strategy - Corporate & business unit strategy",
            "Strategy - Growth strategy",
            "Strategy - Innovation management",
            "Strategy - Market entry strategy",
            "Strategy - Portfolio strategy",
            "Strategy - Regulatory strategy",
            "Strategy - Sustainability strategy",
            "Market research - Benchmarking & competitive analysis",
            "Market research - Customer surveys & analysis",
            "Market research - Growth trend analysis",
            "Market research - Market sizing",
            "Market research - Statistical analysis",
            "Operations & SCM - Asset optimisation",
            "Operations & SCM - Business Excellence",
            "Operations & SCM - Digital transformation",
            "Operations & SCM - Lean management",
            "Operations & SCM - Lean service operations",
            "Operations & SCM - Organizational transformation",
            "Operations & SCM - Process management",
            "Operations & SCM - Procurement optimisation",
            "Operations & SCM - Product development",
            "Operations & SCM - Production optimisation",
            "Operations & SCM - Quality management",
            "Operations & SCM - Strategic Procurement",
            "Operations & SCM - Supply chain management",
            "People & Organization - Leadership development",
            "People & Organization - Knowledge Management & training",
            "People & Organization - Change management",
            "People & Organization - Org Culture assessment & management",
            "People & Organization - Organisational design",
            "People & Organization - Post merger integration",
            "People & Organization - Compensation & benefits",
            "People & Organization - Talent management & employee development",
            "IT & Digital - Agile project management",
            "IT & Digital - Big data",
            "IT & Digital - Cyber security & compliance",
            "IT & Digital - Enterprise architecture",
            "IT & Digital - IT Project management",
            "IT & Digital - IT strategy",
            "Implementation - Project management office",
            "Implementation - Capability building",
            "Marketing - Advertising",
            "Marketing - Branding",
            "Marketing - Customer life cycle management",
            "Marketing - Customer Experience",
            "Marketing - Customer segmentation",
            "Marketing - E-commerce & digital marketing",
            "Marketing - Go-to-market strategy",
            "Marketing - Marketing & communications planning + ROI",
            "Marketing - Product launch",
            "Marketing - Pricing",
            "Marketing - Sales and account management",
            "Financial advisory - Accounting",
            "Financial advisory - Controlling & performance measurement systems",
            "Financial advisory - Corporate finance & Finance function",
            "Financial advisory - Debt advisory",
            "Financial advisory - Due diligence",
            "Financial advisory - Internal audit",
            "Financial advisory - Investor documents",
            "Financial advisory - M&A Support",
            "Financial advisory - Restructuring",
            "Financial advisory - Tax advisory services",
            "Risk management - Risk assessment & system design",
            "Risk management - Crisis management",
            "Risk management - Governance",
            "Others",
            "Strategy - Operating Model design",
            "People & Organization - Organizational Excellence",
            "Operations & SCM - Process Design",
            "IT & Digital - System Requirements Specification",
            "IT & Digital - Implementation Support",
            "Legal",
        ];

        $industries = [
            "Agriculture",
            "Aerospace & Defence",
            "Air transportation & Tourism",
            "Automotive",
            "Banking",
            "Biotechnology",
            "Catering",
            "Chemicals",
            "Construction",
            "Consumer electronics",
            "Consumer Goods",
            "Digital business models",
            "Electrical engineering",
            "Energy",
            "Facility Services & Security",
            "Family Offices",
            "Financial services",
            "Food & Beverage manufacturing",
            "Healthcare payers",
            "Healthcare providers",
            "Hospitality",
            "Household electronics",
            "Infrastructure",
            "Insurance",
            "Media & Entertainment",
            "Medical devices",
            "Metallurgy & Mining",
            "Oil & gas",
            "Paper & Packaging",
            "Education",
            "Pharmaceuticals",
            "Plant & Machinery",
            "Postal Service & Logistics",
            "Private equity & VC",
            "Professional Service Firms",
            "Public Sector",
            "Rail & Public transport",
            "Real estate",
            "Retail",
            "Semiconductors & Hardware",
            "Shipbuilding",
            "Software & IT services",
            "Sovereign Wealth Funds",
            "Telecommunications",
            "Transport & Logistic",
            "Travel & Tourism",
            "Textile industry",
            "Water & Waste",
            "Others",
            "Patents",
        ];

        $rate = number_format(round($this->faker->randomFloat(2, 400, 1500), -3));
        $rate2 = number_format(round($this->faker->randomFloat(2, 1500, 5000), -3));

        return [
            'title' => $this->faker->jobTitle(),
            'industry' => $this->faker->randomElement($industries),
            'description' => $this->faker->paragraphs(3, true),
            'availability' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract']),
            'location' => $this->faker->randomElement(['On-site', 'Remote', 'Hybrid']),
            'pay_rate' => "$$rate - $$rate2",
            'candidates_required' => $this->faker->numberBetween(0, 15),
            'country' => $this->faker->country(),
            'experience' => $this->faker->numberBetween(0, 15),
            'industry_experience' => $this->faker->numberBetween(0, 20),
            'functional_skills' => implode(',', $this->faker->randomElements($skills, 5)),
            'ends_on' => $this->faker->dateTimeBetween('-1 week', '+3 months'),
        ];
    }
}