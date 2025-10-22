<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum DomainClientStatus: string
{
    case CLIENTTRANSFERPROHIBITED = 'clientTransferProhibited';
    case CLIENTUPDATEPROHIBITED = 'clientUpdateProhibited';
    case CLIENTDELETEPROHIBITED = 'clientDeleteProhibited';
    case CLIENTRENEWPROHIBITED = 'clientRenewProhibited';
    case CLIENTHOLD = 'clientHold';
}
