<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Startup;
use App\Models\Investor;
use App\Models\Investment;

class StartupInvestorSeeder extends Seeder
{
    public function run(): void
    {
        $startups = [
            [
                'name' => 'TechInnovate',
                'description' => 'Zamonaviy AI asosida mahsulot tahlili va tavsiya tizimi',
                'industry' => 'Technology',
                'funding_goal' => 500000,
                'deadline' => '2025-12-31',
                'founder_name' => 'Ali Karimov',
                'founder_email' => 'ali@techinnovate.uz',
                'status' => 'active'
            ],
            [
                'name' => 'EcoFarm',
                'description' => 'Ekologik toza mahsulotlar ishlab chiqarish platformasi',
                'industry' => 'Agriculture',
                'funding_goal' => 300000,
                'deadline' => '2025-11-30',
                'founder_name' => 'Nargiza Usmanova',
                'founder_email' => 'nargiza@ecofarm.uz',
                'status' => 'active'
            ],
            [
                'name' => 'FinanceApp',
                'description' => 'Shaxsiy moliya boshqaruvi uchun mobil ilova',
                'industry' => 'Fintech',
                'funding_goal' => 750000,
                'deadline' => '2026-01-31',
                'founder_name' => 'Bobur Rahmonov',
                'founder_email' => 'bobur@financeapp.uz',
                'status' => 'active'
            ]
        ];

        foreach ($startups as $startup) {
            Startup::create($startup);
        }

        $investors = [
            [
                'name' => 'Venture Capital UZ',
                'email' => 'info@vcuz.com',
                'phone' => '+998901234567',
                'bio' => 'O\'zbekistondagi yirik venture kapital fondi',
                'total_budget' => 2000000,
                'investor_type' => 'fund'
            ],
            [
                'name' => 'Anvar Islamov',
                'email' => 'anvar@example.com',
                'phone' => '+998912345678',
                'bio' => 'IT sohasida tajribali angel investor',
                'total_budget' => 500000,
                'investor_type' => 'individual'
            ],
            [
                'name' => 'Innovation Corp',
                'email' => 'invest@innovation.uz',
                'phone' => '+998933456789',
                'bio' => 'Yangi texnologiyalarga ixtisoslashgan kompaniya',
                'total_budget' => 1000000,
                'investor_type' => 'company'
            ]
        ];

        foreach ($investors as $investor) {
            Investor::create($investor);
        }

        $investments = [
            [
                'startup_id' => 1,
                'investor_id' => 1,
                'amount' => 100000,
                'status' => 'approved',
                'notes' => 'Ajoyib loyiha, katta istiqbol bor'
            ],
            [
                'startup_id' => 2,
                'investor_id' => 2,
                'amount' => 50000,
                'status' => 'pending',
                'notes' => 'Qo\'shimcha ma\'lumot kerak'
            ],
            [
                'startup_id' => 3,
                'investor_id' => 3,
                'amount' => 200000,
                'status' => 'approved',
                'notes' => 'Fintech sohasi istiqbolli'
            ]
        ];

        foreach ($investments as $investment) {
            Investment::create($investment);
        }

        $startups = Startup::all();
        foreach ($startups as $startup) {
            $approvedInvestments = $startup->investments()->where('status', 'approved')->sum('amount');
            $startup->update(['current_funding' => $approvedInvestments]);
        }
    }
}
