<?php

namespace Database\Seeders;

use App\Modules\Transactions\Models\Status;
use App\Modules\Transactions\Models\Type;
use Illuminate\Database\Seeder;

class TransationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 'transactions' => [
//            'statuses' => [
//                "None",
//                "Cleared",
//                "Reconciled",
//                "Void",
//            ],
//            'types' => [
//                "New account",
//                "Expense",
//                "Income",
//                "Transfer",
//            ],
//            'items' => [
//                "(System Generated Account)",
//                "Transfer",
//                "Unidentified expense",
//                "Unidentified income",
//                "Unnamed transaction",
//            ],
//        ]

        foreach (config("bookkeeper.default.transactions.statuses") as $name) {
            Status::firstOrCreate([
                'name' => $name,
            ]);
        }
        foreach (config("bookkeeper.default.transactions.types") as $name) {
            Type::firstOrCreate([
                'name' => $name,
            ]);
        }
        foreach (config("bookkeeper.default.transactions.items") as $name) {
            Type::firstOrCreate([
                'name' => $name,
            ]);
        }
    }
}
