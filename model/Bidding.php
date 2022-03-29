<?php

namespace model;

class Bidding extends ModelBase
{
    protected $fillable = [
        'id',
        'title',
        'url',
        'status',
        'description',
        'date',
    ];

    public function files()
    {
    }

    public function histories()
    {
    }

    public function setDate($date)
    {
        $this->attributes['date'] = date('Y-m-d H:i:s', (int)$date);
    }
}
