<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
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


        return [
            'email' => "willemzy2002@gmail.com",
            // 'email' => $this->faker->email(),
            'password' => Hash::make('password'),
            'first_name' => $this->faker->firstname(),
            'last_name' => $this->faker->lastname(),
            // 'profile_image' => $this->faker->imageUrl(400, 400, 'humans', true),
            'profile_image' => '',
            'gender' => $this->faker->randomElement(['male', 'female']), 
            'nationality' => $this->faker->country(),
            'current_address' => $this->faker->address(),
            'mobile_phone' => $this->faker->phoneNumber(),
            'years_of_work_experience' => $this->faker->numberBetween(0, 15),
            'countries_of_work_experience' => [$this->faker->country(), $this->faker->country(), $this->faker->country()],
            'name_of_professional' => '',
            'utm_medium' => '',
            'hands_on_technology' => implode(',', $this->faker->randomElements($skills, 5)),
            'topic_of_interests' => '',
            'areas_of_contribution' => '',
            'languages' => '',
            'short_bio' => $this->faker->sentence(),
            'date_of_birth' => '2022-05-12 13:22:25',
        ];
    }

    
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
