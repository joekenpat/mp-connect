<?php

namespace Database\Seeders;

use App\Models\FunctionalSkill;
use Illuminate\Database\Seeder;

class FunctionalSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FunctionalSkill::truncate();

        $skills = [
            ["title" => "Strategy - Business plan development"],
            ["title" => "Strategy - Corporate & business unit strategy"],
            ["title" => "Strategy - Growth strategy"],
            ["title" => "Strategy - Innovation management"],
            ["title" => "Strategy - Market entry strategy"],
            ["title" => "Strategy - Portfolio strategy"],
            ["title" => "Strategy - Regulatory strategy"],
            ["title" => "Strategy - Sustainability strategy"],
            ["title" => "Market research - Benchmarking & competitive analysis"],
            ["title" => "Market research - Customer surveys & analysis"],
            ["title" => "Market research - Growth trend analysis"],
            ["title" => "Market research - Market sizing"],
            ["title" => "Market research - Statistical analysis"],
            ["title" => "Operations & SCM - Asset optimisation"],
            ["title" => "Operations & SCM - Business Excellence"],
            ["title" => "Operations & SCM - Digital transformation"],
            ["title" => "Operations & SCM - Lean management"],
            ["title" => "Operations & SCM - Lean service operations"],
            ["title" => "Operations & SCM - Organizational transformation"],
            ["title" => "Operations & SCM - Process management"],
            ["title" => "Operations & SCM - Procurement optimisation"],
            ["title" => "Operations & SCM - Product development"],
            ["title" => "Operations & SCM - Production optimisation"],
            ["title" => "Operations & SCM - Quality management"],
            ["title" => "Operations & SCM - Strategic Procurement"],
            ["title" => "Operations & SCM - Supply chain management"],
            ["title" => "People & Organization - Leadership development"],
            ["title" => "People & Organization - Knowledge Management & training"],
            ["title" => "People & Organization - Change management"],
            ["title" => "People & Organization - Org Culture assessment & management"],
            ["title" => "People & Organization - Organisational design"],
            ["title" => "People & Organization - Post merger integration"],
            ["title" => "People & Organization - Compensation & benefits"],
            ["title" => "People & Organization - Talent management & employee development"],
            ["title" => "IT & Digital - Agile project management"],
            ["title" => "IT & Digital - Big data"],
            ["title" => "IT & Digital - Cyber security & compliance"],
            ["title" => "IT & Digital - Enterprise architecture"],
            ["title" => "IT & Digital - IT Project management"],
            ["title" => "IT & Digital - IT strategy"],
            ["title" => "Implementation - Project management office"],
            ["title" => "Implementation - Capability building"],
            ["title" => "Marketing - Advertising"],
            ["title" => "Marketing - Branding"],
            ["title" => "Marketing - Customer life cycle management"],
            ["title" => "Marketing - Customer Experience"],
            ["title" => "Marketing - Customer segmentation"],
            ["title" => "Marketing - E-commerce & digital marketing"],
            ["title" => "Marketing - Go-to-market strategy"],
            ["title" => "Marketing - Marketing & communications planning + ROI"],
            ["title" => "Marketing - Product launch"],
            ["title" => "Marketing - Pricing"],
            ["title" => "Marketing - Sales and account management"],
            ["title" => "Financial advisory - Accounting"],
            ["title" => "Financial advisory - Controlling & performance measurement systems"],
            ["title" => "Financial advisory - Corporate finance & Finance function"],
            ["title" => "Financial advisory - Debt advisory"],
            ["title" => "Financial advisory - Due diligence"],
            ["title" => "Financial advisory - Internal audit"],
            ["title" => "Financial advisory - Investor documents"],
            ["title" => "Financial advisory - M&A Support"],
            ["title" => "Financial advisory - Restructuring"],
            ["title" => "Financial advisory - Tax advisory services"],
            ["title" => "Risk management - Risk assessment & system design"],
            ["title" => "Risk management - Crisis management"],
            ["title" => "Risk management - Governance"],
            ["title" => "Others"],
            ["title" => "Strategy - Operating Model design"],
            ["title" => "People & Organization - Organizational Excellence"],
            ["title" => "Operations & SCM - Process Design"],
            ["title" => "IT & Digital - System Requirements Specification"],
            ["title" => "IT & Digital - Implementation Support"],
            ["title" => "Legal"],
        ];

        foreach ($skills as $key => $skill) {
            FunctionalSkill::create($skill);
        }
    }
}
