<?php

declare(strict_types=1);

namespace App\Http\Requests\Transactions;

// Full update: the front end always sends the whole transaction, with the same rules as creation.
class UpdateTransactionRequest extends StoreTransactionRequest {}
