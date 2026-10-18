<?php

declare(strict_types=1);

namespace App\Http\Requests\Receivables;

// Full update: the front end always sends the whole receivable, with the same rules as creation.
class UpdateReceivableRequest extends StoreReceivableRequest {}
