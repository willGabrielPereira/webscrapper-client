<?php

namespace model;

class ModelBase
{
    protected $table;
    protected $primaryKey = 'id';
    protected $makeIdFrom;
    protected $attributes;

    private $db;

    public function __construct($app, $attributes = [])
    {
        // Fill Model
        $this->fill($attributes);

        // Assing Eloquent
        if (!$this->table) {
            $className = explode('\\', get_class($this));
            $this->table = strtolower(end($className));
        }
        $this->db = $app->getcontainer()->get('db')->table($this->table);


        return $this;
    }


    #####################
    ## Getters/Setters ##
    #####################

    public function db()
    {
        return $this->db;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }


    #############
    ## METHODS ##
    #############

    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (!in_array($key, $this->fillable))
                continue;

            $this->$key = $value;
        }
        return $this;
    }


    ################
    ## DB ACTIONS ##
    ################

    public function save()
    {
        if (!$this->{$this->primaryKey})
            return $this->insert();
        else
            return $this->update();
    }

    public function insert()
    {
        $this->{$this->primaryKey} = $this->db->insertGetId((array)$this->attributes);
        return $this;
    }

    public function update()
    {
        if (!$this->{$this->primaryKey})
            throw new \Exception('You tried to update a empty model');

        return $this->db->where($this->primaryKey, $this->{$this->primaryKey})->update(array_filter((array)$this->attributes, fn ($i, $k) => $k != $this->primaryKey, ARRAY_FILTER_USE_BOTH));
    }

    public function delete()
    {
        if (!$this->{$this->primaryKey})
            throw new \Exception('You tried to delete a empty model');

        return $this->db->where($this->primaryKey, $this->{$this->primaryKey})->delete();
    }


    #############################
    ## Magic attribute methods ##
    #############################

    public function __set(string $name, $value)
    {
        if (!in_array($name, (array)$this->fillable))
            return;

        if (is_callable([$this, ($mutator = 'set' . ucfirst($name))]))
            $this->$mutator($value);
        else
            $this->attributes[$name] = $value;
    }

    public function __get(string $name)
    {
        if (!in_array($name, (array)$this->fillable) && $this->primaryKey != $name || !in_array($name, (array)$this->attributes))
            return;

        return $this->attributes[$name];
    }

    public function __isset(string $name)
    {
        if (!in_array($name, (array)$this->fillable) && $this->primaryKey != $name || !in_array($name, (array)$this->attributes))
            return false;

        return isset($this->attributes[$name]);
    }

    public function __unset(string $name)
    {
        if (!in_array($name, (array)$this->fillable) && $this->primaryKey != $name || !in_array($name, (array)$this->attributes))
            return;

        unset($this->attributes[$name]);
    }
}
