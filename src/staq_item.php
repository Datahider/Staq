<?php

namespace losthost\Staq;
use losthost\DB\DBObject;


class staq_item extends DBObject {
    
    const METADATA = [
        'id' => 'BIGINT(20) NOT NULL AUTO_INCREMENT',
        'division' => 'BIGINT(20) NOT NULL',
        'name' => 'VARCHAR(64) NOT NULL',
        'value' => 'VARCHAR(1024)',
        'PRIMARY KEY' => 'id',
        'INDEX USER' => 'division'
    ];
    
}
