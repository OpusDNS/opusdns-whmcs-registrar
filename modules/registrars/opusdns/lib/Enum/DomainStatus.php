<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum DomainStatus: string
{
    case OK = 'ok';
    case SERVERTRANSFERPROHIBITED = 'serverTransferProhibited';
    case SERVERUPDATEPROHIBITED = 'serverUpdateProhibited';
    case SERVERDELETEPROHIBITED = 'serverDeleteProhibited';
    case SERVERRENEWPROHIBITED = 'serverRenewProhibited';
    case SERVERHOLD = 'serverHold';
    case TRANSFERPERIOD = 'transferPeriod';
    case RENEWPERIOD = 'renewPeriod';
    case REDEMPTIONPERIOD = 'redemptionPeriod';
    case PENDINGUPDATE = 'pendingUpdate';
    case PENDINGTRANSFER = 'pendingTransfer';
    case PENDINGRESTORE = 'pendingRestore';
    case PENDINGRENEW = 'pendingRenew';
    case PENDINGDELETE = 'pendingDelete';
    case PENDINGCREATE = 'pendingCreate';
    case INACTIVE = 'inactive';
    case AUTORENEWPERIOD = 'autoRenewPeriod';
    case ADDPERIOD = 'addPeriod';
    case DELETED = 'deleted';
    case CLIENTTRANSFERPROHIBITED = 'clientTransferProhibited';
    case CLIENTUPDATEPROHIBITED = 'clientUpdateProhibited';
    case CLIENTDELETEPROHIBITED = 'clientDeleteProhibited';
    case CLIENTRENEWPROHIBITED = 'clientRenewProhibited';
    case CLIENTHOLD = 'clientHold';
    
    public function getName(): string
    {
        return match ($this) {
            self::OK => 'OK',
            self::SERVERTRANSFERPROHIBITED => 'Server Transfer Prohibited',
            self::SERVERUPDATEPROHIBITED => 'Server Update Prohibited',
            self::SERVERDELETEPROHIBITED => 'Server Delete Prohibited',
            self::SERVERRENEWPROHIBITED => 'Server Renew Prohibited',
            self::SERVERHOLD => 'Server Hold',
            self::TRANSFERPERIOD => 'Transfer Period',
            self::RENEWPERIOD => 'Renew Period',
            self::REDEMPTIONPERIOD => 'Redemption Period',
            self::PENDINGUPDATE => 'Pending Update',
            self::PENDINGTRANSFER => 'Pending Transfer',
            self::PENDINGRESTORE => 'Pending Restore',
            self::PENDINGRENEW => 'Pending Renew',
            self::PENDINGDELETE => 'Pending Delete',
            self::PENDINGCREATE => 'Pending Create',
            self::INACTIVE => 'Inactive',
            self::AUTORENEWPERIOD => 'Auto Renew Period',
            self::ADDPERIOD => 'Add Period',
            self::DELETED => 'Deleted',
            self::CLIENTTRANSFERPROHIBITED => 'Client Transfer Prohibited',
            self::CLIENTUPDATEPROHIBITED => 'Client Update Prohibited',
            self::CLIENTDELETEPROHIBITED => 'Client Delete Prohibited',
            self::CLIENTRENEWPROHIBITED => 'Client Renew Prohibited',
            self::CLIENTHOLD => 'Client Hold',
        };
    }
}
