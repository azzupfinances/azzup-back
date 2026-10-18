<?php

declare(strict_types=1);

namespace App\Http\Requests\CreditCards;

// Full update: the front end always sends the whole card, with the same rules as creation.
class UpdateCreditCardRequest extends StoreCreditCardRequest {}
