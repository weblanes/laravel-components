<?php

namespace Weblanes\Laravel\Components\Models;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    public function __construct(array $attributes = [])
    {
        $table = $this->table();
        if (strlen($table))
            $this->table = $table;

        $fillables = $this->fillables();
        if (count($fillables))
            $this->fillable = $this->fillables();

        $casts = $this->casts();

        if (count($casts))
        $this->casts = $casts;

        parent::__construct($attributes);
    }

    /**
     * Returns the name of the table.
     * @return string
     */
    abstract protected function table(): string;

    /**
     * Returns an array of fillable attributes.
     * @return array
     */
    abstract protected function fillables(): array;

    /**
     * Returns an array with casting information for attributes.
     * @return array
     */
    abstract protected function casts(): array;
}