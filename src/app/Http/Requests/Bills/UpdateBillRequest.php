<?php

declare(strict_types=1);

namespace App\Http\Requests\Bills;

// Full update: the front end always sends the whole bill, with the same rules as creation.
class UpdateBillRequest extends StoreBillRequest {}
