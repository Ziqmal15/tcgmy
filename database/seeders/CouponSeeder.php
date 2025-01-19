<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        // // Birthday Coupon
        // Coupon::create([
        //     'code' => 'BIRTHDAY2024',
        //     'type' => 'percentage',
        //     'discount_amount' => 15.00, // Corrected to match the model
        //     'description' => 'Birthday Special Discount',
        //     'min_spend' => 0, // Ensure this matches the migration
        //     'valid_from' => now(), // Changed from starts_at to valid_from
        //     'valid_until' => now()->addYear(), // Changed from expires_at to valid_until
        //     'is_active' => true,
        //     'approved_by' => null, // Assuming no approval for seeding
        // ]);

        // // New Registration Coupon
        // Coupon::create([
        //     'code' => 'WELCOME2024',
        //     'type' => 'fixed',
        //     'discount_amount' => 10.00, // Corrected to match the model
        //     'description' => 'New User Welcome Discount',
        //     'min_spend' => 50.00, // Ensure this matches the migration
        //     'valid_from' => now(), // Changed from starts_at to valid_from
        //     'valid_until' => now()->addMonths(3), // Changed from expires_at to valid_until
        //     'is_active' => true,
        //     'approved_by' => null, // Assuming no approval for seeding
        // ]);

        // // General Discount Coupon
        // Coupon::create([
        //     'code' => 'SAVE20',
        //     'type' => 'percentage',
        //     'discount_amount' => 20.00, // Corrected to match the model
        //     'description' => 'Seasonal Discount',
        //     'min_spend' => 100.00, // Ensure this matches the migration
        //     'valid_from' => now(), // Changed from starts_at to valid_from
        //     'valid_until' => now()->addMonths(1), // Changed from expires_at to valid_until
        //     'is_active' => true,
        //     'approved_by' => null, // Assuming no approval for seeding
        // ]);
    }
}
