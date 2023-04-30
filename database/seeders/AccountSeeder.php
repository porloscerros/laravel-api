<?php

namespace Database\Seeders;

use App\Modules\Accounts\Models\Account;
use App\Modules\Accounts\Models\Group;
use App\Modules\Accounts\Models\Type;
use App\Modules\Currencies\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config("bookkeeper.default.accounts.groups") as $group_name => $values) {
            $group = Group::firstOrCreate([
                'name' => $group_name,
            ]);
            foreach ($values as $type_name) {
                Type::firstOrCreate(
                    [
                        'name' => $type_name,
                    ],
                    [
                        'group_id' => $group->id,
                    ]
                );
            }
        }
        $currency = Currency::where("code", DB::table("settings")->first()->value)->first();
        foreach (config("bookkeeper.default.accounts.accounts") as $account) {
            Account::firstOrCreate(
                [ 'name' => $account["name"] ],
                array_merge($account, ["currency_id" => $currency->id]),
            );
        }
    }
}
