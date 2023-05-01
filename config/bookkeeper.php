<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default records
    |--------------------------------------------------------------------------
    |
    | This value will be persisted in db by default.
    |
    */

    'default' => [
        'base_currency' => "USD",
        'currencies' => [
            [
                "name" => "Dollar",
                "code" => "USD",
            ],
            [
                "name" => "Euro",
                "code" => "EUR",
            ],
            [
                "name" => "Argentine Peso",
                "code" => "ARS",
            ],
            [
                "name" => "Brazilian Real",
                "code" => "BRL",
            ],
        ],
        'cryptos' => [
            [
                "name" => "Bitcoin",
                "code" => "BTC",
            ],
            [
                "name" => "Ether",
                "code" => "ETH",
            ],
            [
                "name" => "USD Tether",
                "code" => "USDT",
            ],
            [
                "name" => "USD Coin",
                "code" => "USDC",
            ],
            [
                "name" => "Dai",
                "code" => "DAI",
            ],
        ],
        'accounts' => [
            'groups' => [
                "Assets" => [
                    "Cash",
                    "Bank",
                    "Virtual Accounts",
                    "Foreign Assets",
                    "Investments",
                    "Properties",
                    "Receivables",
                    "Other Assets",
                ],
                "Liabilities" => [
                    "Credit Card",
                    "Foreign Liabilities",
                    "Loans",
                    "Mortgages",
                    "Payables",
                    "Other Liabilities",
                ],
            ],
            'accounts' => [
                // cash wallet by default
                [
                    'name' => "Wallet",
                    'type_id' => 1,
                    'conversion_rate' => 1,
                    'cash_based_account' => 1,
                ],
            ],
        ],
        'categories' => [
            'groups' => [
                "(Uncategorized)" => [
                    "(New Account)" => [
                        "(New Account)",
                    ],
                ],
                "Transfer" => [
                    "(Transfer)" => [
                        "(Transfer)",
                    ],
                ],
                "Income" => [
                    "Other" => [
                        "Other",
                    ],
                ],
                "Expense" => [
                    "Other" => [
                        "Other",
                    ],
                ],
            ],
        ],
        'transactions' => [
            'statuses' => [
                "None",
                "Cleared",
                "Reconciled",
                "Void",
            ],
            'types' => [
                "New account",
                "Expense",
                "Income",
                "Transfer",
            ],
            'items' => [
                "(System Generated Account)",
                "Transfer",
                "Unidentified expense",
                "Unidentified income",
                "Unnamed transaction",
            ],
        ]
    ],
];
