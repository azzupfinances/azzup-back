<?php

declare(strict_types=1);

namespace App\Enums;

// Banks offered for credit cards; see docs/business/credit-cards.md.
enum Bank: string
{
    case Nubank = 'nubank';
    case Inter = 'inter';
    case Itau = 'itau';
    case Bradesco = 'bradesco';
    case Santander = 'santander';
    case BancoDoBrasil = 'banco_do_brasil';
    case Caixa = 'caixa';
    case C6Bank = 'c6_bank';
    case BtgPactual = 'btg_pactual';
    case Xp = 'xp';
    case MercadoPago = 'mercado_pago';
    case PicPay = 'picpay';
    case PagBank = 'pagbank';
    case Neon = 'neon';
    case Sicoob = 'sicoob';
    case Sicredi = 'sicredi';
    case Other = 'other';
}
