<?php

namespace losthost\Staq;
use Exception;
use losthost\DB\DBView;
use losthost\DB\DB;


class staq {
    
    protected string $name;
    protected int $division;
    
    public function __construct(string $name, int $division=0) {
        
        $this->division = $division;
        $this->name = $name;
        
    }
    
    public function push(mixed $value) : mixed {
        $item = new staq_item(['id' => null, 'division' => $this->division, 'name' => $this->name, 'value' => serialize($value)], true);
        $item->write();
        return $value;
    }
    
    public function pop() : mixed {
        $last = new DBView("SELECT id FROM [staq_item] WHERE name = ? AND division = ? ORDER BY id DESC LIMIT 1", [$this->name, $this->division]);
        if ($last->next()) {
            $item = new staq_item(['id' => $last->id]);
            $value = unserialize($item->value);
            $item->delete();
            return $value;
        } else {
            throw new Exception('The staq is empty');
        }
    }
    
    public function shift() : mixed {
        $first = new DBView("SELECT id FROM [staq_item] WHERE name = ? AND division = ? ORDER BY id LIMIT 1", [$this->name, $this->division]);
        if ($first->next()) {
            $item = new staq_item(['id' => $first->id]);
            $value = unserialize($item->value);
            $item->delete();
            return $value;
        } else {
            throw new Exception('The staq is empty');
        }
    }
    
    public function clear() {
        $sth = DB::prepare("DELETE FROM [staq_item] WHERE name = ? AND division = ?");
        $sth->execute([$this->name, $this->division]);
    }
}
