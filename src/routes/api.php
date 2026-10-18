<?php

// Central API route file. It will include one route file per module.
// See docs/modules/routes.md

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
require __DIR__.'/transactions.php';
require __DIR__.'/credit-cards.php';
require __DIR__.'/card-purchases.php';
require __DIR__.'/bills.php';
require __DIR__.'/receivables.php';
