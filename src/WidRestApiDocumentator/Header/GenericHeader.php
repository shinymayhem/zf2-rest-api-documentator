<?php
namespace WidRestApiDocumentator\Header;

use WidRestApiDocumentator\HeaderInterface;

class GenericHeader implements HeaderInterface
{
    protected $key;
    protected $name;
    protected $value;
    protected $required = false;
    protected $description;

    public function setOptions(array $array)
    {
        foreach ($array as $name => $value) {
            $method = 'set' . ucfirst($name);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function setDescription($description)
    {
        $this->description = (string) $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setKey($key)
    {
		if (empty($this->key))
		{
			$this->key=$this->name;
		}
        $this->key = (string) $key;
    }

    public function getKey()
    {
        return $this->key;
    }


    public function setName($name)
    {
        if ($name !== null)
        {
            $this->name = (string) $name;
        }
        else
        {
            $this->name = (string) $this->key;
        }
    }

    public function getName()
    {
		if (empty($this->name))
		{
			$this->name=$this->key;
		}
        return $this->name;
    }

    public function setRequired($required)
    {
        $this->required = (bool) $required;
    }

    public function isRequired()
    {
        return $this->required;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
